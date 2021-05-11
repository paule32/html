<?php
ob_start();
require_once ( __DIR__ . "./assets/php/t_head.php" );
$contents = ob_get_contents();
ob_end_clean();

echo $contents;
?>