<?php
// ------------------------------------------------------
// File    : /pub/desk/TWindow.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TPanel.php");

// -------------------------------------------------------
// class TWindow: represents a application window
// -------------------------------------------------------
class TWindow extends TPanWindow
{
	public $ClassName = "TWindow";
	public function __construct() {
		$cnt = func_num_args();
		list($sender) = func_get_args();
		parent::__construct($sender);
		
		$this->setClassParent ($sender);
		$this->setClassName   ("TWindow");
		$this->setClassID     ("qwindow");
	}
	public function __destruct() {
		parent::__destruct();
	}
}

?>
