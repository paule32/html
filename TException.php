<?php
// ------------------------------------------------------
// File    : /pub/desk/TException.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TObject.php");

class TException extends TObject {
	public $ClassName = "TException";
	public function __construct($a1) {
		parent::__construct();
	}
}

?>
