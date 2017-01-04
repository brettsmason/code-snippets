var htmlEditor = ace.edit("cs-code-html");
htmlEditor.setTheme("ace/theme/twilight");
htmlEditor.getSession().setMode("ace/mode/html");
document.getElementById('cs-code-html').style.fontSize='16px';

htmlEditor.getSession().on('change', function(e) {
	var editorContent = htmlEditor.getValue();
	var input = document.getElementById('cs-html');

	input.value = editorContent;
});


var cssEditor = ace.edit("cs-code-css");
cssEditor.setTheme("ace/theme/twilight");
cssEditor.getSession().setMode("ace/mode/css");
document.getElementById('cs-code-css').style.fontSize='16px';

cssEditor.getSession().on('change', function(e) {
	var editorContent = cssEditor.getValue();
	var input = document.getElementById('cs-css');

	input.value = editorContent;
});


var scssEditor = ace.edit("cs-code-scss");
scssEditor.setTheme("ace/theme/twilight");
scssEditor.getSession().setMode("ace/mode/scss");
document.getElementById('cs-code-scss').style.fontSize='16px';

scssEditor.getSession().on('change', function(e) {
	var editorContent = scssEditor.getValue();
	var input = document.getElementById('cs-scss');

	input.value = editorContent;
});


var jsEditor = ace.edit("cs-code-js");
jsEditor.setTheme("ace/theme/twilight");
jsEditor.getSession().setMode("ace/mode/javascript");
document.getElementById('cs-code-js').style.fontSize='16px';

jsEditor.getSession().on('change', function(e) {
	var editorContent = jsEditor.getValue();
	var input = document.getElementById('cs-js');

	input.value = editorContent;
});