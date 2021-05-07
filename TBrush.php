<?php
// ------------------------------------------------------
// File    : /pub/desk/TBrush.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once ( "TObject.php" );
require_once ( "TColor.php"  );
require_once ( "TImage.php"  );
require_once ( "TRect.php"   );

// -------------------------------------------------------
// class: TPainterScreen
// -------------------------------------------------------
class TBrush extends TObject
{
	public $Color   = null;
	public $Image   = null;
	public $Rect    = null;
	public $Opacity = 1.0;		// transparency
	
	// --------------------------------------------
	// ctor: constructor
	// --------------------------------------------
	public function __construct() {
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($sender) = func_get_args();
			parent::__construct($sender);
			
			$this->setClassParent (null);
			
			$this->setClassName   ("TPainter");
			$this->setClassID     ("qpainter");
			$this->setClassHandle ($sender->getClassHandle()+1);
		}
	}

	// --------------------------------------------
	// set color of the board
	// --------------------------------------------
	public function setColor() {
		$cnt = func_num_args();
		if ($cnt == 0) {
			$this->Color = new TColor(255,100,255);
		}	else
		if ($cnt == 1) {
			list ($sender) = func_get_args();
			if ($sender instanceof TColor) {
				$this->Color = new TColor(
				$sender->getRed  (),
				$sender->getGreen(),
				$sender->getBlue ());
			}	else
			if (is_string($sender)) {
				// todo: string
			}
		}	else
		if ($cnt == 3) {
			list($a1,$a2,$a3) = func_get_args();
			$this->Color = new TColor($a1,$a2,$a3);
		}
	}
	
	public function setImage($a1) {
		$cnt = func_num_args();
		if ($cnt == 0) {
			// todo
		}	else
		if ($cnt == 1) {
			list ($sender) = func_get_args();
			if ($sender instanceof TImage) {
				$this->Image = $sender;
			}	else
			if (is_string($sender)) {
				$this->Image = new TImage($sender);
			}
		}
	}

	public function setImageSize() {
		$cnt = func_num_args();
		if ($cnt == 0) {
			$this->Image->Size = "cover";
			// todo: error msg.
		}	else
		if ($cnt == 1) {
			list ($a1) = func_get_args();
			if (is_string($a1)) {
				$this->Image->Size = $a1;
			}
		}
	}

	public function setRect() {
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($a1) = func_get_args();
			if ($a1 instanceof TRect) {
				$this->Rect = $a1;
			}
		}	else
		if ($cnt == 4) {
			list($a1,$a2,$a3,$a4) = func_get_args();
			if (is_int($a1) && is_int($a2)
			&&  is_int($a3) && is_int($a4)) {
				$this->Rect = new TRect($a1,$a2,$a3,$a4);
			}	else {
				// todo:
			}
		}
	}
	
	public function setOpacity($a1) {
		$this->Opacity = $a1;
	}
	
	// --------------------------------------------
	// dtor: free used memory ...
	// --------------------------------------------
	public function __destruct() {
		parent::__destruct();
	}
}

?>
