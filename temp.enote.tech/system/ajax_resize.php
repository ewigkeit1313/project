<?php
	require_once("system.php");
		
		
		
if (!empty($_POST['memo_id'])){

$memo = $_POST['id'];
	
//	query_a($S_ARR,"user_id");
//	query_a($S_ARR,"memo_title");
//	query_a($S_ARR,"memo_content");
//	query_a($S_ARR,"memo_cat");
	query_a($S_ARR,"memo_width");
	query_a($S_ARR,"memo_height");
//	query_a($S_ARR,"memo_x");
//	query_a($S_ARR,"memo_y");
//	query_a($S_ARR,"memo_color");
	
	$who = "memo_id =".$_POST['memo_id'];
	
	$my_sql->query_save("note_memo",$who,$S_ARR,true,'',false);



echo 	$my_sql->error;	

	
}



	$my_sql->dbclose();	
?>