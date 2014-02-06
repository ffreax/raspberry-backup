<?php

require_once('common.php');
$settings = include('config.php');

$mondayMetadata = $settings['where'] . 'Mon-' . date('W') . METADATA_EXT;

$whereBase = $settings['where'] . 'Wed-' . date('W');
$wednesdayMetadata = $whereBase . METADATA_EXT;
$wednesdayBackup = $whereBase . BACKUP_EXT;

incrementalBackup($settings['what'],
    $wednesdayBackup,
    $mondayMetadata,
    $wednesdayMetadata);



