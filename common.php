<?php

const BACKUP_EXT = '.backup';
const METADATA_EXT = '.metadata';

function makeBackup($what, $where, $metaData) {
    $settings = settings();
    $log = $where . '.log';

    $command = 'tar --create ';
    $command .= '--ignore-failed-read ';
    $command .= '--one-file-system ';
    $command .= '--preserve-permissions ';
    $command .= '--recursion ';
    $command .= '--sparse ';
    $command .= '--totals ';
    if($settings['gzip']) {
        $command .= '--gzip ';
    }

    $backupIgnore = $what + '.backup-ignore';
    if(file_exists($backupIgnore)) {
        $command .= '--exclude-from=' . $backupIgnore . ' ';
    }

    $command .= '--listed-incremental=' . $metaData . ' ';
    $command .= '--file=' . $where . ' ';
    $command .= $what;


    foreach($settings['before'] as $cmd) {
        system($cmd . ' >> ' . $log . ' 2>&1');
    }

    system($command . ' >> ' . $log . ' 2>&1');

    foreach($settings['after'] as $cmd) {
        system($cmd . ' >> ' . $log . ' 2>&1');
    }
}

function incrementalBackup($what, $where, $previousMetadata, $currentMetadata) {
    if(file_exists($previousMetadata)) {
        copy($previousMetadata, $currentMetadata);

        makeBackup($what, $where, $currentMetadata);
    }
}

function settings() {
    global $argv;
    if(empty($argv[1]) || !file_exists($argv[1])) {
        throw new Exception('please specify correct path to config');
    }

    $settings = include($argv[1]);
    if(!isset($settings['gzip'])) {
        $settings['gzip'] = false;
    }

    if(!isset($settings['before'])) {
        $settings['before'] = array();
    }
    if(!isset($settings['after'])) {
        $settings['after'] = array();
    }

}
