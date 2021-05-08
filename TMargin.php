<?php
// ------------------------------------------------------
// File    : /pub/desk/TMargin.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once ( "TObject.php" );
require_once ( "TRect.php"   );

class TMargin extends TRect
{
	// ctor: constructor
	public function __construct($a1,$a2,$a3,$a4) {
		parent::__construct($a1,$a2,$a3,$a4);
		
		$this->setClassName   ("TMargin");
		$this->setClassID     ("qmargin");
		$this->setClassHandle (parent::getClassHandle()+1);
	}
	
	// dtor: free used memory ...
	public function __destruct() {
		parent::__destruct();
	}
}
