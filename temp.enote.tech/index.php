<?php
require_once("system/system.php");
session_start();
_header();
enable_javascript();
//start_document();

if ($_SESSION['login'] == "login"){
	echo "<script>document.location.href = 'http://temp.enote.tech/workspace.php'</script>";	
}


echo "<script>

    $(document).ready(function(){
            $('.main_link').bind('click',function(){
			
			var id = $(this).attr('id');
			var act = $(this).attr('act');
			var act_log = $(this).attr('act_log');
			var target_ajax = 'ajax_check_in.php';
			
				Modal_Window(target_ajax,id,act,act_log);
		
			});
			see();
	});



</script>";

echo "<div class='main_conteiner_begin'>
	
	<div class='start_window'>
		<div class='there'></div>
		<div id='info'>
				<h1><i>привет!)</i></h1>
		</div>
		<div class='main_link' id='check_in' act='show' act_log='check_in'>Регистрация</div>
		<div class='main_link' id='log_in' act='show' act_log='login'>Вход</div>
	</div>
	
</div>";


?>