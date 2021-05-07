<?php
// ------------------------------------------------------
// File    : /pub/desk/TImage.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TObject.php");
require_once("TFile.php");

// -------------------------------------------------------
// class: TImage: loads pictures/images into onj.
// -------------------------------------------------------
class TFile extends TObject
{
	public $FileHandle = 0;
	public $FileName   = "";
	public $FileIsOpen = false;
	
	// dtor: constructor:
	public function __construct() {
		$cnt = func_num_args();
		if ($cnt == 0) {
			parent::__construct($this);
			// todo
		}	else
		if ($cnt == 1) {
			list($sender) = func_get_args();
			if (is_string($sender)) {
				parent::__construct($this);
				$this->FileName = $sender;
			}
		}
		
		$this->setClassName   ("TFile");
		$this->setClassID     ("qfile");
		$this->setClassHandle (parent::getClassHandle()+1);
	}
	
	// dtor: free memory ...
	public function __destruct() {
	}
}

?>