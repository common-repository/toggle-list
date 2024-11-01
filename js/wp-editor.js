(function() {
	tinymce.PluginManager.add('simpletree', function( editor, url ) {
		editor.addButton('simpletree', {
			text: '',
			icon: 'icon dashicons-plus',
			onclick: function(e) {
				if( !tinyMCE.activeEditor.selection.getContent() ) {
					alert('Please select list item text.');
				} else {
					editor.insertContent('<a class="toggler fa-right-open">' + tinyMCE.activeEditor.selection.getContent() + '</a>');
				}
			}
		});
	});
})();