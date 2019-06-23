#!/usr/bin/php
<?php

require( "vendor/autoload.php" );
use Hexmode\IOMode\IOMode;

$stderr = new IOMode( STDERR );
$stdout = new IOMode( STDOUT );
$stdin  = new IOMode( STDIN );

foreach (
	[ "in" => $stdin, "out" => $stdout, "err" => $stderr ] as $label => $io
) {
	if ( $io->TTY() ) {
		print "$label: tty\n";
	}
	if ( $io->Fifo() ) {
		print "$label: pipe\n";
	}
	if ( $io->Reg() ) {
		print "$label: regular file (redirection)\n";
	}
	if ( $io->Chr() ) {
		print "$label: character device (normal)\n";
	}
	if ( $io->Dir() ) {
		print "$label: directory (?!?!)\n";
	}
	if ( $io->Blk() ) {
		print "$label: block device\n";
	}
	if ( $io->Lnk() ) {
		print "$label: symlink\n";
	}
	if ( $io->Sock() ) {
		print "$label: socket\n";
	}
}
