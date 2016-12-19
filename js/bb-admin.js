var htmlEditor = ace.edit("bb_code_html");
htmlEditor.setTheme("ace/theme/twilight");
htmlEditor.getSession().setMode("ace/mode/html");
document.getElementById('bb_code_html').style.fontSize='16px';

htmlEditor.getSession().on('change', function(e) {
	var editorContent = htmlEditor.getValue();
	var input = document.getElementById('bb_html');

	input.value = editorContent;
});


var cssEditor = ace.edit("bb_code_css");
cssEditor.setTheme("ace/theme/twilight");
cssEditor.getSession().setMode("ace/mode/css");
document.getElementById('bb_code_css').style.fontSize='16px';

cssEditor.getSession().on('change', function(e) {
	var editorContent = cssEditor.getValue();
	var input = document.getElementById('bb_css');

	input.value = editorContent;
});


var scssEditor = ace.edit("bb_code_scss");
scssEditor.setTheme("ace/theme/twilight");
scssEditor.getSession().setMode("ace/mode/scss");
document.getElementById('bb_code_scss').style.fontSize='16px';

scssEditor.getSession().on('change', function(e) {
	var editorContent = scssEditor.getValue();
	var input = document.getElementById('bb_scss');

	input.value = editorContent;
});


var jsEditor = ace.edit("bb_code_js");
jsEditor.setTheme("ace/theme/twilight");
jsEditor.getSession().setMode("ace/mode/javascript");
document.getElementById('bb_code_js').style.fontSize='16px';

jsEditor.getSession().on('change', function(e) {
	var editorContent = jsEditor.getValue();
	var input = document.getElementById('bb_js');

	input.value = editorContent;
});