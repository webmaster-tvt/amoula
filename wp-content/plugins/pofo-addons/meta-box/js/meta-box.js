!function($) {
	"use strict";
   	$( window ).on( 'load', function () {
        
        if( $( '.pofo_meta_box_tab' ).hasClass('active') ) {
            $( '.pofo_meta_box_tab' ).find( '.separator_box:first' ).children( '.plusminus' ).text( '-' );
            $( '.pofo_meta_box_tab' ).find( '.separator_start_content_wrap:first' ).css( 'display','block' );
        }
    });
}(jQuery);
jQuery(document).ready( function( $ ) {

	$( '.separator_box' ).click(function() {
	    if ($( '.separator_start_content_wrap' ).is( ':visible' )) {
		      $( '.separator_start_content_wrap' ).slideUp(500);
		      $( '.plusminus' ).text( '+' );
	    }
	    if ($(this).next( '.separator_start_content_wrap' ).is( ':visible' )) {
		      $(this).next( '.separator_start_content_wrap' ).slideUp(500);
		      $(this).children( '.plusminus' ).text( '+' );
	    } else {
		      $(this).next(' .separator_start_content_wrap' ).slideDown(500);
		      $(this).children( '.plusminus' ).text( '-' );
	    }
  });

	$( document ).on( 'click', '.pofo_tab_reset_settings', function() {

		var reset_message = pofo_admin_meta.reset_message;
		var reset_name = $( this ).attr('reset_key');

		reset_message = reset_message.replace(/###|_/g, reset_name);		
		
		var flag = confirm( reset_message );
		if( flag ) {

			var reset_tab = $( this ).parents( '.pofo_meta_box_tab' );

			// for input type text field
			reset_tab.find( 'input[type="text"]' ).val( '' );

			// for textarea
			reset_tab.find( 'textarea' ).val( '' );

			// for select
			reset_tab.find( 'select' ).val( 'default' );

			// for colorpicker
			reset_tab.find( '.wp-color-result' ).attr( 'style', '' );

			// for input type hidden field
			reset_tab.find( 'input[type="hidden"]' ).val( '' );

	        // for image upload field
	        reset_tab.find( '.pofo_remove_button, .multiple_images .remove' ).trigger( 'click' );
	    }
	});

	// Check on load for selected tab when user come before if not it show first one active
	if($.cookie('pofo_metabox_active_id_' + $('#post_ID').val())) {
		var active_class = $.cookie('pofo_metabox_active_id_' + $('#post_ID').val());

		$('#pofo_admin_options').find('.pofo_meta_box_tabs li').removeClass('active');
		$('#pofo_admin_options').find('.pofo_meta_box_tab').removeClass('active').hide();

		$('.'+active_class).addClass('active').fadeIn();
		$('#pofo_admin_options').find('#'+active_class).addClass('active').fadeIn();

	} else {
		$('.pofo_meta_box_tabs li:first-child').addClass('active');
		$('.pofo_meta_box_tab_content .pofo_meta_box_tab:first-child').addClass('active').fadeIn();
	}
	$('.pofo_meta_box_tabs li a').click(function(e) {
		e.preventDefault();
        $( '.separator_start_content_wrap' ).last().prev().slideUp(500);
		$( '.plusminus' ).text( '+' );
		$( '.pofo_meta_box_tab' ).find( '.separator_box:first' ).children( '.plusminus' ).text( '-' );
        $( '.pofo_meta_box_tab' ).find( '.separator_start_content_wrap:first' ).css( 'display','block' );
		var tab_click_id = $(this).parent().attr('class').split(' ')[0];
		var tab_main_div = $(this).parents('#pofo_admin_options');

		$.cookie('pofo_metabox_active_id_' + $('#post_ID').val(), tab_click_id, { expires: 7 });
		
		tab_main_div.find('.pofo_meta_box_tabs li').removeClass('active');
		tab_main_div.find('.pofo_meta_box_tab').removeClass('active').hide();

		$(this).parent().addClass('active').fadeIn();
		tab_main_div.find('#'+tab_click_id).addClass('active').fadeIn();

	});

  /* Metabox dependance of fields */
	
    $(".pofo_select_parent").change(function () {
	    var str_selected = $(this).find("option:selected").val();
	    var tab_active_status_main = $(this).parents('#pofo_admin_options');
	    $('.hide_dependent').find('input[type="hidden"]').val('0');
		tab_active_status_main.find('.hide_dependent').addClass('hide_dependency');

		if (tab_active_status_main.find('.hide_dependency').hasClass(str_selected+'_single')){
			tab_active_status_main.find('.'+str_selected+'_single').removeClass('hide_dependency');
			tab_active_status_main.find('.'+str_selected+'_single').find('input[type="hidden"]').val('1');
		}
		
		/* Special case for Both sidebar*/ 
		if(str_selected == 'pofo_layout_both_sidebar'){
			$('.pofo_layout_left_sidebar_single').removeClass('hide_dependency');
			$('.pofo_layout_left_sidebar_single').find('input[type="hidden"]').val('1');
			$('.pofo_layout_right_sidebar_single').removeClass('hide_dependency');
			$('.pofo_layout_right_sidebar_single').find('input[type="hidden"]').val('1');
		}
		
	});

	/* Dependency */
    $('.description_box, .separator_box').each(function(){
    	if( $(this).attr('data-element') && $(this).attr('data-value') ){
    		var data_val = $(this).attr('data-value');
    		var data_val_arr = data_val.split(',');
    		var data_element = $(this).attr('data-element');
    		var current = $(this);
    		$(document).on('change', '#'+$(this).attr('data-element'), function () {
    			var val = $(this).val();
    			if( $.inArray( val, data_val_arr ) !== -1 ){
    				$(current).removeClass('hidden');
    			}else{
    				$(current).addClass('hidden');
    			}
    		});

    		if( $.inArray( $('#'+data_element).val(), data_val_arr ) !== -1 ){
    			$(current).removeClass('hidden');
    		}else{
    			$(current).addClass('hidden');
    		}
    	}
    });
    /* End Dependency */

    if( $( 'body' ).hasClass('post-type-portfolio') ) {
		var defaultPortfolioSelect = $('.post-type-portfolio input.post-format:checked').val();
		if( defaultPortfolioSelect == 0 ){
			defaultPortfolioSelect = 'standard';
		}
		$( '#pofo_portfolio_post_type_single' ).val( defaultPortfolioSelect );
		$( '.post-type-portfolio').on( 'click', '.post-format', function() {
			var clickVal = $(this).val();
			if( clickVal == 'link' ){
				$( '#pofo_portfolio_post_type_single' ).val( clickVal );
			} else {
				$( '#pofo_portfolio_post_type_single' ).val( 'standard' );
			}
		});
	}

    var link_color = $( '.pofo-color-picker' );
    link_color.each( function (){
    	$(this).alphaColorPicker();
    });

    /* Image Upload Button Click*/

    $( document ).on( 'click', '.pofo_upload_button', function(event) {
		var file_frame;
		var button = $(this);

		var button_parent = $(this).parent();
    	var id = button.attr('id').replace('_button', '');
        event.preventDefault();
        

        // If the media frame already exists, reopen it.
        if ( file_frame ) {
          file_frame.open();
          return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
          title: $( this ).data( 'uploader_title' ),
          button: {
            text: $( this ).data( 'uploader_button_text' ),
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
          // We set multiple to false so only get one image from the uploader
          var full_attachment = file_frame.state().get('selection').first().toJSON();

          var attachment = file_frame.state().get('selection').first();

          var thumburl = attachment.attributes.sizes.thumbnail;
          var thumb_hidden = button_parent.find('.upload_field').attr('name');

          if ( thumburl || full_attachment ) {
          button_parent.find("#"+id).val(full_attachment.url);
          button_parent.find("."+thumb_hidden+"_thumb").val(full_attachment.url);
          
          button_parent.find(".upload_image_screenshort").attr("src", full_attachment.url);
          //button_parent.find(".upload_image_screenshort").show();
          button_parent.find(".upload_image_screenshort").slideDown();
        }
        });

        // Finally, open the modal
        file_frame.open();
    });
    
    // Remove button function to remove attach image and hide screenshort Div.
    $( document ).on( 'click', '.pofo_remove_button', function(event) {
		var remove_parent = $(this).parent();
		remove_parent.find('.upload_field').val('');
		remove_parent.find('input[type="hidden"]').val('');
		remove_parent.find('.upload_image_screenshort').slideUp();
    });

    // On page load add all image url to show in screenshort.
    $('.upload_field').each(function(){
      if($(this).val()){
        $(this).parent().find('.upload_image_screenshort').attr("src", $(this).parent().find('input[type="hidden"]').val());
      }else{
        $(this).parent().find('.upload_image_screenshort').hide();
      }
    });
    if( $('body').hasClass('block-editor-page') ) {

			/* multiple image upload */
	    
	      	$( document ).on( 'click', '.pofo_upload_button_multiple', function(event) {
				var file_frame;
			  	var button = $(this);

			    var button_parent = $(this).parent();
				var id = button.attr('id').replace('_button', '');
				var app = [];
			    event.preventDefault();
			    

			    // If the media frame already exists, reopen it.
			    if ( file_frame ) {
			      file_frame.open();
			      return;
			    }

			    // Create the media frame.
			    file_frame = wp.media.frames.file_frame = wp.media({
			      title: $( this ).data( 'uploader_title' ),
			      button: {
			        text: $( this ).data( 'uploader_button_text' ),
			      },
			      multiple: true  // Set to true to allow multiple files to be selected
			    });

			    // When an image is selected, run a callback.
			    file_frame.on( 'select', function() {

			      var thumb_hidden = button_parent.find('.upload_field').attr('name');
			     
					var selection = file_frame.state().get('selection');
					var app = [];
						selection.map( function( attachment ) {
						var attachment = attachment.toJSON();

						button_parent.find('.multiple_images').append( '<div id="'+attachment.id+'"><img src="'+attachment.url+'" class="upload_image_screenshort_multiple" alt="" style="width:100px;"/><a href="javascript:void(0)" class="remove">remove</a></div>' );
						$('.multiple_images').each(function(){
							if($(this).children().length > 0){
								var attach_id = [];
								var pr_div = $(this).parent();
								$(this).children('div').each(function(){
										attach_id.push($(this).attr('id'));						
								});

								pr_div.find('.upload_field').val(attach_id);
							}else{
								$(this).parent().find('.upload_field').val('');
							}
						});
					});
			    });
			    // Finally, open the modal
			    file_frame.open();
			});

			$('.multiple_images').on( 'click', '.remove', function() {
				var remove_Item = $(this).parent().attr('id');
				$('.multiple_images').each(function(){
					if($(this).children().length > 0){
						var attach_id = [];
						var pr_div = $(this).parent();
						$(this).children('div').each(function(){
								attach_id.push($(this).attr('id'));						
						});
						attach_id = $.grep(attach_id, function(value) {
						  return value != remove_Item;
						});
						pr_div.find('.upload_field').val(attach_id);
					}else{
						$(this).parent().find('.upload_field').val('');
					}
				});

				$(this).parent().slideUp();
				$(this).parent().remove();
			});

	      /* multiple image upload End */


			/*==============================================================*/
			// Post Format Meta Start
			/*==============================================================*/
			function post_format_selection_options( format_val ) {
				
				//Hide Link Format in Post type
				$('body.post-type-portfolio #post-format-gallery, body.post-type-portfolio .post-format-gallery').hide();
				$('body.post-type-portfolio #post-format-video, body.post-type-portfolio .post-format-video').hide();
				$('body.post-type-portfolio #post-format-image, body.post-type-portfolio .post-format-image').hide();
				$('body.post-type-portfolio #post-format-quote, body.post-type-portfolio .post-format-quote').hide();
				$('body.post-type-portfolio #post-format-audio, body.post-type-portfolio .post-format-audio').hide();
				$('body.post-type-portfolio .post-format-quote').next('br').hide();
				$('body.post-type-portfolio .post-format-gallery').next('br').hide();
				$('body.post-type-portfolio .post-format-image').next('br').hide();
				$('body.post-type-portfolio .post-format-video').next('br').hide();
				$('body.post-type-portfolio .post-format-audio').next('br').hide();

				if ($('#post-format-link').is(':checked')) {
					$('.pofo_portfolio_external_link_single_box').fadeIn();
				}else{
					$('.pofo_portfolio_external_link_single_box').hide();
				}
				
				$('body.post-type-post #pofo_admin_options_single').hide();

		       if ( format_val == 'gallery') {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').fadeIn();
		            $('.pofo_lightbox_image_single_box').fadeIn();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');

		        } else if ( format_val == 'video' ) {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').fadeIn();
		            $('.pofo_video_ogg_single_box').fadeIn();
		            $('.pofo_video_webm_single_box').fadeIn();
		            $('.pofo_video_single_box').fadeIn();
		            $('.pofo_video_type_single_box').fadeIn();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').fadeIn();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            post_format_video_selection();

		        }else if ( format_val == 'audio' ) {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').fadeIn();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');


		        }else if ( format_val == 'quote' ) {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').fadeIn();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');
		            
		        } else if ( format_val == 'image' ) {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_image_single_box').fadeIn();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');
		            
		        }else {
		        	$('body.post-type-post #pofo_admin_options_single').hide();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');

		        }
		    }
		    post_format_selection_options( $( "#post-format-selector-0" ).val() );

			setTimeout(function(){
			    $('#post-format-selector-0').change(function() {
			        post_format_selection_options( this.value );
			    });
			    post_format_selection_options( $( "#post-format-selector-0" ).val() );
			}, 500);

			/*==============================================================*/
			// Post Format Meta End
			/*==============================================================*/

    }else{

	    /* multiple image upload */
	    
	      $( document ).on( 'click', '.pofo_upload_button_multiple', function(event) {
			var file_frame;
			var button = $(this);

			var button_parent = $(this).parent();
	        var id = button.attr('id').replace('_button', '');
	        var app=[];
	          event.preventDefault();
	          

	          // If the media frame already exists, reopen it.
	          if ( file_frame ) {
	            file_frame.open();
	            return;
	          }

	          // Create the media frame.
	          file_frame = wp.media.frames.file_frame = wp.media({
	            title: $( this ).data( 'uploader_title' ),
	            button: {
	              text: $( this ).data( 'uploader_button_text' ),
	            },
	            multiple: true  // Set to true to allow multiple files to be selected
	          });

	          // When an image is selected, run a callback.
	          file_frame.on( 'select', function() {

	            var thumb_hidden = button_parent.find('.upload_field_multiple').attr('name');
	           
	            var selection = file_frame.state().get('selection');
	            var app=[];
	              selection.map( function( attachment ) {
	              var attachment = attachment.toJSON();
	              button_parent.find('.multiple_images').append( '<div id="'+attachment.id+'"><img src="'+attachment.url+'" class="upload_image_screenshort_multiple" alt="" style="width:100px;"/><a href="javascript:void(0)" class="remove">remove</a></div>' );
	            });
	          });
	          // Finally, open the modal
	          file_frame.open();
	      });

	      $(".button-primary").on('click',function(){
	        var pr_div;
	        $('.multiple_images').each(function(){
	          if($(this).children().length > 0){
	            var attach_id = [];
	            var pr_div = $(this).parent();
	            $(this).children('div').each(function(){
	                attach_id.push($(this).attr('id'));            
	            });
	            
	            pr_div.find('.upload_field_multiple').val(attach_id);
	          }else{
	            $(this).parent().find('.upload_field_multiple').val('');
	          }
	        });   
	      });

	      $(".multiple_images").on('click','.remove', function() {
	        $(this).parent().slideUp();
	        $(this).parent().remove();
	      });

	      /* multiple image upload End */


		/*==============================================================*/
		// Post Format Meta Start
		/*==============================================================*/
		function post_format_selection_options() {
				
				//Hide Link Format in Post type
				$('body.post-type-portfolio #post-format-gallery, body.post-type-portfolio .post-format-gallery').hide();
				$('body.post-type-portfolio #post-format-video, body.post-type-portfolio .post-format-video').hide();
				$('body.post-type-portfolio #post-format-image, body.post-type-portfolio .post-format-image').hide();
				$('body.post-type-portfolio #post-format-quote, body.post-type-portfolio .post-format-quote').hide();
				$('body.post-type-portfolio #post-format-audio, body.post-type-portfolio .post-format-audio').hide();
				$('body.post-type-portfolio .post-format-quote').next('br').hide();
				$('body.post-type-portfolio .post-format-gallery').next('br').hide();
				$('body.post-type-portfolio .post-format-image').next('br').hide();
				$('body.post-type-portfolio .post-format-video').next('br').hide();
				$('body.post-type-portfolio .post-format-audio').next('br').hide();

				if ($('#post-format-link').is(':checked')) {
					$('.pofo_portfolio_external_link_single_box').fadeIn();
				}else{
					$('.pofo_portfolio_external_link_single_box').hide();
				}
				
				$('body.post-type-post #pofo_admin_options_single').hide();

		       if ($('#post-format-gallery').is(':checked')) {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').fadeIn();
		            $('.pofo_lightbox_image_single_box').fadeIn();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');

		        } else if ($('#post-format-video').is(':checked')) {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').fadeIn();
		            $('.pofo_video_ogg_single_box').fadeIn();
		            $('.pofo_video_webm_single_box').fadeIn();
		            $('.pofo_video_single_box').fadeIn();
		            $('.pofo_video_type_single_box').fadeIn();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').fadeIn();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            post_format_video_selection();

		        }else if ($('#post-format-audio').is(':checked')) {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').fadeIn();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');


		        }else if ($('#post-format-quote').is(':checked')) {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').fadeIn();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');
		            
		        } else if ($('#post-format-image').is(':checked')) {
		        	$('body.post-type-post #pofo_admin_options_single').show();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_image_single_box').fadeIn();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');
		            
		        }else {
		        	$('body.post-type-post #pofo_admin_options_single').hide();
		            $('.pofo_gallery_single_box').hide();
		            $('.pofo_lightbox_image_single_box').hide();
		            $('.pofo_quote_single_box').hide();
		            $('.pofo_link_type_single_box').hide();
		            $('.pofo_link_single_box').hide();
		            $('.pofo_video_mp4_single_box').hide();
		            $('.pofo_video_ogg_single_box').hide();
		            $('.pofo_video_webm_single_box').hide();
		            $('.pofo_video_single_box').hide();
		            $('.pofo_video_type_single_box').hide();
		            $('.pofo_audio_single_box').hide();
		            $('.pofo_enable_mute_single_box').hide();
		            $('.pofo_featured_image_single_box').fadeIn();
		            $('.pofo_subtitle_single_box').fadeIn();
		            $(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
					$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');

		        }
		    }
		    post_format_selection_options();

		    var select_type = $('#post-formats-select input');

		    $(this).change(function() {
		        post_format_selection_options();
		    });

		/*==============================================================*/
		// Post Format Meta End
		/*==============================================================*/
    }

    /*==============================================================*/
	// Video Post Format Meta End
	/*==============================================================*/

		$('#pofo_video_type_single').change(function() {
			post_format_video_selection();
		});

		function post_format_video_selection(){
			if( $('#pofo_video_type_single').val() == 'self' && ( $('#post-format-video').is(':checked') || $( "#post-format-selector-0" ).val() == 'video' ) ){
				$(".pofo_enable_mute_single_box").addClass('show_div').removeClass('hide_div');
				$(".pofo_video_mp4_single_box").addClass('show_div').removeClass('hide_div');
				$(".pofo_video_ogg_single_box").addClass('show_div').removeClass('hide_div');
				$(".pofo_video_webm_single_box").addClass('show_div').removeClass('hide_div');
				$(".pofo_video_single_box").removeClass('show_div').addClass('hide_div');
			} else if( $('#pofo_video_type_single').val() == 'external' && ( $('#post-format-video').is(':checked') || $( "#post-format-selector-0" ).val() == 'video' ) ){
				$(".pofo_enable_mute_single_box").removeClass('show_div').addClass('hide_div');
				$(".pofo_video_mp4_single_box").removeClass('show_div').addClass('hide_div');
				$(".pofo_video_ogg_single_box").removeClass('show_div').addClass('hide_div');
				$(".pofo_video_webm_single_box").removeClass('show_div').addClass('hide_div');
				$(".pofo_video_single_box").addClass('show_div').removeClass('hide_div');
			} else{
				$(".pofo_enable_mute_single_box").removeClass('show_div').removeClass('hide_div');
				$(".pofo_video_mp4_single_box").removeClass('show_div').removeClass('hide_div');
				$(".pofo_video_ogg_single_box").removeClass('show_div').removeClass('hide_div');
				$(".pofo_video_webm_single_box").removeClass('show_div').removeClass('hide_div');
				$(".pofo_video_single_box").removeClass('show_div').removeClass('hide_div');
			}
		}
	/*==============================================================*/
	// Video Post Format Meta End
	/*==============================================================*/

});
