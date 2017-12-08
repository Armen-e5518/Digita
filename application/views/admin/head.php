<meta charset="utf-8"/>
<link rel="shortcut icon" type="image/x-icon" href="<?=site_url('favicon.png');?>">
<title>Administration Panel</title>
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" href="<?php echo site_url('assets/admin/css/style.css');?>">
<link rel="stylesheet" href="<?php echo site_url('assets/admin/css/style_custom.css');?>">
<link rel="stylesheet" href="<?php echo site_url('assets/admin/css/font-awesome.css');?>">
<link rel="stylesheet" href="<?php echo site_url('assets/admin/css/jquery-ui.css');?>" media="all">
<link rel="stylesheet" href="<?php echo site_url('assets/admin/css/jquery.jscrollpane.css');?>" media="all">
<link rel="stylesheet" href="<?php echo site_url('assets/admin/css/dd-menu.css');?>">
<link rel="stylesheet" href="<?php echo site_url('assets/admin/css/nestable.css');?>">

<script src="<?php echo site_url('assets/admin/js/jquery-1.10.1.min.js');?>"></script>
<script src="<?php echo site_url('assets/admin/js/jquery-ui.js');?>"></script>
<script src="<?php echo site_url('assets/admin/js/jquery.nestable.js');?>"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<script src="<?php echo site_url('assets/js/table/pdf.js'); ?>"></script>
<script type="text/javascript">
	var MyObj = { 
					'site_url': '<?=site_url()?>',
					'ln':'en',
					'curr_date': date = new Date()
					
				};
</script>   
<script src="<?php echo site_url('assets/admin/js/jquery.validate.pack.js');?>"></script>
<?php /*
<script src="<?php echo site_url('assets/admin/js/jquery.mousewheel.js'); ?>"></script>
<script src="<?php echo site_url('assets/admin/js/jquery.jscrollpane.min.js'); ?>"></script>
*/ ?>
<script src="<?php echo site_url('assets/admin/js/scripts.js'); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {		
		var updateOutput = function(e) { };
		$('#nestable').nestable();		
		$('.save_menu').click(function(){
			if (confirm('Are you sure save changes')) {
				var menu_array = $('.dd').nestable('toArray');
				$.ajax({
					type: 	"POST",
					url:	"<?=site_url('admin/ajax/edit_menu')?>",
					data: {
						section_id: $('.section_id').val(),
						menu_array: menu_array,
					},
					success: function (data) {								
						location.reload();
					}			
				});
			}			
		});
		
		$('.save_restaurant_menu').click(function(){
			if (confirm('Are you sure save changes')) {
				var menu_array = $('.dd').nestable('toArray');
				$.ajax({
					type: 	"POST",
					url:	"<?=site_url('admin/ajax/edit_restaurant_menu')?>",
					data: {
						section_id: $('.section_id').val(),
						menu_array: menu_array,
					},
					success: function (data) {								
						location.reload();
					}			
				});
			}			
		});

        $("ul.table-style li").click(function(){
            if(!$(this).hasClass("no-action")) {
				var link = $(this).find("a.edit_item").attr("href");
				window.location = link;
				return false;
            }
        });
       
		$(".n_valid_icon").click(function(event){
			event.stopPropagation();
			return true;
		}); 
	   

        // language selecting
        var li = $('.n_language').children('li'),
			span = li.find('span'),
			ul_hided = li.find('ul'),
			ul_hided_li = ul_hided.find('li');
			li.click(function(){
				ul_hided.slideToggle(200);
			});
        ul_hided_li.click(function(){
            var language = $(this).attr('data-lang');
            
            $.ajax({
               type: "POST",
               url: '/admin/ajax/selectlanguage',
               data: { language: language},
               success: function(msg){ location.reload();}
             });
            var text = $(this).text();
            span.text(text);
        });

        // sidebar submenu toggling
        $('.n_drop').click(function(e){
            e.preventDefault();
            $('.n_submenu').slideToggle();
            if($(this).children('i').hasClass('fa fa-angle-right')){
                $(this).children('i.fa-angle-right')
                       .removeClass('fa fa-angle-right')
                       .addClass('fa fa-angle-down')
            }
            else {
                $(this).children('i.fa-angle-down')
                       .removeClass('fa fa-angle-down')
                       .addClass('fa fa-angle-right')
            }
        });
		
		$(document).on('click','.delete_icon_first',function(event){        
			if (confirm('Are you sure delete this image?')) {
				var $_this =$(this);				
				path  = $_this.attr('data-img');
				id = $_this.attr('data-id');
				row = $_this.attr('data-row');
				
				
				// img = $_this.attr('data-img');                
				//$(this).parent('.main-title-block').find('input').val('1');
//				a = $(this).parent('.main-title-block');
//				console.log(a);
				$_this.parent().remove();
				$.ajax({
					type: "POST",
					dataType: 'json',
					url: MyObj.site_url +"admin/restaurants/deleteimage",
					data: { path:path, id:id, row:row},
					success: function () {

					}
				});
			}
		});		
<?php /*
		$('.scroll-pane').jScrollPane({verticalDragMinHeight: 20,
            verticalDragMaxHeight: 20,
            horizontalDragMinWidth: 20,
            horizontalDragMaxWidth: 20
		});	    
*/ ?>	   
    });
	
function Date_Picker(selector){
	var new_date = new Date();	
	$('.'+ selector).DatePicker({
		format:'Y-m-d',
		date: new_date,
		current: new_date,
		starts: 1,
		position: 'right',
		onChange: function(formated, dates){			
			$('.'+ selector).val(formated);
		}
	});
}
</script>
<?php if(isset($addEditor) && $addEditor) { ?>
	<script src="<?php echo site_url('assets/admin/tinymce/js/tinymce/tinymce.dev.js');?>"></script>
	<script src="<?php echo site_url('assets/admin/tinymce/js/tinymce/plugins/table/plugin.dev.js');?>"></script>
	<script src="<?php echo site_url('assets/admin/tinymce/js/tinymce/plugins/paste/plugin.dev.js');?>"></script>
	<script src="<?php echo site_url('assets/admin/tinymce/js/tinymce/plugins/spellchecker/plugin.dev.js');?>"></script>
	<script type="text/javascript">
			function init_tinymce(){
					tinymce.init({
							selector: '.editor',
							theme: "modern",
							//width: 875,
							width: 630,
							height: 300,
							menubar: false,
							relative_urls : false,
							remove_script_host : false,
							doctype: false,
							plugins: [
									 "advlist autolink link image lists charmap print preview hr anchor pagebreak",
									 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
									 "table contextmenu directionality  paste textcolor responsivefilemanager"
					   ],
					   toolbar1: "undo redo | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fullscreen preview  code",		  
					   toolbar2: "responsivefilemanager image media | fontselect | table | hr removeformat | subscript superscript |  charmap  |  link unlink ",
					   image_advtab: true ,  
					   external_filemanager_path:"/assets/admin/filemanager/",
					   filemanager_title:"Filemanager" ,
					   external_plugins: { "filemanager" : "/assets/admin/filemanager/plugin.min.js"}

					});
			}
			init_tinymce();
	</script>
<?php } ?>