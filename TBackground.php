<?php
// ------------------------------------------------------
// File    : /pub/desk/TBackground.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TObject.php");

// ---------------------------------------------
// class TBackground: Screen/Desktop/Window, ...
// ---------------------------------------------
class TBackground extends TObject
{
	public $ClassName  = 'TBackground';
	
	public $Rect   = null;	// screen area size
	public $Color  = null;
	public $Image  = null;
	
	public $ClassType = 0;	// det. color/image

	// --------------------------------------------
	// this is the real ctor, it call the fake ctor
	// --------------------------------------------
	public function __construct() {
		$cnt = func_num_args();
		if ($cnt == 0) {
			parent::__construct();
			$this->ClassParent = new TObject;
			$this->Number++;
			$this->ClassType = 0;
			$this->Color = new TColor(20,100,200);
			$this->setColor($this->Color);
		}	else
		if ($cnt == 1) {
			list($sender) = func_get_args();
			if ($sender instanceof TScreen) {
				/*if ($this->Parent == $sender)
				{
					$this->ClassType = $sender->Background->ClassType;
					if ($this->ClassType == 0) { $this->setColor($sender->Background->Color); } else
					if ($this->ClassType == 1) { $this->setImage($sender->Background->Image->FileName); }
				}*/
			}	else
			if ($sender instanceof TColor) {
				$this->ClassParent = new TObject;
				$this->Number++;
				$this->Color = $sender;
				$this->ClassType = 0;
				$this->setColor($this->Color);
			}	else
			if ($sender instanceof TImage) {
				$this->ClassParent = new TObject;
				$this->Number++;
				$this->Image = $sender;
				$this->ClassType = 1;
				$this->setImage($this->Image->FileName);
			}	else
			if (is_string($sender)) {
				$this->Image = new TImage($sender);
				$this->Number++;
				$this->ClassType = 1;
				$this->setImage($this->Image->FileName);
			}
		}	else
		if ($cnt == 2) {
			list($sender,$a1) = func_get_args();
			if ($sender instanceof TScreen) {
				$this->ClassParent = $sender;
				if ($a1 instanceof TColor) {
					$this->Color = $a1;
					$this->ClassType = 0;
					$this->setColor($this->Color);
				}	else
				if ($a1 instanceof TImage) {
					$this->Image = $a1;
					$this->ClassType = 1;
					$this->setImage($this->Image->FileName);
				}	else
				if (is_string($a1)) {
					$this->Image = new TImage($a1);
					$this->ClassType = 1;
					$this->setImage($this->Image->FileName);
				}
			}	else
			if ($sender instanceof TWindow) {
				// todo
			}
		}
	}
	
	// ----------------------------------------
	// set the color: RGBA of the background
	// on a associated div block ...
	// ----------------------------------------
	public function setColor() {
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($sender) = func_get_args();
			if ($sender instanceof TColor) {
				$a1 = $sender->ColorRed;
				$a2 = $sender->ColorGreen;
				$a3 = $sender->ColorBlue;
				$a4 = $sender->ColorAlpha;
				
				//if (is_hex($a1)) $a1 = HexDec($a1);
				//if (is_hex($a2)) $a2 = HexDec($a2);
				//if (is_hex($a3)) $a3 = HexDec($a3);
				//if (is_hex($a4)) $a4 = HexDec($a4);
				
				if ($this->Number == 0)
				$this->Number++;
				$str = "qscreen";
				
				if ($this->ClassParent instanceof TObject ) { $str = "qscreen" ; } else
				if ($this->ClassParent instanceof TScreen ) { $str = "qscreen" ; } else
				if ($this->ClassParent instanceof TWindow ) { $str = "qwindow" ; }

				$_SESSION['document_stream'] .= ""
				. "$('#"
				. $str . $this->Number
				. "').css({'background-color':'rgb("
				. $a1 . "," . $a2 . "," . $a3
				. ")'});";
			}
		}	else
		if ($cnt == 3) {
			list($a1,$a2,$a3) = func_get_args();
			
			//if (is_hex($a1)) $a1 = HexDec($a1);
			//if (is_hex($a2)) $a2 = HexDec($a2);
			//if (is_hex($a3)) $a3 = HexDec($a3);

			if ($this->Number == 0)
			$this->Number++;
			$str = "qscreen";
				
			if ($this->ClassParent instanceof TObject ) { $str = "qscreen" ; } else
			if ($this->ClassParent instanceof TScreen ) { $str = "qscreen" ; } else
			if ($this->ClassParent instanceof TWindow ) { $str = "qwindow" ; }

			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $str . $this->Number
			. "').css({'background-color':'rgb("
			. $a1 . ","
			. $a2 . ","
			. $a3 . ")'});\n";
		}	else
		if ($cnt == 4) {
			list($a1,$a2,$a3,$a4) = func_get_args();

			//if (is_hex($a1)) $a1 = HexDec($a1);
			//if (is_hex($a2)) $a2 = HexDec($a2);
			//if (is_hex($a3)) $a3 = HexDec($a3);
			//if (is_hex($a4)) $a4 = HexDec($a4);

			if ($this->Number == 0)
			$this->Number++;
			$str = "qscreen";
			
			if ($this->ClassParent instanceof TObject ) { $str = "qscreen" ; } else
			if ($this->ClassParent instanceof TScreen ) { $str = "qscreen" ; } else
			if ($this->ClassParent instanceof TWindow ) { $str = "qwindow" ; }

			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $str . $this->Number
			. "').css({'background-color':'rgb("
			. $a1 . "," . $a2 . "," . $a3
			. ")'});";
		}
	}

	public function setImage() {
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($a1) = func_get_args();
			if ($a1 instanceof TString) {
				$im = $a1->Text;
			}	else
			if ($a1 instanceof TImage) {
				$im = $a1->FileName;
			}
			if (is_string($a1)) {
				$im = $a1;
			}
			
			if (empty($this->Image))
				$this->Image = new TImage($im);
			
			$str = "qscreen";
			
			if ($this->ClassParent instanceof TObject ) { $str = "qscreen" ; } else
			if ($this->ClassParent instanceof TScreen ) { $str = "qscreen" ; } else
			if ($this->ClassParent instanceof TWindow ) { $str = "qwindow" ; }

			if ($this->Number == 0)
				$this->Number++;
			
			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $str . $this->Number
			. "').css({'background-image':'url("
			. $this->Image->FileName
			. ")'});\n";
		}
	}

	// dtor: free used memory ...
	public function __destruct() {
	}
}
