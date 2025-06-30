<?php
define('_JEXEC', 1);
define('JPATH_BASE', dirname(__DIR__, 3));
require_once JPATH_BASE . '/includes/defines.php';
require_once JPATH_BASE . '/includes/framework.php';
require_once dirname(__DIR__) . '/helper.php';

use Joomla\CMS\Factory;

$db = Factory::getDbo();
$id = (int) $_GET['id'];
$mode = $_GET['mode'] ?? 'read';

$query = $db->getQuery(true)
    ->select(['count', 'title', 'file_path'])
    ->from($db->quoteName('#__download_counter'))
    ->where('file_id = ' . $db->quote($id));
$db->setQuery($query);
$result = $db->loadAssoc();

if ($result === null) {
    $count = 0;
    if ($mode === 'update') {
        // Get title and file path from helper for new entries
        $downloadInfo = ModDownloadCounterHelper::getDownloadById($id);
        $title = $downloadInfo ? $downloadInfo['title'] : '';
        $filePath = $downloadInfo ? $downloadInfo['url'] : '';
        
        $query = $db->getQuery(true)
            ->insert($db->quoteName('#__download_counter'))
            ->columns(['file_id', 'count', 'title', 'file_path', 'last_downloaded'])
            ->values($db->quote($id) . ', 1, ' . $db->quote($title) . ', ' . $db->quote($filePath) . ', NOW()');
        $db->setQuery($query);
        $db->execute();
        $count = 1;
    }
} else {
    $count = $result['count'];
    if ($mode === 'update') {
        $query = $db->getQuery(true)
            ->update($db->quoteName('#__download_counter'))
            ->set(['count = count + 1', 'last_downloaded = NOW()'])
            ->where('file_id = ' . $db->quote($id));
        $db->setQuery($query);
        $db->execute();
        $count++;
    }
}

header('Content-Type: application/json');
echo json_encode(['count' => $count]);
