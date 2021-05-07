<?php
// ------------------------------------------------------
// File    : /pub/desk/TRect.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TObject.php");

// -----------------------------------------------------------
// class TRect: represents an area/size for a device/window.
// -----------------------------------------------------------
class TRect extends TObject
{	
	public $Left   = "0px";
	public $Top    = "0px";
	public $Right  = "0px";
	public $Bottom = "0px";
	//
	public $Width  = "0px";
	public $Height = "0px";
	
	// --------------------------------------------
	// ctor: constructor
	// --------------------------------------------
	public function __construct() {
		$cnt = func_num_args();

		//$this->setClassParent ($sender);
		$this->setClassName   ("TRect");
		$this->setClassID     ("qrect");
		
		if ($cnt == 0) {
			parent::__construct($this);
			$this->setTop   (1);
			$this->setLeft  (2);
			$this->setRight (3); $this->setWidth (5);
			$this->setBottom(4); $this->setHeight(6);
		}	else
		if ($cnt == 1) {
			list($sender) = func_get_args();
			if ($sender instanceof TRect) {
				parent::__construct($sender);
				
				$this->setHeight($sender->getHeight ());
				$this->setWidth ($sender->getWidth  ());
				$this->setLeft  ($sender->getLeft   ());
				$this->setTop   ($sender->getTop    ());
				
				$this->setRight ($sender->getRight  ());
				$this->setBottom($sender->getBottom ());
			}	else {
				// todo:
			}
		}	else
		if ($cnt == 4) {
			list($a1,$a2,$a3,$a4) = func_get_args();
			if (is_int($a1) && is_int($a2)
			&&  is_int($a3) && is_int($a4)) {
				parent::__construct($this);
				$this->setTop   ($a1 . "px");
				$this->setLeft  ($a2 . "px");
				$this->setRight ($a3 . "px"); $this->setWidth ($a3 . "px");
				$this->setBottom($a4 . "px"); $this->setHeight($a4 . "px");
			}	else
			if (is_int   ($a1) && is_int   ($a2)
			&&  is_string($a3) && is_string($a4)) {
				parent::__construct($this);
				$this->setTop   ($a1 . "px");
				$this->setLeft  ($a2 . "px");
				$this->setRight ($a3); $this->setWidth ($a3);
				$this->setBottom($a4); $this->setHeight($a4);
			}	else
			if (is_string($a1) && is_string($a2)
			&&  is_string($a3) && is_string($a4)) {
				parent::__construct($this);
				$this->setTop   ($a1);
				$this->setLeft  ($a2);
				$this->setRight ($a3); $this->setWidth ($a3);
				$this->setBottom($a4); $this->setHeight($a4);
			}
		}	else {
			// todo: error message !
		}
	}
	
	// --------------------------------------------
	// getter's:
	// --------------------------------------------
	public function getWidth () { return $this->Width ; }
	public function getHeight() { return $this->Height; }
	
	public function getTop   () { return $this->Top;    }
	public function getLeft  () { return $this->Left;   }
	public function getRight () { return $this->Right;  }
	public function getBottom() { return $this->Bottom; }
	
	// --------------------------------------------
	// setter's:
	// --------------------------------------------
	public function setWidth ($a1) {
		if (is_int($a1)) {
			$this->Width = $a1 . "px";
			$this->Right = $a1 . "px";
		}	else
		if (is_string($a1)) {
			$this->Width = $a1;
			$this->Right = $a1;
		}
	}
	public function setHeight($a1) {
		if (is_int($a1)) {
			$this->Height = $a1 . "px";
			$this->Bottom = $a1 . "px";
		}	else
		if (is_string($a1)) {
			$this->Height = $a1;
			$this->Bottom = $a1;
		}
	}
	public function setTop($a1) {
		if (is_int($a1)) {
			$this->Top = $a1 . "px";
		}	else
		if (is_string($a1)) {
			$this->Top = $a1;
		}
	}
	public function setLeft($a1) {
		if (is_int($a1)) {
			$this->Left = $a1 . "px";
		}	else
		if (is_string($a1)) {
			$this->Left = $a1;
		}
	}
	public function setRight($a1) {
		if (is_int($a1)) {
			$this->Right = $a1 . "px";
			$this->Width = $a1 . "px";
		}	else
		if (is_string($a1)) {
			$this->Right = $a1;
			$this->Width = $a1;
		}
	}
	public function setBottom($a1) {
		if (is_int($a1)) {
			$this->Bottom = $a1 . "px";
			$this->Height = $a1 . "px";
		}	else
		if (is_string($a1)) {
			$this->Bottom = $a1;
			$this->Height = $a1;
		}
	}
	
	// --------------------------------------------
	// dtor: free used memory ...
	// --------------------------------------------
	public function __destruct() {
		parent::__destruct();
	}
}

?>
