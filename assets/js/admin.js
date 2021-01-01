jQuery( document ).ready( function ( $ ) {
	$( '.lyrico-dynamic-multiple-select' ).select2( {
		tags: true,
	} );

	$( '.lyrico-primary-artist-select' ).select2( {
		allowClear: true,
		debug: true,
		placeholder: 'Select Primary Artist',
	} );
	$( '.lyrico-album-select' ).select2( {
		allowClear: true,
		debug: true,
		placeholder: 'Select Album',
	} );

	$( function () {
		$( "#lyrico-tabs" ).tabs();
	} );
	// multiple select with AJAX search
	$( '.lyrico-other-artists-select' ).select2( {
		placeholder: 'Other Artists',
		ajax: {
			url: ajaxurl,
			dataType: 'json',
			delay: 250, // delay in ms
			data: function ( params ) {
				return {
					q: params.term, // search query
					action: 'lyricogetartists' // AJAX action for admin-ajax.php
				};
			},
			processResults: function ( data ) {
				var options = [];
				if ( data ) {

					// data is the array of arrays, and each of them contains ID and the Label of the option
					$.each( data, function ( index, text ) { // do not forget that "index" is just auto incremented value
						options.push( {
							id: text[ 0 ],
							text: text[ 1 ]
						} );
					} );

				}
				return {
					results: options
				};
			},
			cache: true
		},
		//	minimumInputLength: 3 // the minimum of symbols to input before perform a search
	} );


} );