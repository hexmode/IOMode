#!/usr/bin/php
<?php

require( "vendor/autoload.php" );
use Hexmode\IOMode\IOMode;

if ( IOMode::isTTY() ) {
	print "tty\n";
}
if ( IOMode::isFifo() ) {
	print "pipe\n";
}
if ( IOMode::isReg() ) {
	print "regular file (redirection)\n";
}
if ( IOMode::isChr() ) {
	print "character device (normal)\n";
}
if ( IOMode::isDir() ) {
	print "directory (?!?!)\n";
}
if ( IOMode::isBlk() ) {
	print "block device\n";
}
if ( IOMode::isLnk() ) {
	print "symlink\n";
}
if ( IOMode::isSock() ) {
	print "socket\n";
}
