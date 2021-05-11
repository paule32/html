<?php
require_once ( "t_css.php" )
?>
<div id="win1" class="easyui-panel" border="false"
style="position:relative;
width:100%;
height:100%;
overflow:auto;
visibility:hidden;
background:transparent;">
	<div id="win1win1" style="
visibility:hidden;"
class="easyui-window" data-options="title:'Inline Window',inline:true" style="width:250px;height:150px;padding:10px">
		<secret>This window stay inside its parent</secret>
	</div>
</div>

<script>
$.fn.window.defaults.onMinimize = function(){
	var title = $(this).window('options').title;
	var s = $('<div class="ws"></div>').appendTo($('div#tb_buttons_')).html(title);
	s.hover(
		function(){$(this).addClass('ws-over')},
		function(){$(this).removeClass('ws-over')}
	);
	s.bind('click', {w:this}, function(e){
		$(e.data.w).window('open');
		s.remove();
	});
};
$("#win1").appendTo($("#deskwin1_"));
$("#win1").css('visibility','visible');
$("#win1win1").css('visibility','visible');
$("secret").css('opacity','1.0');
</script>