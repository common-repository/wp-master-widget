(function( $ ) {
	'use strict';
	
	/*
		When page loaded with existing widgets, determine whether we need to provide order numbers
	*/
	var wp_master_uploader;
	var wpmw_icons_modal_target;
	
	//enables jquery ui accordion and sortable
	function initiate_widget_ui(){
		$( '.wpmw-widgets' )
		.accordion({
			header: 'h3.wpmw-widget-header',
			heightStyle: 'content',
			collapsible: true,
			active: false
		})
		.sortable({
			axis: 'y',
			handle: 'h3.wpmw-widget-header',
			items: '.wpmw-widget-panel',
			distance: 5,
			placeholder: 'ui-state-highlight',
			forcePlaceholderSize: true,
			stop: function( event, ui ){
				//$( this ).accordion( 'refresh' );
				$( this ).closest( '.wpmw-widgets' ).find( '.wpmw-widget-panel' ).each( function(){
					$( this ).find( '.wpmw-widget-order' ).val( $( this ).index() );
				});
			}
		});
		$('.wpmw-widget-color').wpColorPicker();
	}

	//document ready
	$( document ).ready( function(){
		initiate_widget_ui();
		$( 'input:radio.wpmw-widget-link-option:checked' ).each( function(){
			if( $( this ).val() != 'no' ){
				$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-link-conditional' ).show();
			} else {
				$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-link-conditional' ).hide();
			}
		});
		$( 'input:radio.wpmw-widget-hover-option:checked' ).each( function(){
			if( $( this ).val() != 'no' ){
				$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-hover-conditional' ).show();
			} else {
				$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-hover-conditional' ).hide();
			}
		});
	});

	//on widget update
	$( document ).on( 'widget-updated widget-added', function( event, widget ){
		var wpmw_widget_area = $( widget ).closest( '.wpmw-container' ).children( '.wpmw-widgets' );
		wpmw_widget_area.accordion( 'destroy' );
		initiate_widget_ui();
		$( 'input:radio.wpmw-widget-link-option:checked' ).each( function(){
			if( $( this ).val() != 'no' ){
				$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-link-conditional' ).show();
			} else {
				$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-link-conditional' ).hide();
			}
		});
		$( 'input:radio.wpmw-widget-hover-option:checked' ).each( function(){
			if( $( this ).val() != 'no' ){
				$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-hover-conditional' ).show();
			} else {
				$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-hover-conditional' ).hide();
			}
		});
	});
	
	$( document ).on( 'click', '.wpmw-widget-icon-add', function(){
		$( '.wpmw-modal' ).show();
		wpmw_icons_modal_target = $( this ).siblings( '.wpmw-widget-icon-class' );
	});
	
	$( document ).on( 'click', '.wpmw-widget-icon-remove', function(){
		$( this ).siblings( '.wpmw-widget-icon-class' ).val( '' );
		$( this ).siblings( '.wpmw-widget-icon-preview' ).empty().prepend( '<span class="wpmw-widget-icon-label">Select Icon</span>' );
		
	});
	
	$( document ).on( 'click', '.wpmw-modal-close', function(){
		$( '.wpmw-modal' ).hide();
	});
	
	$( document ).on( 'click', '.wpmw-fa-icon', function(){
		var selected_icon = $( this ).attr('id');
		wpmw_icons_modal_target.val( selected_icon );
		wpmw_icons_modal_target.siblings( '.wpmw-widget-icon-preview' ).empty().prepend( '<i class="fa fa-' + selected_icon + '" aria-hidden="true"></i>' );
		$( '.wpmw-modal' ).hide();
	});
	
	//image widget control - Add Image
	$( document ).on( 'click', '.wpmw-widget-image-add', function(){
		var $img_input = $( this ).siblings( '.wpmw-widget-image-url' );
		var $img_thumb = $( this ).siblings( '.wpmw-widget-image-thumb' );
		var $img_preview = $( this ).siblings( '.wpmw-widget-image-preview' );
		
		wp_master_uploader = wp.media({
			title: 'Select Category Featured Image',
			multiple: false,
			library: {
				type: 'image',
			}
		});

		wp_master_uploader.on( 'close', function(){
			var selection = wp_master_uploader.state().get( 'selection' ).first().toJSON();
			var thumbnail = null;
			if( selection.sizes.hasOwnProperty( 'medium' ) ){
				thumbnail = selection.sizes.medium.url;
			}else {
				thumbnail = selection.url;
			}
			$img_input.val( selection.url );
			$img_thumb.val( thumbnail );
			$img_preview.empty();
			$img_preview.prepend( '<img src="'+ thumbnail +'" />' );
		});
		wp_master_uploader.open();
	});
	
	//image widget control - Remove Image
	$( document ).on( 'click', '.wpmw-widget-image-remove', function(){
		var $img_input = $( this ).siblings( '.wpmw-widget-image-url' );
		var $img_thumb = $( this ).siblings( '.wpmw-widget-image-thumb' );
		var $img_preview = $( this ).siblings( '.wpmw-widget-image-preview' );

		$img_input.val( '' );
		$img_thumb.val( '' );
		$img_preview.empty();
		$img_preview.prepend( '<span class="wpmw-widget-image-label">Select Image</span>' );
	});
	
	//detects when element is selected to use hyperlink and controls the display for link option
	$( document ).on( 'change', '.wpmw-widget-link-option', function(){
		if( $( this ).val() != 'no' ){
			$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-link-conditional' ).show();
		} else {
			$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-link-conditional' ).hide();
		}
	} );
	//detects when element is selected to use hover effect
	$( document ).on( 'change', '.wpmw-widget-hover-option', function(){
		if( $( this ).val() != 'no' ){
			$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-hover-conditional' ).show();
		} else {
			$( this ).closest( '.wpmw-widget-option' ).siblings( '.wpmw-widget-hover-conditional' ).hide();
		}
	} );
	
	$( document ).on( 'click', '.wpmw-control-remove', function(){
		var wpmw_widget_area = $( this ).closest( '.wpmw-container' ).children( '.wpmw-widgets' );
		$( this ).closest( '.wpmw-widget-panel' ).remove(); 
		$( '.wpmw-widgets' ).accordion( 'destroy' );
		initiate_widget_ui();
		wpmw_widget_area.find( '.wpmw-widget-panel' ).each( function( index ){
			$( this ).find( '.wpmw-widget-order' ).val( index );
		});
	} );
	
	$( document ).on( 'click', '.wpmw-widget-button', function(){
		var wpmw_widget_area = $( this ).closest( '.wpmw-container' ).children( '.wpmw-widgets' ); //get widget display area
		var wpmw_type = $( this ).data( 'wpmw-type' ); //get type of object
		var wpmw_name = $( this ).data( 'wpmw-name' ); //get type of object

		var ajax_data = {
			'action'			: 'wpmw_ajax_make_widget_object',
			'wpmw_name'		: wpmw_name,
			'ajax_nonce' 	: wpmw_widget.ajax_nonce,
			'wpmw_type'		: wpmw_type
		};
		
		$.ajax({
			type: 'get',
			dataType: 'json',
			url: ajaxurl,
			data: ajax_data,
			success: function( response ){
				if( response.result == 'success' ){
					$( response.output ).appendTo( wpmw_widget_area );
					wpmw_widget_area.accordion( 'destroy' );
					initiate_widget_ui();
					wpmw_widget_area.find( '.wpmw-widget-panel' ).each( function( index ){
						$( this ).find( '.wpmw-widget-order' ).val( index );
					});
				} else {
					console.log(response);
					console.log( 'Error: ' + response.output );
				}
			},
			error: function( response ){
				console.log(response);
			}
		});

	});
})( jQuery );
