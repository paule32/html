<?php
// ------------------------------------------------------
// File    : /pub/desk/TDispatchEvents.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

function DispatchEvents($handler)
{
	$eventstr = "";
	$codestr  = ""
	. "$(document).ready(function() {"
	. "console.log('ready.');";
	
	echo "<pre>";
	//print_r($handler);
	
	if (is_array($handler)) {
		foreach ($handler as $event) {
			if (is_array($event)) {
				$action = "";
				// -------------------------
				// string: event name:
				// -------------------------
				if (is_string($event[0])) {
					$eventstr = strtolower($event[0]);
					$eventarr = [        // white-list
						'onclick'     ,  // mouse button click
						'ondbclick'   ,  // mouse button double click
						'onhover'     ,  // mouse over object -> hover
						'onload'      ,  // see: load picture
						'onmousedown' ,  // mouse button down
						'onmousemove' ,  // mouse move over object
						'onmouseup'   ,  // mouse button up
					];
					if (in_array($eventstr, $eventarr)) {
						$ex = new TExceptio("event: '" . $eventstr . "' not available.");
						unset($codestr);	// garbage collector
						unset($eventstr);
						return;
						// todo: error msg.
					}
					$prefix = "on";
					if (strpos($eventstr, $prefix) === 0) $eventstr =
						substr($eventstr, strlen($prefix));
				}	else {
					unset($codestr);	// garbage collector
					unset($eventstr);
					return;
					// todo: error msg.
				}
				// -------------------------
				// callback: event($this);
				// -------------------------
				if ($event[1] instanceof Closure) {
				}	else {
					unset($codestr);	// garbage collector
					unset($eventstr);
					return;
					// todo: error msg.
				}
				
				// -------------------------
				// instance of object
				// -------------------------
				if (!empty($event[2]))
				{
					// ------------------------------------------
					// execute handler, to collect informations
					// about the application structrure:
					// ------------------------------------------
					$event[1]($event[2]);
					
					$class = get_class($event[2]);
					switch ($class) {
						case 'TDesktopWindow':
						break;
					}
				}	else {
					// todo: error msg.
				}
			}	else {
				unset($codestr);	// garbage collector
				unset($eventstr);
				return;
				// todo: error msg.
			}
		}
	}	else {
		unset($codestr);	// garbage collector
		unset($eventstr);
		return;
		// todo: error msg.
	}
	
	unset($eventstr);	// garbage collector
	return $codestr .= "});";
}

?>