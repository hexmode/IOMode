<?php
/**
 * Copyright (C) 2019  NicheWork, LLC
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Mark A. Hershberger <mah@nichework.com>
 */
namespace Hexmode\IOMode;

class IOMode {
	/** @var mixed $handle */
    protected $handle;
	/** @var bool $isTTY */
	protected $isTTY;
	/** @var array $stat */
	protected $stat;
	/** @var bool $isFifo */
	protected $isFifo;
	/** @var bool $isChr */
	protected $isChr;
	/** @var bool $isDir */
	protected $isDir;
	/** @var bool $isBlk */
	protected $isBlk;
	/** @var bool $isReg */
	protected $isReg;
	/** @var bool $isLnk */
	protected $isLnk;
	/** @var bool $isSock */
	protected $isSock;

	public function __construct( $handle ) {
		$this->handle = $handle;

		if ( function_exists( "posix_isatty" ) ) {
			$this->isTTY = posix_isatty( $handle );
		}
		$this->stat = fstat( $handle );
		$mode = $this->stat['mode'] & 0170000; // S_IFMT

		$this->isFifo = $mode == 0010000; // S_IFIFO
		$this->isChr  = $mode == 0020000; // S_IFCHR
		$this->isDir  = $mode == 0040000; // S_IFDIR
		$this->isBlk  = $mode == 0060000; // S_IFBLK
		$this->isReg  = $mode == 0100000; // S_IFREG
		$this->isLnk  = $mode == 0120000; // S_IFLNK
		$this->isSock = $mode == 0140000; // S_IFSOCK
	}

	public function tty() {
		return $this->isTTY;
	}

	public function fifo() {
		return $this->isFifo;
	}

	public function chr() {
		return $this->isChr;
	}

	public function dir() {
		return $this->isDir;
	}

	public function blk() {
		return $this->isBlk;
	}

	public function reg() {
		return $this->isReg;
	}

	public function lnk() {
		return $this->isLnk;
	}

	public function sock() {
		return $this->isSock;
	}

	public static function isTTY() {
		$handle = new self( STDIN );
		return $handle->tty();
	}
	public static function isFifo() {
		$handle = new self( STDIN );
		return $handle->fifo();
	}
	public static function isChr() {
		$handle = new self( STDIN );
		return $handle->chr();
	}
	public static function isDir() {
		$handle = new self( STDIN );
		return $handle->dir();
	}
	public static function isBlk() {
		$handle = new self( STDIN );
		return $handle->blk();
	}
	public static function isReg() {
		$handle = new self( STDIN );
		return $handle->reg();
	}
	public static function isLnk() {
		$handle = new self( STDIN );
		return $handle->lnk();
	}
	public static function isSock() {
		$handle = new self( STDIN );
		return $handle->sock();
	}
}
