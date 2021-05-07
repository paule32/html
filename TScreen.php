<?php
// ------------------------------------------------------
// File    : /pub/desk/TScreen.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once ( "TObject.php" );
require_once ( "TRect.php"   );
require_once ( "TBrush.php"  );

class TScreen extends TBrush
{
	public $Position    = "absolute";  // default: css

	public $Margin  = null;
	public $Visual  = null;
	public $Padding = null;
	
	// ctor: constructor
	public function __construct() {
		$cnt = func_num_args();

		$this->Margin  = new TRect(0,0,0,0);
		$this->Padding = new TRect(0,0,0,0);
		
		// default values:
		if ($cnt == 0) {
			parent::__construct($this);
			$this->Visual = new TRect(2,1,"100vw","100vh");
		}	else
		if ($cnt == 2) {
			list($w,$h) = func_get_args();
			parent::__construct($this);
			$this->Visual = new TRect(0,0,$w,$h);
		}	else
		if ($cnt == 1) {
			list($a1) = func_get_args();
			if ($a1 instanceof TRect) {
				parent::__construct($this);

				$this->Visual = new TRect(
				$a1->getLeft  (),
				$a1->getTop   (),
				$a1->getRight (),
				$a1->getBottom());
			}
		}
		
		$this->setClassParent (null);
		$this->setClassName   ("TScreen");
		$this->setClassID     ("qscreen");
	}
	
	public function getMargin() { return $this->MarginRect; }
	public function setMargin() {
		$cnt = func_num_args();
		if ($cnt == 4) {
			list($a1,$a2,$a3,$a4) = func_get_args();
			if (is_int($a1) && is_int($a2)
			&&  is_int($a3) && is_int($a4)) {
				$this->Margin->setLeft  ($a1 . "px");
				$this->Margin->setTop   ($a2 . "px");
				$this->Margin->setRight ($a3 . "px");
				$this->Margin->setBottom($a4 . "px");
			}	else
			if (is_string($a1) && is_string($a2)
			&&  is_string($a3) && is_string($a4)) {
				$this->Margin->setLeft  ($a1);
				$this->Margin->setTop   ($a2);
				$this->Margin->setRight ($a3);
				$this->Margin->setBottom($a4);
			}
		}
	}
	
	public function getPadding() { return $this->PaddingRect; }
	public function setPadding() {
		$cnt = func_num_args();
		if ($cnt == 4) {
			list($a1,$a2,$a3,$a4) = func_get_args();
			if (is_int($a1) && is_int($a2)
			&&  is_int($a3) && is_int($a4)) {
				$this->Padding->setLeft ($a1 . "px");
				$this->Padding->setTop  ($a2 . "px");
				$this->Padding->Right   ($a3 . "px");
				$this->Padding->Bottom  ($a4 . "px");
			}	else
			if (is_string($a1) && is_string($a2)
			&&  is_string($a3) && is_string($a4)) {
				$this->Padding->setLeft  ($a1);
				$this->Padding->setTop   ($a2);
				$this->Padding->setRight ($a3);
				$this->Padding->setBottom($a4);
			}
		}
	}

	public function getPosition() { return $this->Position; }
	public function setPosition($a1) {
		if (!is_string($a1)) {
			// todo: error msg.
			return;
		}
		$tmp = strtolower($a1);
		if ((!strcmp($tmp,"absolute"))
		||  (!strcmp($tmp,"relative"))
		||  (!strcmp($tmp,"fixed"   ))) {
			$this->Position = $tmp;
		}	else {
			// todo: error msg.
		}
	}
	
	public function setAbsolute() { $this->setPosition("absolute"); }
	public function setRelative() { $this->setPosition("relative"); }
	public function setFixed   () { $this->setPosition("fixed"   ); }

	// dtor: free used memory ...
	public function __destruct() {
		parent::__destruct();
	}
}

?>
