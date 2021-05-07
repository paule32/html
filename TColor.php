<?php
// ------------------------------------------------------
// File    : /pub/desk/TColor.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TObject.php");

// -------------------------------------------------------
// class: TColor: hold color declarations for obj.
// -------------------------------------------------------
class TColor extends TObject
{
	public $ColorRed   = 0;
	public $ColorGreen = 0;
	public $ColorBlue  = 0;
	
	public $ColorAlpha = 1.0;	// opacity
	public $ColorName  = "rgbaa";
	
	// ctor: constructor
	public function __construct() {
		$cnt = func_num_args();
		parent::__construct($this);

		$this->setClassName   ("TColor");
		$this->setClassID     ("qcolor");
		$this->setClassHandle (parent::getClassHandle()+1);

		if ($cnt == 0) {
			$this->ColorRed   =  10;
			$this->ColorGreen = 100;
			$this->ColorBlue  = 200;
			$this->ColorAlpha = 1.0;

			$this->setHtmlColor( "#"
				. str_pad(dechex($this->getRed  ()),2,'0',STR_PAD_LEFT)
				. str_pad(dechex($this->getGreen()),2,'0',STR_PAD_LEFT)
				. str_pad(dechex($this->getBlue ()),2,'0',STR_PAD_LEFT));
		}	else
		if ($cnt == 1) {
			list($a1) = func_get_args();
			if ($a1 instanceof TColor) {
				$this->setColor($a1);
			}
			if (is_string($a1)) {
				$this->ColorName = $a1;
				if (strpos($this->ColorName,'rgb')) {
					$this->ColorName = str_replace(' ', '' ,$obj->ColorName);
					list  ($this->ColorRed,$this->ColorGreen,$this->ColorBlue) =
					sscanf($this->ColorName,"rgb(%d,%d,%d)");
				}	else
				if (strpos($obj->ColorName,'#') !== false) {
					$this->ColorName = str_replace(' ', '' ,$obj->ColorName);
					list  ($this->ColorRed,$this->ColorGreen,$this->ColorBlue) =
					sscanf($this->ColorName,"#02%x%02x%02x");
					
					$this->ColorRed   = hexdec(substr($this->ColorName,1,2));
					$this->ColorGreen = hexdec(substr($this->ColorName,1,1));
					$this->ColorBlue  = hexdec(substr($this->ColorName,5,6));
				}
			}
		}	else
		if ($cnt == 3) {
			list($a1,$a2,$a3) = func_get_args();
			if (is_int($a1) && is_int($a2) && is_int($a3)) {
				$this->setRed   ($a1);
				$this->setGreen ($a2);
				$this->setBlue  ($a3);
			}
			
			$this->setHtmlColor( "#"
			. str_pad(dechex($this->getRed  ()),2,'0',STR_PAD_LEFT)
			. str_pad(dechex($this->getGreen()),2,'0',STR_PAD_LEFT)
			. str_pad(dechex($this->getBlue ()),2,'0',STR_PAD_LEFT));
		}
	}

	// --------------------------------------------
	// getter's ...
	// --------------------------------------------
	public function getHtmlColor  () { return $this->ColorName; }
	
	public function getColorRed   () { return $this->ColorRed  ; }
	public function getColorGreen () { return $this->ColorGreen; }
	public function getColorBlue  () { return $this->ColorBlue ; }
	//
	public function getColorAlpha () { return $this->ColorAlpha; }
	
	public function getRed   () { return $this->getColorRed   (); }
	public function getGreen () { return $this->getColorGreen (); }
	public function getBlue  () { return $this->getColorBlue  (); }
	//
	public function getAlpha () { return $this->getColorAlpha (); }
	
	// --------------------------------------------
	// setter's
	// --------------------------------------------
	public function setHtmlColor  ($a1) { $this->ColorName  = $a1; }
	
	public function setColorRed   ($a1) { $this->ColorRed   = $a1; }
	public function setColorGreen ($a1) { $this->ColorGreen = $a1; }
	public function setColorBlue  ($a1) { $this->ColorBlue  = $a1; }
	//
	public function setColorAlpha ($a1) { $this->ColorAlpha = $a1; }
	
	public function setRed   ($a1) { $this->setColorRed   ($a1); }
	public function setGreen ($a1) { $this->setColorGreen ($a1); }
	public function setBlue  ($a1) { $this->setColorBlue  ($a1); }
	//
	public function setAlpha ($a1) { $this->setColorAlpha ($a1); }
	public function setColor ($a1) {
		if ($a1 instanceof TColor) {
			$this->setRed  ($a1->getRed  ());
			$this->setGreen($a1->getGreen());
			$this->setBlue ($a1->getBlue ());
			//
			$this->setAlpha($a1->getAlpha());
			$this->ColorName = $a1->ColorName;
		}
	}
	
	// dtor: free used memory ...
	public function __destruct() {
		parent::__destruct();
	}
}

?>
