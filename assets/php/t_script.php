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

function encode_utf8(s) {
return unescape(encodeURIComponent(s));	}

function decode_utf8(s) {
return decodeURIComponent(escape(s));	}
	
$.extend($.fn.window.methods, {
	hide: function(jq){
		return jq.each(function(){
			var w = $(this);
			var state = w.data('window');
			state.window.hide();
			if (state.shadow){state.shadow.hide();}
			if (state.mask){state.mask.hide();}
		})
	},
	show: function(jq){
		return jq.each(function(){
			var w = $(this);
			var state = w.data('window');
			state.window.show();
			if (state.shadow){state.shadow.show();}
			if (state.mask){state.mask.show();}
		})
	}
});

</script>