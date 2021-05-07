<?php
// ------------------------------------------------------
// File    : /pub/desk/TDesktopIcon.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TPanel.php");

// -------------------------------------------------------
// class TPanel: represents a application panel
// -------------------------------------------------------
class TDesktopIcon extends TPanWindow
{
	public $ClassName = "TDesktopIcon";
	public function __construct() {
		$cnt = func_num_args();
		list($sender) = func_get_args();
		parent::__construct($this,$sender);
	}
	public function __destruct() {
	}
}

?>
