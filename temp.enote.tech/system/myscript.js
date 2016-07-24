	var url = '?act=save';

function move_memo(memo_id,x,y){


			if (memo_id != undefined){
				
				
				data.push({name: 'act', value: 'save'});
				data.push({name: 'memo_x', value: x});
				data.push({name: 'memo_y', value: y});
				data.push({name: 'memo_id', value: memo_id});
				
				
					$.ajax({
						url: "/system/ajax_user_memo.php",
						type: "POST",
						data: data,
						cache: true,
						async: false,
						
						success: function(html){
									//onload_user_memo(user_id);
							//onload_user_memo(memo_id);
						}
					});
				
				
				
			}
}
	
	
	
	

function valid(target,act_log){
	
			if (act_log!==undefined){
			url = url+'&act_log='+act_log;
		}	
		
		
	// validate the form when it is submitted
	var validator = $("#f_check_in").validate({
		
		rules : {
			nickname : {required : true, minlength: 3},
			email : {required : true },
			password : {required : true, minlength: 5}
		},


		messages: {
			nickname: {
				required: "",
				minlength: ""
			},
			email: {
				required: "",
				minlength: "",
				maxlength: ""
			},
			
			password: {
				required: "",
				minlength: "Минимум 5 символов",
				maxlength: "Максимум 30 символов"
			}
			
		},

		invalidHandler: function (event, validator) {
				alert("Все херня, давай сначала!")
        },
		

	

	
					submitHandler: function(form){
						                                  /*$('#f_check_in').ajaxSubmit({
					                                      target: '#result', 
					                                       success: function() { 
						                                  $('#FormBox').slideUp('fast'); 
							                              alert("Пашет, наконец то!!!!");  
					                                      } 
				                                          });*/
					
							var data = $('form#'+target).serializeArray();
					
							$.ajax({
								url: '/system/ajax_check_in.php'+url,
								type: 'POST',
								data: data,
								cache: true,
								async: false,
							
								success: function(html){
										alert('success!!!');
										$('.modal_form_content').html(html);
								}
							});
														  
					}

	});

	
	
	$(".cancel").click(function() {
		validator.resetForm();
	});
}



var id;
var act;
var act_log;
var data = [];
var target;
var user_id;
var x;
var y;
var memo_id;
var width;
var height;
               function Modal_Window(target_ajax,id,act,act_log){
				   
				   $('body').append('<div id=overlay>');
				   
					
				   
						$('#overlay').bind('click',function(){
							$('#overlay').remove();
							$('.modal_form').remove();
						})
					
					
					data.push({name: 'id', value: id});
					data.push({name: 'act', value: act});
					data.push({name: 'act_log', value: act_log});
					
					
					target = target_ajax;
	
                    
					$.ajax({
                        url: '/system/'+target,
                        type: 'POST',
                        data: data,
                        cache: false,
                           async: false,
                    
					     success: function(html){
          					$('.there').html(html);
							valid('f_check_in',act_log);
						}
                    });
					
               } 

			   
			   
			   
		function see(){
			 $('#exit').bind('click',function(){
						$.ajax({
								url: '/system/ajax_exit.php?act=exit',
								type: 'POST',
								data: data,
								cache: true,
								async: false,
							
								success: function(html){
										document.location.href = 'http://temp.enote.tech/index.php'	
								}
							});

			});
		}


		
	
	$(init);

function init() {
  $('.memo').draggable( {
    containment: '.main_conteiner',
    snap: '.main_conteiner',
	handle: '.top_memo',
	stop: function(event,ui){
				y = ui.offset.top;
				x = ui.offset.left;
				memo_id = $(this).attr('memo_id');
				move_memo(memo_id,x,y);
			}
		
  } );
  
  					
					$('.memo').resizable({
						minWidth: '250',
						minHeight: '100',
						
						stop: function(event,ui){
							memo_id = $(this).attr('id');
							id = $(this).attr('memo_id');
							resize(memo_id,id);
						}
						
					});
  
  
}


function add_memo(u_id){
	$('#add_new_butt').bind('click',function(){
		
		if (u_id != undefined){	
				user_id = u_id;
		}else{
			return false;			
		}

	//var top = $('.memo').offset().top;
	//var left = $('.memo').offset().left;
	//alert('top: '+ top+' left: '+ left); 
	
	data.push({name: 'id', value: user_id});
	data.push({name: 'act', value: 'add_memo'});
	
		$.ajax({
			url: '/system/ajax_add_memo.php',
			type: 'POST',
			data: data,
			cache: true,
			async: false,
			
			success: function(html){
					$('.memo_conteiner').append(html);	
						location.reload();
				//$('.memo_conteiner').append(html);
			}
			
		});
	});	
}



function onload_user_memo(u_id){
		
		if (u_id != undefined){
			user_id = u_id;			
		}else{
			return false;
		}
		
		data.push({name: 'user_id', value: user_id});
		data.push({name: 'act', value: 'load'});
		
		$.ajax({
			url:"/system/ajax_user_memo.php",
			type:"POST",
			data: data,
			cache: true,
			async: false,
			
			success: function(html){
					$('.memo_conteiner').append(html);

			}
			
			
		});
		
	
}


function resize(m_id,id){
	width = $('#'+m_id).outerWidth();
	height = $('#'+m_id).outerHeight();
	
	data.push({name: 'memo_id', value: id});
	data.push({name: 'memo_width', value: width});
	data.push({name: 'memo_height', value: height});
	
	
	
	$.ajax({
			url: '/system/ajax_resize.php',
			type: 'POST',
			data: data,
			cache: true,
			async: true,
			
			success: function(){
	
			}
		
	});
	
}




