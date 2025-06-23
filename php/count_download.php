<?php
define('_JEXEC', 1);
define('JPATH_BASE', dirname(__DIR__, 3));
require_once JPATH_BASE . '/includes/defines.php';
require_once JPATH_BASE . '/includes/framework.php';

use Joomla\CMS\Factory;

$db = Factory::getDbo();
$id = (int) $_GET['id'];
$mode = $_GET['mode'] ?? 'read';

$query = $db->getQuery(true)
    ->select('count')
    ->from($db->quoteName('#__download_counter'))
    ->where('file_id = ' . $db->quote($id));
$db->setQuery($query);
$count = $db->loadResult();

if ($count === null) {
    $count = 0;
    if ($mode === 'update') {
        $query = $db->getQuery(true)
            ->insert($db->quoteName('#__download_counter'))
            ->columns(['file_id', 'count'])
            ->values($db->quote($id) . ', 1');
        $db->setQuery($query);
        $db->execute();
        $count = 1;
    }
} elseif ($mode === 'update') {
    $query = $db->getQuery(true)
        ->update($db->quoteName('#__download_counter'))
        ->set('count = count + 1')
        ->where('file_id = ' . $db->quote($id));
    $db->setQuery($query);
    $db->execute();
    $count++;
}

header('Content-Type: application/json');
echo json_encode(['count' => $count]);
