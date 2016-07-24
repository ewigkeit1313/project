<?php



//кодировка
setlocale(LC_ALL, "ru_RU.UTF-8");
header("Content-type: text/html; charset=UTF-8");

	
//------------------------------------------------------------------------------
function finish_document() {
 global $dblink_common,$dblink_site;
 mysql_close($dblink_common);
 if ($dblink_site>0) mysql_close($dblink_site);
 echo "</div></div></body></html>";
}
	

//___________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________неибических размеров глупость___________________________________________________________________


class my_sql extends mysqli{

/*
	public function __construct($connect_config = array()){
		@parent::__construct(
			$connect_config['host'],
			$connect_config['username'],
			$connect_config['password'],
			$connect_config['dbname']
		);
		
		if ($this->connect_error){
			throw new \Exception(
				$this->connect_error,
				$this->connect_errno
			);
		}
	}
*/	
	public function connect_db(){
		@parent::__construct('localhost',
								'u0207591_su',
								'Htkmcsyf1995!!',
								'u0207591_note');
		
	}

	public function dbquery($query){
			$res_query = $this->query($query);
			return $res_query;
	}
	
	public function dbarray($res_query){
			$array = $res_query->fetch_assoc();
			return $array;
	}
	
	public function dbclose(){
			$this->close();
	}
	
	
	public function dbrows($res_query){
			$count = $res_query->num_rows;
			return $count;
	}
	
	
	
	function query_save($table,$where,$A,$usenull=true,$adv_tag='',$prefix=true) {
			if ($where=="") {$add=true;} else {$add=false;}     
				if ($add) {     
					$q="INSERT INTO ".($prefix?DB_PREFIX:"").$table;     
					$fields=" (";     
					$values=" VALUES (";     
				} else {     
					$q="UPDATE ".($prefix?DB_PREFIX:"").$table." SET ";     
				}      
      
		foreach ($A as $k=>$v) {     
			if ($add) {$fields.=$k.",";} else {$q.=$k."=";}
				if ($v!=='null') {     
					if ($v=='') {     
						$v="''";     
					} else {     
						if ($v[0]!=="'") $v="'".$v;     
						if ($v[strlen($v)-1]!=="'") $v.="'";     
					}      
				}      
				
				if ($add) {$values.=$v.",";} else {$q.=$v.",";}     
		}     
     
			if ($add) {     
				$fields[strlen($fields)-1]=")";     
				$values[strlen($values)-1]=")";     
				$q.=$fields.$values;     
			} else {     
				$q[strlen($q)-1]=" ";     
				$q.=" WHERE ".$where;     
			}
			
			$q.=" ".$adv_tag;
		
			$this->dbquery($q);
    return $q;
}
	
	
	
} //______________________________________________end_class_my_sql__________________________________________________________________________________________________


$my_sql = new my_sql;
$my_sql->connect_db();

//connect к бд с помощью нашего класса...
/*
$my_sql = new my_sql(array(
	'host' => 'localhost',
	'username'=> 'u0207591_su',
	'password' => 'Htkmcsyf1995!!',
	'dbname' => 'u0207591_note'
));
*/

$my_sql->set_charset('utf8');

//echo get_class($my_sql); //проверка класса



function who($nick,$email){
	
$my_sql = new my_sql;
$my_sql->connect_db();

				if (!empty($email)){
					$in_email = "AND email='".$email."'";					
				}else{
					$in_email = false;
				}
	
	$res = $my_sql->dbquery("SELECT id,nickname,email FROM note_users WHERE nickname='".$nick."' ".$in_email." ");
			$arr = $my_sql->dbarray($res);
				//$_SESSION["UID"] = $arr['id']; 
				
				$_SESSION['login'] = "login";
				$_SESSION['UID'] = $arr['id'];
}

//__________________________________________________________________________________________________________________________________________________________________________________________

/* проверяем соединение */
if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

/*
function dbclose(){
	$mysqli->close();
}


function dbarray($query) {
 if (!$query = mysql_fetch_assoc($query)) if (iADMIN) echo mysql_error();
 return $query;
}
*/

function dbresult($query, $row) {
 if (!$query = mysql_result($query, $row)) echo mysql_error();
 return $query;
}


