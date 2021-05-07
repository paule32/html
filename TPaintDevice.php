<?php
// ------------------------------------------------------
// File    : /pub/desk/TPaintDevice.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TObject.php");

// --------------------------------------------
// class: TPaintDevice (TScreen)
// --------------------------------------------
class TPaintDevice extends TObject
{
	public $Printer  = null;       // printer
	
	public function __construct() {
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($sender) = func_get_args();
			parent::__construct($sender);
			
			if  ($sender instanceof TDesktopWindow) {
				echo "- " . get_class($sender) . "\n";
//				array_push( $this::$Controls, $sender);
			}
	
			$this->setClassParent ($sender);
			$this->setClassHandle ($sender->getClassHandle()+1);
			
			$this->setClassName   ("TPaintDevice");
			$this->setClassID     ("qpaintdevice");
		}
	}
	
	// dtor: free used memory ...
	public function __destruct() {
		parent::__destruct();
	}
}

?>
