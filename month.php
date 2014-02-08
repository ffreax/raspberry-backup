<?php

require_once('common.php');

$settings = settings();

$whereBase = $settings['where'] . date('Y-M');

makeBackup($settings['what'],
    $whereBase . BACKUP_EXT,
    $whereBase . METADATA_EXT);
