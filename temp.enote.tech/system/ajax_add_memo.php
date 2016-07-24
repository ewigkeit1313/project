<?php
require_once("system.php");
//start_document();
enable_javascript();






if (!empty($_POST['id']) && $_POST['act'] == 'add_memo'){

$user_id = $_POST['id'];
	
	query_a($S_ARR,"user_id",$user_id);
	query_a($S_ARR,"memo_title","");
	query_a($S_ARR,"memo_content","");
	query_a($S_ARR,"memo_cat","");
	query_a($S_ARR,"memo_width","300");
	query_a($S_ARR,"memo_height","150");
	query_a($S_ARR,"memo_x","100");
	query_a($S_ARR,"memo_y","100");
	query_a($S_ARR,"memo_color","#fff8c7");
	
	$who ="";
	
	$my_sql->query_save("note_memo",$who,$S_ARR,true,'',false);


/*	
echo 	$my_sql->error."
			<div class='memo' m_id='".$my_sql->insert_id."'>
					<div class='top_memo' m_id='".$my_sql->insert_id."'></div>
						<div class='body_memo' contenteditable='true' m_id='".$my_sql->insert_id."'></div>

			</div>
";	
*/
	
}

 
 



$my_sql->dbclose();	
?>