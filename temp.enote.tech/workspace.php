<?php

require_once("system/system.php");
session_start();
_header();
enable_javascript();

//start_document();

if ($_SESSION['login'] == "logout"){	
	echo "<script>document.location.href = 'http://temp.enote.tech/index.php'</script>";	
}



echo"<script>

var UID = ".$_SESSION['UID']."
	$(document).ready(function() { 
		see();
		add_memo(UID);	
		onload_user_memo(UID);
		//alert('Разрешение экрана: <b>'+$(window).width()+'×'+$(window).height()+'px.</b>');
	});



	
	
	
	
	
</script>
<style>

</style>
";



		
echo "

<div class='main_conteiner'>
	
		<div class='top_bar'>
		<div id='add_new_butt'></div>
		<div id='cat_butt'></div>
		<div id='favorite_butt'></div>
		<div id='search_butt'></div>
		<div id='exit'>!</div>	
	</div>

	
	<div class='memo_conteiner'> 

	</div>
	

</div> <!--_________________END_main_conteiner_______________-->


";
?>