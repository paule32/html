<?php
// ------------------------------------------------------
// File    : /pub/desk/Utils.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once ( "TObject.php" );

// ----------------------------------------
// The perfect way to check HEX string ...
// ----------------------------------------
function is_hex($hex_code) {
	return @preg_match("/^[a-f0-9]{2,}$/i",
	$hex_code) && !(strlen($hex_code) & 1);
}

// ----------------------------------------
// common helper functions:
// ----------------------------------------
class TUtils extends TObject
{
	private $_sender = null;
	private $_image  = "";
	
	// ctor: constructor:
	public function __construct() {
		parent::__construct($this);
	}

	public function setImage($sender, $image) {
		if (empty($sender->Image)) {
			$class = get_class($sender);
			switch ($class) {
				case 'TDesktopWindow':
					$sender -> Image = new TImage($image);
				break;
			}
		}	else {
			$class = get_class($sender);
			switch ($class) {
				case 'TDesktopWindow':
					$sender -> Image = $sender;
					$sender -> Image -> FileName = $image;
				break;
			}
		}
	}
	
	// dtor: free memory ...
	public function __destruct() {
		parent::__destruct();
	}
}
