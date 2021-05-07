<?php
// ------------------------------------------------------
// File    : /pub/desk/Utils.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

// ----------------------------------------
// The perfect way to check HEX string ...
// ----------------------------------------
function is_hex($hex_code) {
	return @preg_match("/^[a-f0-9]{2,}$/i",
	$hex_code) && !(strlen($hex_code) & 1);
}

?>
