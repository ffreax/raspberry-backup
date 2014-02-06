<?php

require_once('common.php');
$settings = include('config.php');

$monthMetadata = $settings['where'] . date('Y-M') . METADATA_EXT;

$whereBase = $settings['where'] . 'Mon-' . date('W');
$mondayMetadata = $whereBase . METADATA_EXT;
$mondayBackup = $whereBase . BACKUP_EXT;

incrementalBackup($settings['what'],
    $mondayBackup,
    $monthMetadata,
    $mondayMetadata);
