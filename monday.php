<?php

require_once('common.php');
$settings = include('config.php');

$monthMetadata = $settings['where'] . date('Y-M') . METADATA_EXT;
$whereBase = $settings['where'] . date('D-W');

makeBackup($settings['what'],
    $whereBase . BACKUP_EXT,
    $monthMetadata);

copy($monthMetadata, $whereBase . METADATA_EXT);
