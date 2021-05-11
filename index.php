<?php
// ------------------------------------------------------
// File    : /pub/desk/index.php
//
// Autor   : Jens Kallup <kallup.jens@web.de> - paule32
// License : (c) kallup.net - non-profit - 2021
// -----------------------------------------------------

require_once ( "Framework.php" );
require_once ( "TDesktopIcon.php" );
require_once ( "t_head.php" );
require_once ( "./assets/php/t_css.php" );
require_once ( "./assets/php/t_script.php" );

// -------------------------------------
// create a screen desktop ...
// -------------------------------------
InitializeFrameWork();    // init stuff
$utils = new TUtils();

$my_screen = new TScreen("100vw","100vh");
$my_screen->setObjectName("screen1");
$my_screen->setOverflow("hidden");
$my_screen -> Margin -> setRect(0,0,0,0);
$my_screen -> Rect   -> setWidth ("100vw");
$my_screen -> Rect   -> setHeight("100vh");
$my_screen->setImage("background.jpg");
$my_screen->setImageSize("cover");

$my_desktop = new TDesktopWindow($my_screen);	// desk-window: icon's
$my_desktop->setObjectName("deskwin1");
$my_desktop->setOverflow("auto");
$my_desktop -> Margin -> setRect(15,15,15,15);
$my_desktop -> Rect   -> setWidth ("calc(100vw -  30px)");
$my_desktop -> Rect   -> setHeight("calc(100vh - 60px)");
//$my_desktop->setColor(200,200,200);
//$my_desktop->setOpacity(0.5);

$my_taskbar = new TDesktopWindow($my_screen);	// task-bar: window's
$my_taskbar->setObjectName("deskwin2");
$my_taskbar->setOverflow("auto");
$my_taskbar->setPosition("fixed");
$my_taskbar -> Margin -> setRect(0,-15,0,0);
$my_taskbar -> Rect   -> setWidth ("100vw");
$my_taskbar -> Rect   -> setHeight(((15*2) + 15));
$my_taskbar->setColor(10,10,110);
$my_taskbar->setOpacity(1);

$my_tb_start_btn = new TDesktopWindow($my_taskbar);
$my_tb_start_btn->setObjectName("startbutton1");
$my_tb_start_btn->setPosition("absolute");
$my_tb_start_btn -> Margin -> setRect(10,-10,5,10);
$my_tb_start_btn -> Rect   -> setWidth (104);
$my_tb_start_btn -> Rect   -> setHeight(40);

$evt_on_load  = function($sender) use($utils) { $utils -> setImage ($sender, "img/startButtonNormal.png"); };
$evt_on_hover = function($sender) use($utils) { $utils -> setImage ($sender, "img/startButtonHover.png" ); };
$evt_on_click = function($sender) use($utils) { $utils -> setImage ($sender, "img/startButtonClick.png" ); };
$evt_on_mmove = function($sender) use($utils) { $utils -> setImage ($sender, "img/startButtonNormal.png"); };

// ---------------------------------------------------
// array collection of object handler:
// ---------------------------------------------------
$event_handler = [
	["onLoad"     , $evt_on_load , $my_tb_start_btn ],
	["onHover"    , $evt_on_hover, $my_tb_start_btn ],
	["onClick"    , $evt_on_click, $my_tb_start_btn ],
	["onMouseMove", $evt_on_mmove, $my_tb_start_btn ]
];
DispatchEvents($event_handler);

$my_tb_buttons = new TDesktopWindow($my_taskbar);
$my_tb_buttons->setObjectName("tb_buttons");
$my_tb_buttons->setPosition("absolute");
$my_tb_buttons->Margin -> setRect(124,-8,4,4);
$my_tb_buttons->Rect   -> setWidth ("calc(100vw - 148px)");
$my_tb_buttons->Rect   -> setHeight(40);

// ---------------------------------------------------
// array collection of desk+task window on screen ...
// ---------------------------------------------------
$my_desk = [
	$my_desktop,		// invisible desktop window
	$my_taskbar,		// taskbar at bottom (default)
	$my_tb_start_btn,	// the application start-button
	$my_tb_buttons		// room for sticky windows
];
$my_device  = new TDevice($my_desk);	// screen

EmitCode($my_device);					// final stage:

// ---------------------------------------------------
// fancy the desktop arrangement:
// ---------------------------------------------------
echo '<div id="win1" class="easyui-panel" border="false" '
. 'style="'
. 'top:100px;'
. 'width:100%;'
. 'height:100%;'
. 'overflow:hidden;'
. 'background:transparent;"></duv>';


// ---------------------------------------------------
// application icons:
// ---------------------------------------------------
$my_dbase4web = new TDesktopIcon($my_desktop);
$my_dbase4web->setObjectName("desk_icon_dbase4web");
$my_dbase4web->isDrawable( true ); // item can be moved in browser mouse area

$icon_on_load  = function($sender) use($utils) { $utils -> setImage ($sender, "img/buttons/monster.png"); };
$icon_on_hover = function($sender) use($utils) { $utils -> setImage ($sender, "img/buttons/monster.png"); };

// ---------------------------------------------------
// array collection of icons object handler:
// ---------------------------------------------------
$event_handler2 = [
	["onLoad" , $icon_on_load , $my_dbase4web ],
	["onHover", $icon_on_hover, $my_dbase4web ],
];
//DispatchEvents($event_handler2);


// just a catch test - should open window
//$im = null;
//$im->zz = 1;

?>