/*
function dbquery($query) {
global $query_count,$dblink_common;
 $query_count++;
 if (!$query = mysql_query($query,$dblink_common)) if (iADMIN) echo mysql_error();
 return $query;
}
*/

function query_A(&$A,$field,$value='%') {     
 $ok=true;     
 if ($value==='%' || $value===null) {     
  if (isset($_POST[$field])) {     
   $A[$field]=$_POST[$field];     
  } else {     
   $ok=false;     
  }      
 } else {     
  $A[$field]=$value;      
 }     
 if ($ok) {     
  $A[$field]=trim(str_replace("\\","",$A[$field]));     
  $A[$field]=trim(str_replace("\"","",$A[$field]));     
  //$A[$field]=str_replace("ั‘","ะต",$A[$field]);     
  $A[$field]=preg_replace("% +%", " ",$A[$field]);     

  if ($value==null && $A[$field]=='') $A[$field]='null';     
 }
}
//__________________________________________________________________________________________________________________________________________________________________________________________

function _header(){
	echo "<!DOCTYPE html>
			<html>
					<head>
						<title>e-note!</title>
						<link rel='shortcut icon' href='images/favicon.ico' type='image/x-icon'>	
					
						<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
						<meta HTTP-EQUIV='Expires' CONTENT='0'>
						<meta HTTP-EQUIV='Pragma' CONTENT='no-cache'>
						<meta name='keywords' content='".$settings['keywords']."'>
 
						
					
						<link rel='stylesheet' media='(min-width: 1600px)' href='/css/system_big.css'>
						<link rel='stylesheet' media='(max-width: 1599px) and (min-width: 1035px)' href='/css/system_mid.css'>
						<link rel='stylesheet' media='(max-width: 1034px) and (min-width: 300px)' href='/css/system_small.css'>
					



							<link href='https://fonts.googleapis.com/css?family=Lobster&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
					</head>
				<BODY>";
	
}


function enable_javascript(){
					echo"
						<script type='text/javascript' src='/system/jquery-3.0.0.js'></script>
						<script type='text/javascript' src='/system/jquery.validate.js'></script>
						<script type='text/javascript' src='/system/jquery-ui.min.js'></script>
						<script type='text/javascript' src='/system/myscript.js'></script>
					";
	
}




function start_document($css=true,$session=true,$container=true) {
		
		global $start_time,$query_count,$userdata,$settings,$total_user_count;
			
			if ($css && $container) {
					$cont_str_begin="<div id='highest_container' align=center><div id='body_container' style='width:1135px;'>";
			} else {
					$cont_str_begin="<div id='highest_container'><div id='body_container'>";
			}
 
			if ($session) session_start();
 
		echo "<!DOCTYPE html>";
			echo "<html>
					<head>
						<title>e-note!</title>
						<link rel='shortcut icon' href='images/favicon.ico' type='image/x-icon'>	
					
						<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
						<meta HTTP-EQUIV='Expires' CONTENT='0'>
						<meta HTTP-EQUIV='Pragma' CONTENT='no-cache'>
						<meta name='keywords' content='".$settings['keywords']."'>
 
						
					
						<link rel='stylesheet' media='(min-width: 1600px)' href='/css/system_big.css'>
						<link rel='stylesheet' media='(max-width: 1599px) and (min-width: 1035px)' href='/css/system_mid.css'>
						<link rel='stylesheet' media='(max-width: 1034px) and (min-width: 300px)' href='/css/system_small.css'>
					
					
						<script type='text/javascript' src='/system/jquery-3.0.0.js'></script>
						<script type='text/javascript' src='/system/jquery.validate.js'></script>
						<script type='text/javascript' src='/system/jquery-ui.min.js'></script>
						<script type='text/javascript' src='/system/myscript.js'></script>


							<link href='https://fonts.googleapis.com/css?family=Lobster&subset=cyrillic,latin' rel='stylesheet' type='text/css'>";
					echo "</head>";
					
					
	

   $start_time = microtime();
   $start_array = explode(" ",$start_time);
   $start_time = $start_array[1] + $start_array[0];
   $query_count = 0;

 }	 


?>