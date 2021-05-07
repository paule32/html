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
class TImage extends TObject
{
	public $File  = null;
	public $Size  = "";

	// --------------------------------------------
	// this is the real ctor, it call the fake ctor
	// --------------------------------------------
	public function __construct() {
		$cnt = func_num_args();
		if ($cnt == 0) {
			parent::__construct();
			$this->ClassParent = new TObject();
			$this->File = new TFile();
		}	else
		if ($cnt == 1) {
			list($sender) = func_get_args();
			
			if ($sender instanceof TString) {
				parent::__construct($sender);
				$this->File = new TFile($sender->Text);
			}	else
			if ($sender instanceof TUrl) {
				parent::__construct($sender);
				$this->File = new TFile($sender->Text);
			}	else
			if (is_string($sender)) {
				parent::__construct(null);
				$this->File = new TFile($sender);
			}
		}
		$this->setClassName   ("TFile");
		$this->setClassID     ("qfile");
		$this->setClassHandle (parent::getClassHandle()+1);
	}
	
	// dtor: free used memory ...
	public function __destruct() {
	}
}

?>
