dataJsonEditor_729ee6af = new JSONEditor(document.getElementById('data-json-editor'), {"mode":"tree","onChange":function() {jQuery('#data').val(dataJsonEditor_729ee6af.getText());}});
dataJsonEditor_729ee6af.set({"script":"\u003Cscript\u003Ealert(\u0022XSS\u0022);\u003C\/script\u003E"});
jQuery('#data').parents('form').submit(function() {jQuery('#data').val(dataJsonEditor_729ee6af.getText());});