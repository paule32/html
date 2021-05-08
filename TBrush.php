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
class TBrush extends TRect
{
	public $Color   = null;
	public $Image   = null;
		
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
	
	public function setImage() {
		$cnt = func_num_args();
		if ($cnt == 0) {
			// todo: error msg.
		}	else
		if ($cnt == 1) {
			list ($sender) = func_get_args();
			if ($sender instanceof TImage) {
				$this->Image = $sender;
			}	else
			if (is_string($sender)) {
				$this->Image = new TImage($sender);
			}
		}	else
		if ($cnt == 2) {
			list ($a1,$a2) = func_get_args();
			if (is_string($a1) && is_string($a2)) {
				$a1 = strtolower($a1);
				$action = "";
				if (!strcmp($a1,"normal" )) { $action = $a1; } else
				if (!strcmp($a1,"hover"  )) { $action = $a1; } else
				if (!strcmp($a1,"clicked")) { $action = $a1; } else {
					// todo: error msg.
				}
				if (!empty($this->Image)) {
					$this -> Image -> Action = $action;
				}	else {
					$this -> Image = new TImage($a2);
					$this -> Image -> Action = $action;
				}
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
