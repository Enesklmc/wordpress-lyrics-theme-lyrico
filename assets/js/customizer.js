jQuery( document ).ready( function ( $ ) {
	"use strict";

	$( '.lyrico-device-select-tabs' ).tabs( {
		show: {
			effect: "fade",
			duration: 150
		}
	} );

	/**
	 * Slider Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */

	// Set our slider defaults and initialise the slider
	$( '.slider-custom-control' ).each( function () {
		var sliderValue = $( this ).find( '.customize-control-slider-value' ).val();
		var newSlider = $( this ).find( '.slider' );
		var sliderMinValue = parseFloat( newSlider.attr( 'slider-min-value' ) );
		var sliderMaxValue = parseFloat( newSlider.attr( 'slider-max-value' ) );
		var sliderStepValue = parseFloat( newSlider.attr( 'slider-step-value' ) );

		newSlider.slider( {
			value: sliderValue,
			min: sliderMinValue,
			max: sliderMaxValue,
			step: sliderStepValue,
			change: function ( e, ui ) {
				// Important! When slider stops moving make sure to trigger change event so Customizer knows it has to save the field
				$( this ).parent().find( '.customize-control-slider-value' ).trigger( 'change' );
			}
		} );
	} );

	// Change the value of the input field as the slider is moved
	$( '.slider' ).on( 'slide', function ( event, ui ) {
		$( this ).parent().find( '.customize-control-slider-value' ).val( ui.value );
	} );

	// Reset slider and input field back to the default value
	$( '.slider-reset' ).on( 'click', function () {
		var resetValue = $( this ).attr( 'slider-reset-value' );
		$( this ).parent().find( '.customize-control-slider-value' ).val( resetValue );
		$( this ).parent().find( '.slider' ).slider( 'value', resetValue );
	} );

	// Update slider if the input field loses focus as it's most likely changed
	$( '.customize-control-slider-value' ).blur( function () {
		var resetValue = $( this ).val();
		var slider = $( this ).parent().find( '.slider' );
		var sliderMinValue = parseInt( slider.attr( 'slider-min-value' ) );
		var sliderMaxValue = parseInt( slider.attr( 'slider-max-value' ) );

		// Make sure our manual input value doesn't exceed the minimum & maxmium values
		if ( resetValue < sliderMinValue ) {
			resetValue = sliderMinValue;
			$( this ).val( resetValue );
		}
		if ( resetValue > sliderMaxValue ) {
			resetValue = sliderMaxValue;
			$( this ).val( resetValue );
		}
		$( this ).parent().find( '.slider' ).slider( 'value', resetValue );
	} );

	/**
	 * Googe Font Select Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */

	$( '.google-fonts-list' ).each( function ( i, obj ) {
		if ( !$( obj ).hasClass( 'select2-hidden-accessible' ) ) {
			$( obj ).select2();
		}
	} );

	$( '.google-fonts-list' ).on( 'change', function () {
		var elementRegularWeight = $( this ).parent().parent().find( '.google-fonts-regularweight-style' );
		var elementThinWeight = $( this ).parent().parent().find( '.google-fonts-thinweight-style' );
		var elementBoldWeight = $( this ).parent().parent().find( '.google-fonts-boldweight-style' );
		var selectedFont = $( this ).val();
		var customizerControlName = $( this ).attr( 'control-name' );

		// Clear Weight/Style dropdowns
		elementRegularWeight.empty();
		elementThinWeight.empty();
		elementBoldWeight.empty();


		// Get the Google Fonts control object
		var bodyfontcontrol = _wpCustomizeSettings.controls[ customizerControlName ];

		// Find the index of the selected font
		var indexes = $.map( bodyfontcontrol.skyrocketfontslist, function ( obj, index ) {
			if ( obj.family === selectedFont ) {
				return index;
			}
		} );
		var index = indexes[ 0 ];

		// For the selected Google font show the available weight/style variants
		$.each( bodyfontcontrol.skyrocketfontslist[ index ].variants, function ( val, text ) {
			if ( text.indexOf( "italic" ) < 0 ) {
				elementBoldWeight.append(
					$( '<option></option>' ).val( text ).html( text )
				);

				elementRegularWeight.append(
					$( '<option></option>' ).val( text ).html( text )
				);

				elementThinWeight.append(
					$( '<option></option>' ).val( text ).html( text )
				);
			}
		} );

		// Update the font category based on the selected font
		$( this ).parent().parent().find( '.google-fonts-category' ).val( bodyfontcontrol.skyrocketfontslist[ index ].category );

		skyrocketGetAllSelects( $( this ).parent().parent() );
	} );

	$( '.google_fonts_select_control select' ).on( 'change', function () {
		skyrocketGetAllSelects( $( this ).parent().parent() );
	} );

	function skyrocketGetAllSelects( $element ) {
		var selectedFont = {
			font: $element.find( '.google-fonts-list' ).val(),
			regularweight: $element.find( '.google-fonts-regularweight-style' ).val(),
			thinweight: $element.find( '.google-fonts-thinweight-style' ).val(),
			boldweight: $element.find( '.google-fonts-boldweight-style' ).val(),
			category: $element.find( '.google-fonts-category' ).val()
		};

		// Important! Make sure to trigger change event so Customizer knows it has to save the field
		$element.find( '.customize-control-google-font-selection' ).val( JSON.stringify( selectedFont ) ).trigger( 'change' );
	}


} );