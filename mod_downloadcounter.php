<?php
defined('_JEXEC') or die;
require_once dirname(__FILE__) . '/helper.php';

$downloads = ModDownloadCounterHelper::getDownloads($params);
require JModuleHelper::getLayoutPath('mod_downloadcounter');
