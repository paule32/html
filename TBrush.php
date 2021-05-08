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
	public function __construct($sender) {
		parent::__construct($sender);
			
		$this->setClassName   ("TPainter");
		$this->setClassID     ("qpainter");
		$this->setClassHandle ($sender->getClassHandle()+1);
	}

	// --------------------------------------------
	// set color of the board by: "TColor":
	// --------------------------------------------
	public function setColor(TColor $col) {
		if (!empty($this->Color)) {
			$this->Color = $col;
		}	else {
			$this->Color = new TColor(
			$sender->getRed  (),
			$sender->getGreen(),
			$sender->getBlue ());
		}
	}
	// -------------------------------------------------
	// set color of the board by: "int, int, int" (rgb):
	// -------------------------------------------------
	public function setColor(int $red, int $green, int $blue) {
		if (!empty($this->Color)) {
			$this->Color->setRed  ($red  );
			$this->Color->setGreen($green);
			$this->Color->setBlue ($blue );
		}	else {
			$this->Color = new TColor($red,$green,$blue);
		}
	}
	
	// --------------------------------------------
	// set image by "new" instance:
	// --------------------------------------------
	public function setImage(TImage $sender) {
		if (!empty($this->Image)) {
			$this->Image = $sender;
		}	else {
			$this->Image = new TImage($sender);
		}
	}
	// --------------------------------------------
	// set image by "string":
	// --------------------------------------------
	public function setImage(string $image) {
		if (!empty($this->Image)) {
			$this->Image->FileName = $image;
		}	else {
			$this->Image = new TImage($image);
		}
	}
	// --------------------------------------------
	// set image by: "action", and "image": dummy:
	// --------------------------------------------
	public function setImage(string $action, string $image) {
		switch (strtolower($action)) {
			case "normal" : break;
			case "clicked": break;
			case "hover"  : break;
		}
		if (!empty($this->Image)) {
			$this -> Image -> Action = $action;
			$this -> Image -> FileName = $image;
		}	else {
			$this -> Image = new TImage($image);
		}
	}
	// --------------------------------------------
	// set image by: "action", "image", "callback":
	// --------------------------------------------
	public function setImage(string $action, string $image, callable $callback) {
		switch (strtolower($action)) {
			case "normal" : break;
			case "clicked": break;
			case "hover"  :
				if ($callback !== null) {
					$callback($this);
				}
			break;
		}
		if (!empty($this->Image)) {
			$this -> Image -> Action = $action;
			$this -> Image -> FileName = $image;
		}	else {
			$this -> Image = new TImage($image);
		}
	}

	// --------------------------------------------
	// background-size: set background image attr:
	// --------------------------------------------
	public function setImageSize(string $size) {
		if (!empty($this -> Image)) {
			$this -> Image -> Size = $size;
		}
	}

	// --------------------------------------------
	// set object transparency:
	// --------------------------------------------
	public function setOpacity(int $transparency) {
		$this->Opacity = $transparency;
	}
	
	// --------------------------------------------
	// dtor: free used memory ...
	// --------------------------------------------
	public function __destruct() {
		parent::__destruct();
	}
}

?>
