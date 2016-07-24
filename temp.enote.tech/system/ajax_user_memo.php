<?php
require_once("system.php");
//start_document();
enable_javascript();

if ($_POST['act'] == 'load'){
	
	
	if (!empty($_POST['user_id'])){
		
		$res = $my_sql->dbquery("SELECT * FROM note_memo WHERE user_id = '".$_POST['user_id']."'");
		
		
		
		while ($memo_arr = $my_sql->dbarray($res)){
			$arr[$memo_arr['memo_id']] = $memo_arr;
		};
		
		
		

		
		foreach ($arr as $key => $val){
			echo "
				<script>
				

				
				
						$('#m_id".$val['memo_id']."').attr('style', 'width: ".$val['memo_width']."px !important'); 
						
						
						$('#m_id".$val['memo_id']."').css({'background-color':'".$val['memo_color']." !important'});
						$('#m_id".$val['memo_id']."').css({'height':'".$val['memo_height']."px',
														   'left':'".$val['memo_x']."px',
														   'top':'".$val['memo_y']."px'
						});
						
						
						

				</script>
				
				
				
							<div class='memo' id='m_id".$val['memo_id']."' memo_id='".$val['memo_id']."'>
							
							
							
									<div class='top_memo' m_id='".$val['memo_id']."'>".$val['memo_title']."</div>
										<div class='body_memo' contenteditable='true' m_id='".$val['memo_id']."'>".$val['memo_content']."</div>
							</div>
			
		
			
			";	
		}
	}
}



if ($_POST['act']  == 'save'){
	
	//$top = $_POST['memo_y'];
	//$left = $_POST['memo_x'];
//	$memo_id = $_POST['memo_id'];
	
	//echo "<script> alert('".$top."-->".$left."-->".$memo_id."');</script>";
	

	query_a($S_ARR,"memo_x");
	query_a($S_ARR,"memo_y");
	

	
	$who = "memo_id =".$_POST['memo_id'];
	
	$my_sql->query_save("note_memo",$who,$S_ARR,true,'',false);

	
	
}







$my_sql->dbclose();	
?>