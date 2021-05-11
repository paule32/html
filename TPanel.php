<?php
// ------------------------------------------------------
// File    : /pub/desk/TPanel.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once ( "TObject.php" );
require_once ( "TBrush.php"  );
require_once ( "TRect.php"   );
require_once ( "TMargin.php" );

// -------------------------------------------------------
// class TPanWindow: represents a application window/panel
// -------------------------------------------------------
class TPanWindow extends TObject
{
	public $Layout = null;
	
	public $uiText = "";
	public $Number =  0;

	public $Background = null;
	public $rect       = null;	// window size
	
	protected $init_layout = 0;

	// --------------------------------------------
	// this is the real ctor, it call the fake ctor
	// --------------------------------------------
	public function __construct() {
		$cnt = func_num_args();
		$this->rect = new TRect();
		if ($cnt == 0) {
			$this->ClassParent = new TObject($this);
		}	else
		if ($cnt == 2) {
			list($wc,$sender) = func_get_args();
			$this->ClassParent = $sender;
			
			if ($wc instanceof TDesktopWindow) {
				$this->ClassLHS = "qdesktop";
				$this->ClassRHS = "qscreen";
				$this->uiText   = "qscreen";
			}	else
			if ($wc instanceof TTaskBar) {
				$this->ClassLHS = "qtaskbar";
				$this->ClassRHS = "qscreen";
				$this->uiText   = "qscreen";
			}	else
			if ($wc instanceof TButton) {
				$this->ClassLHS = "qbutton";
				//$this->uiText   = "----------------" . $sender->uiText;
			}	else
			if ($wc instanceof TWindow) {
				$this->ClassLHS = "qwindow";
				$this->uiText   = "window";
			} else
			if ($wc instanceof TPanel ) {
				$this->ClassLHS = "qpanel";
				$this->uiText   = "panel";
			} else
			if ($wc instanceof TScreen) {
				$this->ClassLHS = "qscreen";
				$this->uiText   = "screen";
			}
		}
	}
	
	public function EmitCode($sender)
	{			
		// check, if panel div exist's
		$num = 0;
		/*
		while (1) {
			$str = $this->ClassLHS . $num++;
			if (!in_array($str, $this::$Controls)) {
				$this->Number = $num;
				array_push($this::$Controls,$str);
				break;
			}
		}*/
			
		$_SESSION['document_stream'] .= ""
		. "$('#"
		. $this->ClassLHS . $num
		. "').appendTo($('#"
		. $sender->uiText
		. $sender->Number
		. "'));";

		echo ""
		. "<div class='easyui-" . $this->uiText
		. "' id='"              . $this->ClassLHS . $num
		. "' style='position:relative;overflow:auto;"
		. "width:100px;height:50px;'></div>";
			

			// check, if panel div exist's
/*			$num = 0;
			while (1) {
				$str = "wipa" . $num;
				if (!in_array($str, $this::$idArray)) {
					array_push($this::$idArray, $str);
					break;
				}
				$num++;
			}
			if (($num-1) < 1) {
				echo ""
				. "<div id=\"wipa" . ($num-1)
				. "\" class=\"easyui-window\" title=\"Basic Window\" data-options=\""
				. "inline:'true',iconCls:'icon-save'\" "
				. "style=\"width:500px;height:400px;padding:0px;"
				. "\"></div>";
				
				$_SESSION['document_stream'] .= ""
				//. "$('#wipa" . ($num-1) . "').appendTo($('#qdesktop1'));"
				. "$('#wipa" . ($num-1) . "').panel('hide');";
			}*/
	}
	
	// ------------------------------------------
	// set Click event ...
	// ------------------------------------------
	public function onClick($a1) {
		if (is_callable($a1)) {
			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $this->ClassLHS
			. $this->Number . "').click(function() {"
			. $a1
			. "});";
		}
	}
	// ------------------------------------------
	// set dblClick event ...
	// ------------------------------------------
	public function onDblClick($a1) {
		if (is_string($a1)) {
			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $this->ClassLHS
			. $this->Number . "').dblclick(function() {"
			. $a1
			. "});";
		}
	}

	public function setTitle($a1) {
		return "$('#wipa0').window({title:'" . $a1 . "'});";
	}
	public function show() { return "$('#wipa0').window('show');"; }
	public function hide() { return "$('#wipa0').window('hide');"; }
	
	public function setLayout($a1,$a2) {
		if (is_string($a1) && is_int($a2)) {
			if ($this->init_layout)
			return "";
			$this->init_layout = 1;
			$str = ""
			. "$('#wipa0').panel('refresh','/pub/desk/t1.php');";
			return $str;
		}
	}
	
