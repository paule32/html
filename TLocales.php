<?php
// ------------------------------------------------------
// File    : /pub/desk/TLocales.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TObject.php");

// -----------------------------------------------
// the global class for locales information's ...
// -----------------------------------------------
class TLocales extends TObject
{
	public $ClassName       = "TLocales";
	
	public $DefaultLang     = "English";
	public $DefaultCurrency = "USD";
	//
	public $Language        = array();
	
	// ctor: constructor
	public function __construct() {
		parent::__construct($this);
		$defLang = "English";
		
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($a1) = func_get_args();
			if (is_string($a1)) {
				$defLang = $a1;
			}
		}
		
		$Language['English']['info'] = function($a1) { return TLocales::info_en_us($a1); };
		$Language['German' ]['info'] = function($a1) { return TLocales::info_de_de($a1); };
		
		$Language['English']['warn'] = function($a1) { return TLocales::warn_en_us($a1); };
		$Language['German' ]['warn'] = function($a1) { return TLocales::warn_de_de($a1); };
		
		$Language['English']['error'] = function($a1) { return TLocales::error_en_us($a1); };
		$Language['German' ]['error'] = function($a1) { return TLocales::error_de_de($a1); };
	
		$Language['English']['currency'] = "USD";	// us: dollar
		$Language['German' ]['currency'] = "EUR";	// european: euro

		$this->setDefaultLang($defLang);	// us, england
		$this->setDefaultCurrency("USD");	// us dollar
	}

	// -------------------------------
	// seter's of TLocales
	// -------------------------------
	public function setDefaultLang($a1) {
		if (is_string($a1)) {
			$tmp = strtolower($a1);
			if (!strcmp($tmp,"english")) { $DefaultLang = "English"; } else
			if (!strcmp($tmp,"german" )) { $DefaultLang = "German" ; } else {
				$DefaultLang = "English";
			}
		}
	}
	public function setDefaultCurrency($a) {
		if (is_string($a1)) {
			$Language[$this->getDefaultLang()]['currency'] = $a1;
		}
	}
	// -------------------------------
	// geter's of TLocales
	// -------------------------------
	public function getDefaultCurrency () { return $this->DefaultCurrency; }
	public function getDefaultLang     () { return $this->DefaultLang;     }
	
	// -------------------------------
	// message dialogs ...
	// -------------------------------
	public function info  ($a1) { $Language[$this->getDefaultLang()]['info' ]($a1); }
	public function warn  ($a1) { $Language[$this->getDefaultLang()]['warn' ]($a1); }
	public function error ($a1) { $Language[$this->getDefaultLang()]['error']($a1); }
	
	// information dialog:
	private static function info_en_us($a1) {
		if (is_string($a1)) {
			"<script>document.write(\"console.info('" . $a1 . "');\");</script>";
			// todo: error msg.
		}	else
		if (is_int($a1)) {
			"<script>document.write(\"console.info('Code: " . $a1 . "');\");</script>";
			// todo: error code
		}
	}
	private static function info_de_de($a1) {
		if (is_string($a1)) {
			"<script>document.write(\"console.info('" . $a1 . "');\");</script>";
			// todo: error msg.
		}	else
		if (is_int($a1)) {
			"<script>document.write(\"console.info('Code: " . $a1 . "');\");</script>";
			// todo: error code
		}
	}
	
	// warning dialog:
	private static function warn_en_us($a1) {
		if (is_string($a1)) {
			"<script>document.write(\"console.warn('" . $a1 . "');\");</script>";
			// todo: error msg.
		}	else
		if (is_int($a1)) {
			"<script>document.write(\"console.warn('Code: " . $a1 . "');\");</script>";
			// todo: error code
		}
	}
	private static function warn_de_de($a1) {
		if (is_string($a1)) {
			"<script>document.write(\"console.warn('" . $a1 . "');\");</script>";
			// todo: error msg.
		}	else
		if (is_int($a1)) {
			"<script>document.write(\"console.warn('Code: " . $a1 . "');\");</script>";
			// todo: error code
		}
	}
	
	// error dialog:
	private static function error_en_us($a1) {
		if (is_string($a1)) {
			"<script>document.write(\"console.error('" . $a1 . "');\");</script>";
			// todo: error msg.
		}	else
		if (is_int($a1)) {
			"<script>document.write(\"console.error('Code: " . $a1 . "');\");</script>";
			// todo: error code
		}
	}
	private static function error_de_de($a1) {
		if (is_string($a1)) {
			"<script>document.write(\"console.error('" . $a1 . "');\");</script>";
			// todo: error msg.
		}	else
		if (is_int($a1)) {
			"<script>document.write(\"console.error('Code: " . $a1 . "');\");</script>";
			// todo: error code
		}
	}
	
	// dtor: free memory ...
	public function __destruct() {
		parent::__destruct();
	}
}

