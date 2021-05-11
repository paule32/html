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
class TDesktopIcon extends TPanel
{
	public $IsDraggbar = false;
	
	public function __construct() {
		$cnt = func_num_args();
		list($sender) = func_get_args();
		parent::__construct($sender);
		
		$this->setLeft(100);
		$this->setTop(100);
		$this->setWidth(100);
		$this->setHeight(50);
		
		// read template file in:
		
		ob_start();
		require_once ( __DIR__ . "./assets/php/t_icon.php" );
		$contents = ob_get_contents();

		require_once ( __DIR__ . "./apps/dbase/start.php" );
		$page_file = ob_get_contents();
		ob_end_clean();
		
		$pattern  = "/\%__file_conents__\%/";
		$contents = preg_replace($pattern,$contents,$page_file);
		
		echo $contents;
	}
	
	public function isDrawable(bool $draggable) {
		$IsDraggbar = $draggable;
	}
	
	public function __destruct() {
	}
}
