<?php
// ------------------------------------------------------
// File    : /pub/desk/TObject.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

// -------------------------------
// basse class of all classes ...
// -------------------------------
class TObject
{
	public $ClassName   = "TObject";  // class name
	public $ClassID     = "";         // class ID name
	public $ObjectName  = "";
	
	public static $ClassHandle =  0;         // class ID number
	public $Objects    = array();     // object array

	// --------------------------------------------
	public function __construct() {
		$cnt = func_num_args();
		$this::$ClassHandle++;

		if ($cnt == 0) {
			echo "nulllers\n";
			$this->setParent(null);
			$this->setClassName("TObject");
			$this->setClassID($this->ClassHandle);
		}	else
		if ($cnt == 1) {
			list($sender) = func_get_args();
			if (!is_int($sender) && !empty($sender) && $this != $sender) {
				if ($this != $sender)
				$this->addObject($sender);
			}
			return;
		}
	}

	// --------------------------------------------
	// add next object in list ...
	// --------------------------------------------
	public function addObject($a1) {
		$found = false;
		while (1) {
			if (!in_array($a1, $this->Objects)) {
				array_push($this->Objects,$a1);
				$found = true;
				break;
			}
		}
		if ($found == false) {
			// todo: error msg.
		}
		return true;
	}

	// --------------------------------------------
	// seter's: class name
	// --------------------------------------------
	public function setClassName($a1) {
		if (is_string($a1)) {
			$this->ClassName = $a1;
		}
	}
	public function setObjectName($a1) {
		if (is_string($a1)) {
			$this->setClassID($a1 . "_");
			//$this->ObjectName = $a1;
		}
	}
	
	public function setClassHandle ($a1) { $this::$ClassHandle = $a1; }
	public function setClassID     ($a1) { $this->ClassID     = $a1; }
	public function setClassParent ($a1) { /*$this->ClassParent = $a1;*/ }
	
	// --------------------------------------------
	// getter's: class name
	// --------------------------------------------
	public function getClassName   () { return $this->ClassName;   }
	public function getClassHandle () { return $this::$ClassHandle; }
	public function getClassID     () { return $this->ClassID;     }
	public function getClassParent () { return $this->ClassParent; }
	
	public function EmitCode($a1) { /* virtual */ }
	
	// dtor: free used memory ...
	public function __destruct() {
	}
}

?>
