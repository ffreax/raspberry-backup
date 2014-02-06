<?php

const BACKUP_EXT = '.backup';
const METADATA_EXT = '.metadata';

function makeBackup($what, $where, $metaData) {
    $command = 'tar --create ' .
        '--ignore-failed-read ' .
        '--one-file-system ' .
        '--preserve-permissions ' .
        '--recursion ' .
        '--sparse ' .
        '--totals ' .
        '--verbose ' .
        '--gzip ' .
        '--listed-incremental=' . $metaData . ' ' .
        '--file=' . $where . ' ' .
        $what;

//    system($command);
    echo $command;
}

function incrementalBackup($what, $where, $previousMetadata, $currentMetadata) {
    copy($previousMetadata, $currentMetadata);

    makeBackup($what, $where, $currentMetadata);
}
