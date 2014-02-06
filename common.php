<?php

const BACKUP_EXT = '.backup';
const METADATA_EXT = '.metadata';

const EXCLUDE_FROM = 'exclude-from-backup.txt';

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
        '--exclude-from='.EXCLUDE_FROM . ' ' .
        $what;

//    system($command);
    echo $command;
}
