jQuery(document).ready(function($){

	function change_port() {
		if($('#lt_meta_action_type').find('option:selected').val() == "link"){
			$(".lt_meta_portfolio_video").hide();
            $(".lt_meta_portfolio_website").show();
          }else if($('#lt_meta_action_type').find('option:selected').val() == "video"){
            $(".lt_meta_portfolio_website").hide();
            $(".lt_meta_portfolio_video").show();
          }else if($('#lt_meta_action_type').find('option:selected').val() == "ajax"){
			$(".lt_meta_portfolio_video").hide();
            $(".lt_meta_portfolio_website").hide();
          }
	}

	change_port();

	$('#lt_meta_action_type').on('change',function(){
		change_port();
	});
	
    var $gallery_table = $('.gallery-images');
    
    function set_sortable(params) {
    	var $tbody = $gallery_table.find('tbody');
    	
    	if(!params) {
    		params = {
	    		opacity: 0.5,
	            cursor: 'pointer',
	            axis: 'y',
	            handle : '.media-icon',
	    		update: function() {
	                update_alternate_rows($tbody);
	            }
	    	};
    	}
    	
    	$gallery_table.find('tbody').sortable(params);
    	
    	update_alternate_rows($tbody);
    }
    
    function update_alternate_rows(tbody) {
    	tbody.find('tr').removeClass('alternate').filter(':even').addClass('alternate');
    }
    
    //upload field
    $('.gallery-image-upload').each(function(){
    	var meta_image_frame,
    		$this = $(this),
    		gallery_name = 'gallery_images[]';
		
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: 'Select gallery images',
            button: { text:  'Insert images' },
            library: { type: 'image' },
            multiple: true,
            // frame: 'post'
        });
        
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').toJSON();
            
            if(media_attachment) {
            	$.each(media_attachment, function(i, img) {
            		
            		var thumb_url = '';
            		
            		if(typeof img.sizes.thumbnail != 'undefined' && typeof img.sizes.thumbnail.url != 'undefined') {
            			thumb_url = img.sizes.thumbnail.url;
            		} else {
            			for(var s in img.sizes) {
            				thumb_url = img.sizes[s].url;
            				break;
            			}
            		}
            		
    				appendRow({
    					'thumb_url' : thumb_url,
    					'title' : img.title,
    					'mime' : img.mime,
    					'editLink' : img.editLink,
    					'name' : gallery_name,
    					'value' : img.id,
    				});
    				
    				set_sortable('refresh');
    				
            	});
            	
            }
        });
 		
 		$this.on('click', function(e){
 			e.preventDefault();
 			meta_image_frame.open();
 		});
    });
    
    set_sortable();
    
    $gallery_table.on('click', '.remove-gallery-image', function(e){
    	e.preventDefault();
    	
    	$(this).parent().parent().remove();
    	
    	update_alternate_rows($gallery_table.find('tbody'));
    	
    	return false;
    });
    
    function appendRow(row) {
    	$gallery_table.find('tbody').append(
			$("<tr>").append(
				$("<td class='media-icon'>").append($("<img>",{'src':row.thumb_url})) //image
			).append(
				$("<td class='column-title'>").html("<strong>"+row.title+"</strong>") //title
			).append(
				$("<td class='column-title'>").text(row.mime) //mime type
			).append(
				$("<td class='column-parent'>").append($("<a>",{'href':row.editLink}).text('Edit')) //edit link
			).append(
				$("<td class='column-parent'>").append($("<a>",{'href':'#','class':'remove-gallery-image'}).text('Remove')).append($("<input>", {
					'type' : 'hidden',
					'name' : row.name,
					'value' : row.value
				})) //remove
			)
		);
    }
    
    //insert portfolio videos links
    $('.video-thickbox').on('click', function(e, edit_cb){
    	e.preventDefault();
    	
    	var $a = $(this);
    	var $target = $('#'+$a.attr('data-target'));
    	var $preview = $target.find('.video_preview');
    	var gallery_name = 'gallery_images[]'; //$('#gallery-image-name').attr('data-name');
    	var $video_link = $target.find('#video_link');
    	
    	function getMatch(url) {
    		return url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);
    	}
    	
    	function getType(str) {
    		if (str.indexOf('youtu') > -1) {
				return 'youtube';
			} else if (str.indexOf('vimeo') > -1) {
				return 'vimeo';
			}
			
			return false;
    	}
    	
	    $target.find('.video_link_check').off('click').on('click', function(){
	    	var $this = $(this);
	    	//var $video_link = $this.parent().find('#video_link');
	    	var url = $video_link.val();
	    	var id, type, html;
	    	
	    	if (url) {
				id = getMatch(url);
				
				if(id != null && typeof id[3] != 'undefined' && typeof id[6] != 'undefined') {
					
					type = getType(id[3]);
					
					if(type === false) {
						$preview.text('Video URL not supported.');
					}
					
					id = id[6];
				} else {
					$preview.text('Video URL not supported');
				}
			} else {
				$preview.text('Missing video URL.');
			}
			
			if(id && type) {
				if (type === 'youtube') {
					html = '<iframe width="100%" height="100%" src="http://www.youtube.com/embed/'+ 
							id + '?autoplay=1&showinfo=0&autohide=1&v=' + 
							id + '" frameborder="0" allowfullscreen></iframe>';
				} else if (type === 'vimeo') {
					html = '<iframe src="http://player.vimeo.com/video/' + 
							id + '?autoplay=1" width="100%" height="100%" '+
							'frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				}
											
				$this.parent().find('.video_preview').html(html);
			}
			
	    });
	    
	    $target.find('.insert_video_link input').off('click').on('click', function(){
	    	var url = $video_link.val();
	    	var id, type;
	    	
	    	if (url) {
				id = getMatch(url);
				
				if(id != null && typeof id[3] != 'undefined' && typeof id[6] != 'undefined') {
					
					type = getType(id[3]);
					
					if(type) {
						id = id[6];
						var params = {};
						
						if (type === 'youtube') {
							var thumb = "http://img.youtube.com/vi/"+id+"/hqdefault.jpg";
							
							params = {
		    					'thumb_url' : thumb,
		    					'title' : "https://www.youtube.com/watch?v="+id,
		    					'mime' : type,
		    					'editLink' : '#edit_gallery_video',
		    					'name' : gallery_name,
		    					'value' : ( [type, id, thumb].join(",") )
		    				};
		    				
		    				if(edit_cb) {
		    					edit_cb();
		    				}
		    				
		    				appendRow(params);
	    				
	    					set_sortable('refresh');
		    				
						} else if (type === 'vimeo') {
							
							$.get('http://vimeo.com/api/v2/video/'+id+'.json', function(data){
								if(data && typeof data[0] != 'undefined') {
									if(data[0].thumbnail_large != 'undefined') {
										var thumb = data[0].thumbnail_large;
										
										params = {
					    					'thumb_url' : thumb,
					    					'title' : "http://vimeo.com/"+id,
					    					'mime' : type,
					    					'editLink' : '#edit_gallery_video',
					    					'name' : gallery_name,
					    					'value' : ( [type, id, thumb].join(",") )
					    				};
					    				
					    				if(edit_cb) {
					    					edit_cb();
					    				}
					    				
					    				appendRow(params);
	    				
	    								set_sortable('refresh');
									}
								}
							});
							
						}
						
					}
					
				} 
			}
			
			tb_remove();
	    });
	    
	    tb_show($a.attr('title'), $a.attr('href'));
	    
	    $(window).on('resize.video_thickbox', function(){
    		$preview.height(
    			Math.min(400, ($('#TB_window').height()-250) )
    		);
    	}).trigger('resize');
    	
    	$('#TB_window').on("tb_unload", function() {
    		$(window).off('resize.video_thickbox');
	        $target.find('#video_link').val('');
	        $target.find('.video_preview').empty();
	    });
	    
    	return false;
    });
    
    $('.gallery-images').on('click', 'a[href*="edit_gallery_video"]', function(e){
    	e.preventDefault();
    	
    	var $a = $(this);
    	var $tr = $a.closest('tr');    	
    	var input = $tr.find('.remove-gallery-image').next().val().split(",");
    	var type = input[0];
    	var id = input[1];
    	var url;
    	
    	if (type === 'youtube') {
			url = 'https://www.youtube.com/watch?v='+id;
		} else if (type === 'vimeo') {
			url = 'http://vimeo.com/'+id;
		}
    	
    	$('#inline-video-modal').find('#video_link').val(url);
    	
    	$('.video-thickbox').trigger('click', function() {
    		$tr.remove();
    	});
    	
    	return false;
    });
    
});