	// ---------------------------------------------
	// set the background of the TWindow.
	// given on parameter, it is a color, or image.
	// ---------------------------------------------
	public function setBackground() {
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($sender) = func_get_args();
			if ($sender instanceof TColor) {
				if (empty($this->Color))
					$this->Color = new TColor($sender); else
					$this->Color = $sender;

				$a1 = $sender->ColorRed;
				$a2 = $sender->ColorGreen;
				$a3 = $sender->ColorBlue;
				$a4 = $sender->ColorAlpha;
				
				//if (is_hex($a1)) $a1 = HexDec($a1);
				//if (is_hex($a2)) $a2 = HexDec($a2);
				//if (is_hex($a3)) $a3 = HexDec($a3);
				//if (is_hex($a4)) $a4 = HexDec($a3);
				
				$_SESSION['document_stream'] .= ""
				. "$('#"
				. $this->ClassLHS
				. $this->Number
				. "').css('background-color','rgb("
				. $a1 . "," . $a2 . "," . $a3
				. ")');";
			}	else
			if ($sender instanceof TImage) {
				if (empty($this->Image))
					$this->Image = $sender;
				$_SESSION['document_stream'] .= ""
				. "$('#"
				. $this->ClassLHS
				. $this->Number
				. "').css({'background-image':'url("
				. $sender->FileName
				. ")'});\n";
			}
		}
	}

	// ----------------------------
	// set panel background-color
	// ----------------------------
	public function setColor() {
		$cnt = func_num_args();
		if ($cnt == 1) {
			list($a1) = func_get_args();
			if (is_string($a1)) {
				$_SESSION['document_stream'] .= ""
				. "$('#"
				. $this->ClassLHS
				. $this->Number
				. "').css('background-color','" . $a1
				. "');";
			}
		}	else
		if ($cnt == 3) {
			list($a1,$a2,$a3) = func_get_args();
			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $this->ClassLHS
			. $this->Number
			. "').css('background-color','rgb("
			. $a1 . "," . $a2 . "," . $a3
			. ")');";
		}
	}

	// ----------------------------
	// set panel icon image
	// ----------------------------
	public function setImage($a1,$a2,$a3) {
		if (is_string($a1)) {
			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $this->ClassLHS
			. $this->Number
			. "').css({'opacity':'1.0'})"
			.   ".append('<div style=\"background-image:url("
			. $a1 . ");width:"
			. $a2 . ";height:"
			. $a3 . ";opacity:1.0;z-index:1;"
			. "\"><div style=\""
			. "position:absolute;font-weight:bold;"
			. "left:3px;bottom:0;"
			. "\">dBase4Web</div></div>');";
		}
	}
	
	public function setBackgroundNormal($a1) {
		if (is_string($a1)) {
			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $this->ClassLHS
			. $this->Number
			. "').css('background-image','url(" . $a1 . ")');";
		}
	}
	public function setBackgroundClicked($a1) {
		if (is_string($a1)) {
			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $this->ClassLHS
			. $this->Number
			. "').mousedown("
			. "function(){\$('#"
			. $this->ClassLHS . $this->Number
			. "').css('background-image','url(" . $a1 . ")');});";
		}
	}
	public function setBackgroundHover($a1,$a2) {
		if (is_string($a1)) {
			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $this->ClassLHS
			. $this->Number
			. "').hover("
			. "function(){\$('#" . $this->ClassLHS . $this->Number . "').css('background-image','url(" . $a1 . ")'); },"
			. "function(){\$('#" . $this->ClassLHS . $this->Number . "').css('background-image','url(" . $a2 . ")'); }"
			. ");";
		}
	}
	
	// ----------------------------
	// set the height of TWindow
	// ----------------------------
	public function setHeight($a1) {
		$_SESSION['document_stream'] .= ""
		. "$('#"
		. $this->ClassLHS
		. $this->Number
		. "').css({'height':'" . $a1 . "'});";
	}
	
	// ----------------------------
	// set the width of TWindow
	// ----------------------------
	public function setWidth($a1) {
		$_SESSION['document_stream'] .= ""
		. "$('#"
		. $this->ClassLHS
		. $this->Number
		. "').css({'width':'" . $a1 . "'});";
	}
	
	// ---------------------------------------------
	// set transparency (opacity) of the TWindow ...
	// ---------------------------------------------
	public function setOpacity($alpha) {
		if (is_float($alpha)) {
			$_SESSION['document_stream'] .= ""
			. "$('#"
			. $this->ClassLHS
			. $this->Number
			. "').css({'opacity':'"
			. $alpha
			. "'});";
		}
	}
	
	public function setMoveable($flag) {
		$str = "true";
		if ($flag == true)
			$str   = "enable"; else
			$str   = "disable";
		
		$_SESSION['document_stream'] .= ""
			. "$('#"
			. $this->ClassLHS
			. $this->Number
			. "').draggable('" . $str . "');";
	}
	
	public function __destruct() {
		parent::__destruct();
	}
}

// -------------------------------------------------------
// class TPanel: represents a application panel
// -------------------------------------------------------
class TPanel extends TBrush
{
	public $Overflow = null;
	//
	public $Rect    = null;
	public $Margin  = null;

	public function __construct() {
		$cnt = func_num_args();
		list($sender) = func_get_args();
		parent::__construct($sender);
		
		$this->setClassParent ( $sender );
		$this->setClassName   ("TPanel" );
		$this->setClassID     ("qpanel" );
		
		if (empty($this -> Margin)) { $this -> Margin = new TMargin(20,20,20,20); }
		if (empty($this -> Rect  )) { $this -> Rect   = new TRect  (20,20,20,20); }
	}

	public function setOverflow($a1) {
		$this->Overflow = $a1;
	}
	
	public function setPosition($a1) {
		$this->Position = $a1;
	}
	
	public function __destruct() {
		parent::__destruct();
	}
}
