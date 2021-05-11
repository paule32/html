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
class TImage extends TFile
{
	public $Size   = "";
	public $Action = "";      // for event handling

	// --------------------------------------------
	// this is the real ctor, it call the fake ctor
	// --------------------------------------------
	public function __construct() {
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($sender) = func_get_args();
			parent::__construct($sender);
		}
		
		$this->setClassName   ("TImage");
		$this->setClassID     ("qimage");
		$this->setClassHandle (parent::getClassHandle()+1);
	}
	
	// dtor: free used memory ...
	public function __destruct() {
	}
}
