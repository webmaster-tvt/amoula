( function( $ ) {
	
	// Export code
	$( document ).on( 'click', 'input[name=pofo-export-button]', function() {
		window.location.href = pofoImport.customizeurl + '?pofo-export=' + pofoImport.exportnonce;
	});

	// Import code
	$( document ).on( 'click', 'input[name=pofo-import-button]', function() {
		var form		= $( '<form class="pofo-form" method="POST" enctype="multipart/form-data"></form>' ),
			controls	= $( '.pofo-import-controls' );

		if ( '' == $( 'input[name=pofo-import-file]' ).val() ) {
			alert( pofoImport.blankFileError );
		}
		else {
			if ( $( 'input[name=pofo-import-file]' ).val().match( '.json$', 'i' ) ) {

				$( window ).off( 'beforeunload' );
				$( 'body' ).append( form );
				form.append( controls );
				$( '.pofo-uploading' ).show();
				form.submit();
			} else {
				alert( pofoImport.validFileError );
			}
		}
	});

})( jQuery );