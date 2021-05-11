
<div id="appw" class="easyui-window"
data-options="title:'Inline Window'"
style="top:100px;left:100px;width:550px;height:320px;padding:10px;">
	<div class="easyui-layout" fit="true" style="margin:0;padding:0;">
		<div data-options="region:'north'" border="false">
			<div class="easyui-panel">
				<a href="#" class="easyui-menubutton" data-options="menu:'#mm1',iconCls:'icon-edit'">Edit</a>
				<a href="#" class="easyui-menubutton" data-options="menu:'#mm2',iconCls:'icon-help'">Help</a>
			</div>
			<div id="mm1" style="width:150px;">
				<div data-options="iconCls:'icon-undo'">Undo</div>
				<div data-options="iconCls:'icon-redo'">Redo</div>
				<div class="menu-sep"></div>
				<div>Cut</div>
				<div>Copy</div>
				<div>Paste</div>
			</div>
			<div id="mm2" style="width:100px;">
				<div>Help</div>
				<div>Update</div>
				<div>About</div>
			</div>
		</div>
		<div data-options="region:'west'" split="true" style="width:120px;height:100px;">
			<ul class="easyui-tree">
				<li>
					<span>class's</span>
					<ul>
						<li><span>Form1</span></li>
						<li><span>Form2</span></li>
					</ul>
				</li>
				<li>
					<span>procedure's</span>
					<ul>
						<li><span>Form1</span></li>
						<li><span>Form2</span></li>
					</ul>
				</li>
				<li>
					<span>function's</span>
					<ul>
						<li><span>Form1</span></li>
						<li><span>Form2</span></li>
					</ul>
				</li>
				<li>
					<span>variable's</span>
					<ul>
						<li><span>Form1</span></li>
						<li><span>Form2</span></li>
					</ul>
				</li>
			</ul>
		</div>
		<div region="center" border="false">
			<div class="easyui-tabs" fit="true">
				<div title="Source">
					<style type="text/css">
						#editor {
							margin: 0;
							position: absolute;
							top: 36px;
							bottom: 5px;
							left: 5px;
							right: 5px;
						}
					</style>
					<pre id="editor">function() {
					</pre>
					<script src="/tools/ace/ace.js" type="text/javascript" charset="utf-8"></script>
					<script>
						var editor = ace.edit("editor");
						editor.setTheme("ace/theme/clouds");
						editor.session.setMode("ace/mode/javascript");
					</script>
				</div>
				<div title="View">
					blah
				</div>
			</div>
		</div>
		<div region="south" border="false">
			<div class="easyui-layout" fit="true" style="margin:0;padding:0;height:30px;">
				<div data-options="region:'west'" border="false" style="width:200px;">
					<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'">New</a>
					<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-save'">Save</a>
				</div>
				<div data-options="region:'east'" border="false" style="width:84px;">
					<a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-add'">Run...</a>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function parsecode() {
}
/*
$("#appw").window({
	onClose: function() {
		appw = 0;
		$("#appw").remove();
	},
});
*/

//$('#loader').hide();
//$('#place' ).show();

//$("#myeditor").appendTo($("#deskwin1_"));
</script>