<?php
// ------------------------------------------------------
// File    : /pub/desk/TControl.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TObject.php");

// -------------------------------------------------------
// class: TControl: hold informations about controls ...
// -------------------------------------------------------
class TControl extends TObject
{
	public $ClassName  = "TControl"; // class name
	public $ParentDiv  = "";		 // name of the parent <DIV>
	public static $Controls = [];	 // visual controls list
	
	public function __construct() {
		parent::__construct(this);
	}
	
	public function __destruct() {
		parent::__destruct();
	}
}

?>
