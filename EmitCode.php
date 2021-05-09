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
	$class_str = get_class($root);
	$class_obj = $root;
	$parent    = $root;
	
	$str     = "";		// output generated string
	$eol     = ";\n";
	
	$current_str   = "";       // string: html
	$current_class = null;     // code information's
	$counter       = 0;        // array counter;
	
	$ident = "\t";
	
	static $Screens = 0;
	
	// start traverse:
	//echo "<pre><code class='language=php'>";
	$current_str .= ""
	. "<div id='container' style='\n"
	. $ident . "position: absolute" . $eol
	. $ident . "margin-top: 0px"    . $eol;
	switch ($class_str) {
		case 'TDevice':
			if (!empty($class_obj -> Objects)) {
				$counter = 0;
				foreach($class_obj -> Objects as $obj_1) {
					if (!empty ($obj_1 -> Objects)) {
						foreach($obj_1 -> Objects as $obj_2) {
							if ($Screens < 1) {
								if ($obj_2 instanceof TScreen) {
									$Screens++;
									if (!empty($obj_2 -> Position)) {
										$current_str .= ""
										. $ident . "position: "
										. $obj_2->Position
										. $eol;
									}
									if (!empty($obj_2 -> Overflow)) {
										$current_str .= ""
										. $ident . "overflow: " . $obj_2 -> Overflow
										. $eol;
									}
									if (!empty($obj_2 -> Rect)) {
										if (!empty( $obj_2 -> Rect -> Width)) {
											$current_str .= ""
											. $ident . "width:  " . $obj_2 -> Rect -> Width . $eol;
										}
										if (!empty( $obj_2 -> Rect -> Height)) {
											$current_str .= ""
											. $ident . "height:  " . $obj_2 -> Rect -> Height . $eol;
										}
									}
									if (!empty($obj_2 -> Margin)) {
										$current_str .= ""
										. $ident . "margin-top:    " . $obj_2 -> Margin -> Top    . $eol
										. $ident . "margin-left:   " . $obj_2 -> Margin -> Left   . $eol
										. $ident . "margin-right:  " . $obj_2 -> Margin -> Right  . $eol
										. $ident . "margin-bottom: " . $obj_2 -> Margin -> Bottom . $eol;
									}
									if (!empty($obj_2 -> Padding)) {
										$current_str .= ""
										. $ident . "padding-top:    " . $obj_2 -> Padding -> Top    . $eol
										. $ident . "padding-left:   " . $obj_2 -> Padding -> Left   . $eol
										. $ident . "padding-right:  " . $obj_2 -> Padding -> Right  . $eol
										. $ident . "padding-bottom: " . $obj_2 -> Padding -> Bottom . $eol;
									}
									if (!empty($obj_2 -> Color)) {
										$current_str .= ""
										. $ident . "background-color: rgb("
										. $current_class -> Color -> ColorRed   . ", "
										. $current_class -> Color -> ColorGreen . ", "
										. $current_class -> Color -> ColorBlue  . ")"
										. $eol;
									}
									if (!empty($obj_2 -> Image)) {
										$current_str .= ""
										. $ident . "background-image: url(\""
										.          $obj_2 -> Image -> FileName
										.          "\")"
										. $eol;
									}
									if (!empty($obj_2 -> Image -> Size)) {
										$current_str .= ""
										. $ident . "background-size: "
										. $obj_2 -> Image -> Size
										. $eol;
									}
								}
								// TScreen []
								$current_str .= "'>";
							}
						}
					}
				}
								
				foreach($class_obj->Objects as $obj) {
					$current_class = $obj;
					
					// -------------------------------------------
					// TDesktopWindow:
					// -------------------------------------------
					if ($current_class instanceof TDesktopWindow) {
						$current_str .= ""
						. $ident . "<div id='"
						. $obj -> ClassID
						//. $obj :: $ClassHandle
						. "' style='\n";
						
						// -------------------------------------------
						// TDesktopWindow -> Position:
						// -------------------------------------------
						if (!empty($current_class -> Position)) {
							$current_str .= ""
							. $ident . "position: " . $current_class -> Position . $eol;
						}
						
						// -------------------------------------------
						// TDesktopWindow -> Margin:
						// -------------------------------------------
						if (!empty($current_class -> Margin)) {
							$current_str .= ""
							. $ident . "margin-left:   " . $current_class -> Margin -> Left   . $eol
							. $ident . "margin-top:    " . $current_class -> Margin -> Top    . $eol
							. $ident . "margin-right:  " . $current_class -> Margin -> Right  . $eol 
							. $ident . "margin-bottom: " . $current_class -> Margin -> Bottom . $eol;
						}
						
						if (!empty($current_class -> Rect)) {
							$current_str .= ""
							. $ident . "width:  " . $current_class -> Rect -> Width  . $eol
							. $ident . "height: " . $current_class -> Rect -> Height . $eol;
							
							//. $ident . "width: calc(100vw - " . $current_class -> Rect -> Width  . ")" . $eol
							//. $ident . "height:calc(100vh - " . $current_class -> Rect -> Height . ")" . $eol;
						}
						
						// -------------------------------------------
						// TDesktopWindow -> Background -> Color:
						// -------------------------------------------
						if (!empty($current_class -> Color)) {
							$current_str .= ""
							. $ident . "background-color: rgb("
							. $current_class -> Color -> ColorRed   . ", "
							. $current_class -> Color -> ColorGreen . ", "
							. $current_class -> Color -> ColorBlue  . ")"
							. $eol;
						}
						
						// -------------------------------------------
						// TDesktopWindow -> Background -> Image:
						// -------------------------------------------
						if (!empty($current_class -> Image)) {
							$current_str .= ""
							. $ident . "background-image: url("
							.          $current_class -> Image -> FileName
							.          ")"
							. $eol;
						
							// -----------------------------------------------
							// TDesktopWindow -> Background -> Image -> Size:
							// -----------------------------------------------
							if (!empty($current_class -> Image -> Size)) {
								$current_str .= ""
								. $ident . "background-size: '"
								.          $current_class->Image->Size
								.          "')"
								. $eol;
							}
						}

						// -------------------------------------------
						// TDesktopWindow -> Transparency:
						// -------------------------------------------
						if (!empty($current_class -> Opacity)) {
							$current_str .= ""
							. $ident . "opacity: " . $current_class -> Opacity . $eol;
						}
						
						// -------------------------------------------
						// TDesktopWindow -> Overflow:
						// -------------------------------------------
						if (!empty($current_class -> Overflow)) {
							$current_str .= ""
							. $ident . "overflow: " . $current_class -> Overflow . $eol;
						}
						
						// -------------------------------------------
						// TDesktopWindow -> Padding:
						// -------------------------------------------
						if (!empty($current_class -> Padding)) {
							$current_str .= ""
							. $ident . "padding-left:   " . $current_class -> Padding -> Left   . $eol
							. $ident . "padding-top:    " . $current_class -> Padding -> Top    . $eol
							. $ident . "padding-right:  " . $current_class -> Padding -> Right  . $eol 
							. $ident . "padding-bottom: " . $current_class -> Padding -> Bottom . $eol;
						}
						
						$current_str .= $ident . "'></div>\n";
					}
				}
			}
		break;
	}
	$current_str .= "</div>";
	
	echo $current_str;
	//echo htmlspecialchars($current_str, ENT_HTML5 );
	
	
	//echo "</code></pre>";
		
	// last step: bring all together:
	//WriteBodyContent();
}

?>
