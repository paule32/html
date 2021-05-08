<?php
// ------------------------------------------------------
// File    : /pub/desk/TDesktopWindow.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TPanel.php");

// -------------------------------------------------------
// class TDesktopWindow: represents a desktop panel
// -------------------------------------------------------
class TDesktopWindow extends TPanel
{
	public function __construct() {
		$cnt = func_num_args();
		list($sender) = func_get_args();
		parent::__construct($sender);

		$this->setClassName   ("TDesktopWindow");
		$this->setClassID     ("qdesktopwindow");
		$this->setClassHandle ($sender->getClassHandle()+1);
	}
	
	public function __destruct() {
		parent::__destruct();
	}
}

?>
