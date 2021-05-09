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
				if (!empty($this->Image)) {
					$this->Image = $sender;
				}	else {
					$this->Image = new TImage($sender);
				}
			}	else
			if (is_string($sender)) {
				if (!empty($this->Image)) {
					$this->Image->FileName = $sender;
				}	else {
					$this->Image = new TImage($sender);
				}
			}
		}	else
		if ($cnt == 2) {
			list ($event,$on_hover_action) = func_get_args();
			if (is_string($event)) {
				$event = strtolower($event);
				$action = "";
				if (!strcmp($event,"normal")) {
					if (($on_hover_action instanceof Closure)
					&&  ($on_hover_action != null)) {
						 $on_hover_action();
					}
				}	else
				if (!strcmp($event,"hover")) {
					//if ($on_action instanceof Closure) {
						//$on_action($a1);
					//}
				} else
				if (!strcmp($event,"clicked")) { } else {
					// todo: error msg.
				}
				if (!empty($this->Image)) {
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
	
	public function onHover(callable $callback = null) {
		if ($callback !== null) {
			$callback($this);
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
