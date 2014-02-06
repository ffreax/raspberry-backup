<?php

require_once('common.php');
$settings = include('config.php');

$mondayMetadata = $settings['where'] . 'Mon-' . date('W') . METADATA_EXT;
$whereBase = $settings['where'] . date('D-W');

makeBackup($settings['what'],
    $whereBase . BACKUP_EXT,
    $mondayMetadata);

copy($mondayMetadata, $whereBase . METADATA_EXT);
