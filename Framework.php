<?php
// ------------------------------------------------------
// File    : /pub/desk/Framework.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

// -----------------------------------------------
// initial variables ...
// -----------------------------------------------
$_SESSION['document_stream'] = "";
$_SESSION['ClassRegister'  ] = array(); 	// default suported classes

require_once("Utils.php");
require_once("EmitCode.php");

// -----------------------------------------------
// RegisterClass: register classes to be in use
// in the class system.
// -----------------------------------------------
function RegisterClass($class) {
	if (is_array($class)) {
		$_SESSION['ClassRegister'] += $class;
	}	else
	if (is_string($class)) {
		if (!in_array($class,
				   $_SESSION['ClassRegister']));
		array_push($_SESSION['ClassRegister'],$str);
	}
}

// -------------------------------------
// initialize framework ...
// -------------------------------------
function InitializeFrameWork()
{
	// -------------------------------------
	// invoke default classes:
	// -------------------------------------
	RegisterClass([
		"TObject",			// base of all classes
		"TLocales", 		// international locales
		"TException",		// exception handling
		"TDevice",			// device: TScreen, TPrinter, ...
		"TKeyboard",		// input device: keyboard
		"TScreen",			// output device: screen
		"TPrinter", 		// output device: printer
		"TControl", 		// gui controls
		"TPanel",			// panel
		"TWindow",			// window
		"TButton",			// window: button
	]);
}

// -------------------------------------
// write body header ...
// -------------------------------------
function WriteBodyContent()
{
	echo ""
	. "<div id='container'></div>"
	. "<script>"
	. "$(document).ready(function(){" . $_SESSION['document_stream']
	. "});"
	. "</script>"
	. "</body></html>";
}

function MainEntryPoint()
{
	$my_app = new TApplication();
	$my_app->exec();
}

?>