<?php
// ------------------------------------------------------
// File    : /pub/desk/EmitCode.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once("TDevice.php");
require_once("TDesktopWindow.php");
require_once("TScreen.php");

// -------------------------------------
// create end sources:
// -------------------------------------
function EmitCode($root)
{
	$class   = get_class($root);
	$parent  = $root;
	$str     = "";		// output generated string
	$eol     = ";\n";
	
	// start traverse:
	$str .= "<div id='container' style='position:absolute; margin-top: 0px;'>";
	switch ($class) {
		case 'TDevice':
			$str .= "<div id='"
			. $parent->ClassID
			. $parent->ClassHandle
			. "' style='position:absolute; margin: 0px;'>";
			// ---- //
			$parent = $parent->ClassParent;
			$class  = get_class($parent);
			switch ($class) {
				case 'TDesktopWindow':
				{
					$desk_parent = $parent;
					
					$parent = $parent->ClassParent;
					$class  = get_class($parent);
					switch ($class) {
						case 'TScreen':
							$str .= "<div id='"
							. $parent->ClassID
							. $parent->ClassHandle
							. "' style='";
							// ---- //
							$par    = $parent;
							$parent = $par->Margin;
							if (!empty($parent)) {
								$str .= ""
								. "margin-left:   " . $parent->Left   . $eol
								. "margin-top:    " . $parent->Top    . $eol
								. "margin-right:  " . $parent->Right  . $eol 
								. "margin-bottom: " . $parent->Bottom . $eol;
							}
							
							$parent = $par->Padding;
							if (!empty($parent)) {
								$str .= ""
								. "padding-left:   " . $parent->Left   . $eol
								. "padding-top:    " . $parent->Top    . $eol
								. "padding-right:  " . $parent->Right  . $eol
								. "padding-bottom: " . $parent->Bottom . $eol;
							}

							$parent = $par->Visual;
							if (!empty($parent)) {
								$str .= ""
								. "width:  " . $parent->Width  . $eol
								. "height: " . $parent->Height . $eol;
							}
							
							$parent = $par;
							if (!empty($parent->Position)) {
								$str .= ""
								. "position: " . $parent->Position . $eol;
							}
							
							$parent = $par->Color;
							if (!empty($parent)) {
								$str .= ""
								. "background-color: rgb("
								. $parent->ColorRed   . ", "
								. $parent->ColorGreen . ", "
								. $parent->ColorBlue  . ")" . $eol;
							}
							
							$parent = $par->Image;
							if (!empty($parent)) {
								$str .= ""
								. "background-image: url("
								. $parent->File->FileName . ")"
								. $eol;
								
								if (!empty($parent->Size)) {
									$str .= ""
									. "background-size: "
									. $parent->Size
									. $eol;
								}
							}
							$str .= "'>";
						break;
					}
					$str .= "</div>";
				}
				// ------- //
				{
					$str .= "<div id='"
					. $desk_parent->ClassID
					. $desk_parent->ClassHandle
					. "' style='";
					if (!empty($desk_parent->Rect)) {
						$str .= "position:absolute; background-color:red; "
						. "margin-left:   " . $desk_parent->Rect->Left   . $eol
						. "margin-top:    " . $desk_parent->Rect->Top    . $eol
						. "margin-right:  " . $desk_parent->Rect->Right  . $eol 
						. "margin-bottom: " . $desk_parent->Rect->Bottom . $eol
						
						// customized ! 
						. "width: calc(100vw - " . $desk_parent->Rect->Right  . ")" . $eol
						. "height:calc(100vh - " . $desk_parent->Rect->Bottom . ")" . $eol
						
						// transparency:
						. "opacity: " . $desk_parent->Opacity . $eol;
					}
					$str .= "'></div>\n";
				}
				break;
			}
			$str .= "</div>\n";
		break;
	}
	$str .= "</div>\n";
	
	echo "\n\n" . $str . "\n\n";
	
	// last step: bring all together:
	//WriteBodyContent();
}

?>
