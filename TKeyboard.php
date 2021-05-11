<?php
// ------------------------------------------------------
// File    : /pub/desk/TKeyboard.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TDevice.php");

class TKeyboard extends TDevice
{
	// --------------------------------------------
	public function __construct() {
		$cnt = func_num_args();
		if ($cnt == 0) {
			parent::__construct($this);
		}
	}

	// dtor: free used memory ...
	public function __destruct() {
		parent::__destruct();
	}
}
