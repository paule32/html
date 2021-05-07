<?php
// ------------------------------------------------------
// File    : /pub/desk/TDevice.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TPaintDevice.php");

// --------------------------------------------
// class TDevice: default (TScreen)
// --------------------------------------------
class TDevice extends TPaintDevice
{
	// ctor: constructor
	public function __construct() {
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($sender) = func_get_args();
			if (is_array($sender)) {
				foreach ($sender as $obj) {
					parent::__construct($obj);
				}
			}	else {
				parent::__construct($sender);

				$this->setClassParent ($sender);
				$this->setClassHandle ($sender->getClassHandle()+1);
			}
			
			$this->setClassName   ("TDevice");
			$this->setClassID     ("qdevice");
		}
	}

	// dtor: free used memory ...
	public function __destruct() {
		parent::__destruct();
	}
}

class TAndroid extends TDevice { }
class TTablet  extends TDevice { }
class TPrinter extends TDevice
{
	// --------------------------------------------
	public function __construct() {
		$cnt = func_num_args();
		if ($cnt == 0) {
			parent::__construct($this);
		}
	}

	// dtor: free used memory ...
	public function __destruct() {
		parent::__destruct();
	}
}

?>
