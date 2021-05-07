<?php
// ------------------------------------------------------
// File    : /tools/pub/head.php
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// ------------------------------------------------------
// web-pages must be always start by session !
// -----------------------------------------------
@session_start();
?>
<!doctype html>
<html lang='en'>
<head>
	<meta charset="utf-8">
 
	<meta name="author"      content="Jens Kallup [paule32]">
	<meta name="copyright"   content="Jens Kallup">
	<meta name="keywords"    content="kallup, css, html, theme, desktop, windows, xp">
	<meta name="description" content="A Windows XP desktop in HTML, CSS and JavaScript">
	<meta name="robots" 	 content="index, nofollow">

	<meta http-equiv="content-type"    content="text/html; charset=utf-8">
	<meta http-equiv="expires"         content="0">
	<meta http-equiv="cache-control"   content="max-age=0">
	<meta http-equiv="cache-control"   content="no-cache">
	<meta http-equiv="pragma"          content="no-cache">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<link rel="icon"       type="image/png" href="/pub/favicon.png">
	<link rel="stylesheet" type="text/css"  href="/pub/desk/bootxp/css/bootxp.css">
	
	<title>Booting Windows XP</title>
</head>
<body style="padding:0px 0px 0px 0px;">
<script type="text/javascript">
<?php
	if (!isset($_REQUEST['bw_username'])
	||  !isset($_REQUEST['bw_password']))
	{
		echo "<script type='text/javascript'>window.location = '/pub';</script>";
		die();
	}
?>
var makeTimerTimeOut = 2;
function makeTimer() {
    if (--makeTimerTimeOut == 0)
	window.location.assign("/pub/desk/index.php" + <?php echo   "\""
	. "?bw_username=" . $_REQUEST['bw_username']
	. "&bw_password=" . $_REQUEST['bw_password'] . "\");";?>
}
setInterval(function() { makeTimer(); }, 1000);
</script>

<h1><span></span>Microsoft Windows XP Professional</h1>
<p id="copyright"><span></span>Copyright &copy; 1985-2001 Microsoft Corporation</p>
<p id="logo"><span></span>Microsoft</p>

</body>
</html>
