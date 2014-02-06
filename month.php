<?php

require_once('common.php');
$settings = include('config.php');

$whereBase = $settings['where'] . date('Y-M');

makeBackup($settings['what'],
    $whereBase . BACKUP_EXT,
    $whereBase . METADATA_EXT);
