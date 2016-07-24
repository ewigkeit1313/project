<?php
require_once("system.php");
session_start();
enable_javascript();



    foreach ($_POST as $key=>$val){
	    $_ARR[$key] = $_POST[$key];
    }

	

	if ($_ARR['act']=='show' && $_ARR['act_log']=='check_in'){
		echo "<div class='modal_form'>
			<div class='top_modal_form'>Вход/Регистрация</div>
		
				<div class='modal_form_content'>

	
	<form method='post' class='cmxform' id='f_check_in' action=''>
				<table>
						<tr>
							<td><div>Ник: </td>
							<td><input id='nickname' class='check_in_f' type='text' name='nickname'></div></td>
						</tr>

						<tr>
							<td><div>E-mail: </td>
							<td><input id='email' class='check_in_f' type='email' name='email'></div></td>
						</tr>						
						
						<tr>
							<td><div>Пароль: </td>
							<td><input id='password' class='check_in_f' type='password' name='password'></div></td>
						</tr>
						
						<tr>
							<td colspan='2'><div><input id='submit_check_in_form' type='submit' value='Сохранить'></div> </td>
						</tr>
						
				</table>
	</form>
	
	
	
				</div>
			</div>";		
	}
	
	
//_____________________________________________________________________________________________________________________________________________


		if ($_ARR['act']=='show' && $_ARR['act_log']=='login'){
		echo "<div class='modal_form'>
				<div class='top_modal_form'>Вход/Регистрация</div>
		
				<div class='modal_form_content'>

	
	<form method='post' class='cmxform' id='f_check_in' action=''>
				<table>
						<tr>
							<td><div>Ник: </td>
							<td><input id='nickname' class='check_in_f' type='text' name='nickname'></div></td>
						</tr>
								
						<tr>
							<td><div>Пароль: </td>
							<td><input id='password' class='check_in_f' type='password' name='password'></div></td>
						</tr>
						
						<tr>
							<td colspan='2'><div><input id='submit_check_in_form' type='submit' value='Вход'></div> </td>
						</tr>
						
				</table>
	</form>
	
	
	<div id='special_div'></div>
				</div>
			</div>";		
	}

//_____________________________________________________________________________________________________________________________________________






	if ($_GET['act']=='save' && $_GET['act_log']=='check_in'){
		
		echo"<script>alert('check_in')</script>";
		
		$pass = md5($_ARR['password']);
		
			
			query_a($S_ARR,"nickname");
			query_a($S_ARR,"email");
			query_a($S_ARR,"password",$pass);
			
			
			//echo $S_ARR['nickname'];

			$res=$my_sql->query("SELECT nickname,email FROM note_users WHERE nickname = '".$S_ARR['nickname']."' OR email = '".$S_ARR['email']."' ");
				
			
			if ($my_sql->dbrows($res)){
				$_SESSION['login'] = "logout";
				echo"<script> document.location.href = 'http://temp.enote.tech'</script>";

			}else{

				$my_sql->query_save("note_users",$who,$S_ARR,true,'',false);
				
				who($S_ARR['nickname'],$S_ARR['email']);
								
				$text_mail = "
					<table>
						<tr collspan=2>
							<td><H3><i>Зравствуйте, ".$S_ARR['nickname']."!<H3></i></td>
							<td></td>
						</tr>
						
						<tr>
							<td>Ваш логин:</td>
							<td>".$S_ARR['nickname']."</td>
						</tr>
						
						<tr>
							<td>Пароль:</td>
							<td>".$_ARR['password']."</td>
						</tr>
					
					</table>
				
				
				
				
				
				";
				
				require_once("__libmail.php");
				
					$m= new Mail; // начинаем 
					$m->From( "admin@enote.tech" ); // от кого отправляется почта 
					$m->To( $S_ARR['email'] ); // кому адресованно
					$m->Subject( "Не потеряйте!" );
					$m->Body( $text_mail ,"html" );   
								//"Здравствуйте, ". $_ARR['nickname']."\n Ваш логин: ". $_ARR['nickname'] ."\n Ваш email: ".$_ARR['email']."\n Ваш пароль: ".$_ARR['password']					
					//$m->Cc( "copy@asd.com"); // копия письма отправится по этому адресу
					$m->Bcc( "bcopy@asd.com"); // скрытая копия отправится по этому адресу
					$m->Priority(1) ;    // приоритет письма
					//$m->Attach( "asd.gif","", "image/gif" ) ; // прикрепленный файл 
					//$m->smtp_on( "scp58.hosting.reg.ru", "u0207591", "Htkmcsyf1995!!", 465, 10) ; // если указана эта команда, отправка пойдет через SMTP .0.
					$m->Send();    // а теперь пошла отправка

						//echo "Показывает исходный текст письма:<br><pre>", $m->Get(), "</pre>";
				
				
				echo"<script> 
							alert('пользователь добавлен!');
							document.location.href = 'http://temp.enote.tech'
					</script>";
			}
	}
	
	
	
		if ($_GET['act']=='save' && $_GET['act_log']=='login'){
		
				$pass = md5($_ARR['password']);
				
		
				$res = $my_sql-> dbquery("SELECT id,nickname,password FROM note_users WHERE nickname='".$_ARR['nickname']."' AND password='".$pass."' ");
				
				if ($my_sql->dbrows($res)){
						$arr = $my_sql->dbarray($res);
					
					
					$_SESSION['login'] = "login";
					$_SESSION['UID'] = $arr['id'];
					
					echo"<script> 
							document.location.href = 'http://temp.enote.tech'
					</script>";
				}
		
		
		}
	
	
	
	
$my_sql->dbclose();	

?>