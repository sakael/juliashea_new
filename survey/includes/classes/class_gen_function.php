<?php 
class gen_function extends main_function 
{
	function gen_function()
	{
		parent::main_function();
	}
	function short_description($descr,$noc="") {
	
		$sdescr=strip_tags($descr);
		if(empty($noc))$noc=200;
		if(trim($sdescr)<>'')
		{
			if(strlen($sdescr)>$noc)
				return substr($sdescr, 0, $noc).".....";
			else
				return $sdescr;
		}
		else
		return $sdescr;
	}
	
	function putContent($id)
	{
		$res=parent::selectData(TABLE_CONTENT,"","content_id='".$id."'",1);
		$content=html_entity_decode($res['content_descr']);
		return $content;
	}
	///////////for redirect url////////
	function reDirect($url)
	{
		header("Location: ".$url);
		exit;
	}
/*	function goTo($url)
	{
		echo "<script>window.location.href='$url'</script>";
		exit;
	}
*/
	///////////for redirect url////////
	function filterData($data)
	{
		$fdata=parent::data_prepare($data,0);
		return stripslashes($fdata);
	}
	function get_page_name($path='')
	{
		$page_path = ($path != "") ? $path : $_SERVER['HTTP_REFERER']; 
		$url_parts = parse_url($page_path);
		$tmp_path = explode("/",$url_parts['path']); //pre($tmp_path);
		$page_name = array_pop($tmp_path);
		$page_name = !empty($page_name) ? $page_name : "index.php";
		$page_name .= ($url_parts['query'] != "") ? "?".$url_parts['query'] : "";
		$page_name .= ($url_parts['fragment'] != "") ? "#".$url_parts['fragment'] : "";
		return $page_name;
	}

	function customDate($date)
	{
		if(empty($date)||$date=='00/00/0000')
		{
			return '';
		}
		$dt=explode("/",$date);
		return $dt[2]."-".$dt[0]."-".$dt[1];
	}
	function customDatere($date)
	{
		if(empty($date)||$date=='0000-00-00')
		{
			return '';
		}
		$dt=explode("-",$date);
		return $dt[1]."/".$dt[2]."/".$dt[0];
	}
	function getContent($selval="")
	{
		$res=parent::selectData(TABLE_CONTENT);
		while($row=mysql_fetch_array($res))
		{
			$str="<option value='$row[content_id]'";
			if($row['content_id']==$selval)
			{
				$str.='selected';
			}
			$str.=">$row[content_title]</option>";
			echo $str;
		}
	}

	function sendMail($to="", $subject="", $body="",$from="",$fromname="",$type="",$replyto="",$bcc="",$cc="")
	{
		if(empty($type))
		{
			$type="html";
		}
		if($type=="plain")
		{
			$body = strip_tags($body);
		}
		if($type=="html")
		{
			$body = "<font face='Verdana, Arial, Helvetica, sans-serif'>".$body."</font>";
		}
		/* To send HTML mail*/ 
		$headers = "MIME-Version: 1.0\n"; 
		$headers.= "Content-type: text/".$type."; charset=iso-8859-1\r\n";
		/* additional headers */ 
		//$headers .= "To: <".$to.">\n"; 
		if(!empty($from))
		{
			$headers .= "From: ".$fromname." <".$from.">\n";
		}
		if(!empty($replyto))
		{
			$headers .= "Reply-To: <".$replyto.">\n"; 
		}
		if(!empty($cc))
		{
			$headers .= "Cc: ".$cc."\n";
		}
		if(!empty($bcc))
		{
			$headers .= "Bcc: ".$bcc."\n";
		}
		if(@mail($to, $subject, $body, $headers))
		{
			return 1;
		}
		else
		{
			return $headers;
		}
	}

	function formatdatetime($date)
	{
		if($date=="0000-00-00 00:00:00"||$date=="")
		{
			return "";
		}
		list($date, $time) = explode(' ',$date);
		list($yyyy, $mm, $dd) = explode('-',$date);
		list($hr, $mn, $sc) = explode(':',$time);
		$date = date('F jS, Y', mktime($hr,$mn,$sc,$mm,$dd,$yyyy));
		return $date;
	}
	function formatdate($date)
	{
		if($date=="0000-00-00"||$date=="")
		{
			return "";
		}
		list($yyyy, $mm, $dd) = explode('-',$date);
		$date = date('F jS, Y', mktime(0,0,0,$mm,$dd,$yyyy));
		return $date;
	}
	function makeString($str)
	{
		if($str!="")
		$str=nl2br(str_replace(" ","&nbsp;" ,wordwrap(html_entity_decode($str),96)));
		return $str;
	}
	function randCode($limit=8)
	{
		$rand=rand();
		$rand1=md5($rand);
		$rand2=rand(0,20);
		$code = substr($rand1, $rand2, $limit);
		return $code;
	}
	function encryptPass($strPass){
		$strPass=trim($strPass);
		$basePass=base64_encode($strPass);
		$revPass=strrev($basePass);
		$first4=$this->randCode(4);
		$last4=$this->randCode(4);
		$enc_revPass=$first4.$revPass.$last4;
		return $enc_revPass;
	}
	function retrievePass($enc_revPass){
		$pass=substr($enc_revPass,4);
		$last4=substr($pass,-4,4);
		$pass1=str_replace($last4,"",$pass);
		$revPass=strrev($pass1);
		$oriPass=base64_decode($revPass);
		return $oriPass;
	}
	function clientList($selval="",$cond=""){
		$sql=parent::selectData(TABLE_CLIENT,"","client_status='A'".$cond);
		$str="";
		while($row=mysql_fetch_array($sql))
			{
				$str.='<option value="'.$row['client_id'].'" ';
				if($selval==$row['client_id']) $str.='selected';
				$str.='>'.$row['client_username'].'</option>';
			}
		if($str=="")
		{
			return 0;
		}
		return $str;
	}
	function questionList($selval="",$cond="",$type=1){
		$sql=parent::selectData(TABLE_QUESTION,"","question_status='A'".$cond);
		$str="";
		while($row=mysql_fetch_array($sql))
			{
				$str.='<option value="'.$row['question_id'].'" ';
				if($selval==$row['question_id']) $str.='selected';
				if($selval=='all') $str.='selected';
				$str.='>';
				if($type==1)
				{
					$str.=$this->getQuesType($row['question_type'])."-&gt;&nbsp;";
				}
				$str.=$row['question_title'].'</option>';
			}
		if($str=="")
		{
			return 0;
		}
		return $str;
	}
	 function getDate($date)
		{
		$dt=explode('-',$date);
		$date  = date("F j ,Y",mktime(0, 0, 0, $dt[1],$dt[2],$dt[0]));
		return $date;
	}
	function checkUrl($txt)
	{
		if(trim($txt)=="")
		return '';
		$txt1="txt".trim($txt);
		$pos1 = strpos($txt1, "http://");
		$pos2 = strpos($txt1, "https://");
		if(!($pos1||$pos2))
		{
			$txt="http://".$txt;
		}
		return $txt;
	}
	function chkEmpty($val,$empty=0)
	{
		
		if(empty($val)) 
		{
			if($empty==1) $str=''; else $str='Not Available';
			return $str;
		}
		else return stripslashes($val);
	}

	function getTypetitle($type,$id)
	{
		$table='TABLE_'.strtoupper($type);
		$field=$type.'_id';
		$sql=parent::selectData(constant($table),"","$field='".$id."'",1);
		$title=$type.'_title';
		return $sql[$title];
	}
	function getSurveyType($selval="")
	{
		if(is_array($selval))
		{
			$selid=$selval;
		}
		else
		{
			$selid=array($selval);
		}
		$res=parent::selectData(TABLE_SURVEYTYPE,"","surveytype_status='A'");
		while($row=mysql_fetch_array($res))
		{
			$str="<option value='".$row['surveytype_id']."'";
			if(in_array($row['surveytype_id'],$selid))
			{
				$str.='selected';
			}
			$str.=">".$row['surveytype_title']."</option>";
			echo $str;
		}
	}
	function getSurvey($selval="",$cond="")
	{
		if(is_array($selval))
		{
			$selid=$selval;
		}
		else
		{
			$selid=array($selval);
		}
		$res=parent::selectData(TABLE_SURVEY,"","survey_status='A' ".$cond);
		while($row=mysql_fetch_array($res))
		{
			$str="<option value='".$row['survey_id']."'";
			if(in_array($row['survey_id'],$selid))
			{
				$str.='selected';
			}
			$str.=">".$row['survey_title']."</option>";
			echo $str;
		}
	}
	function getIndustry($selval="")
	{
		if(is_array($selval))
		{
			$selid=$selval;
		}
		else
		{
			$selid=array($selval);
		}
		$res=parent::selectData(TABLE_INDUSTRY,"","industry_status='A'");
		while($row=mysql_fetch_array($res))
		{
			$str="<option value='".$row['industry_id']."'";
			if(in_array($row['industry_id'],$selid))
			{
				$str.='selected';
			}
			$str.=">".$row['industry_title']."</option>";
			echo $str;
		}
	}
	function get_title_fromID($table, $field, $field_id, $field_id_val)
	{
		$res=parent::selectData("$table",$field,"$field_id='".$field_id_val."'",1);
		if($res[$field]=="") return 'Not Available';
		else return $res[$field];
	}
	function uploadFiles($file_id, $folder="", $types="")
	{
		if(!$_FILES[$file_id]['name']) return array('','No file specified');
	
		$file_title = $_FILES[$file_id]['name'];
	
		$uniqer = date("YmdHis");
		$file_name = $uniqer . '_' . $file_title;//Get Unique Name

		if($types)
		{
			//Get file extension
			$path_parts = pathinfo($file_title);
			$ext = strtolower($path_parts["extension"]); //Get the extension
			$all_types = explode(",",strtolower($types));
			if(!in_array($ext,$all_types))
			{
				$result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
				return array('',$result);
			}
		}
	
		//Where the file must be uploaded to
		if($folder)
		{
			if(substr($folder, -1)!='/')
			{
				$folder .= '/';//Add a '/' at the end of the folder
			}
		}
		$uploadfile = $folder . $file_name;
	
		$result = '';
		//Move the file from the stored location to the new location
		if (!@move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
			$result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
			if(!file_exists($folder)) {
				$result .= " : Folder don't exist.";
			} elseif(!is_writable($folder)) {
				$result .= " : Folder not writable.";
			} elseif(!is_writable($uploadfile)) {
				$result .= " : File not writable.";
			}
			$file_name = '';
			
		} else {
			if(!$_FILES[$file_id]['size']) { //Check if the file is made
				@unlink($uploadfile);//Delete the Empty file
				$file_name = '';
				$result = "Empty file found - please use a valid file."; //Show the error message
			} else {
				chmod($uploadfile,0777);//Make it universally writable.
			}
		}
		return array($file_name,$result);
	}
	function getQuesOrder($survey_id)
	{
		$row=parent::selectData(TABLE_SURVEY_QUESTION,"max(question_order) as max_q_odr","survey_id='".$survey_id."'",1);
		return($row['max_q_odr']+1);
	}
	function getQuesOrderInfo($survey_id)
	{
		$row=parent::selectData(TABLE_SURVEY_QUESTIONINFO,"max(question_order) as max_q_odr","survey_id='".$survey_id."'",1);
		return($row['max_q_odr']+1);
	}
	function getQuesType($type)
	{
		switch ($type) { 
		   case 1: 
			   $qt="Multiple Choice"; 
			   break; 
		   case 2: 
			   $qt="Comment/Essay"; 
			   break;
		   default: 
			   $qt="Multiple Choice"; 
		}
		return $qt; 
	}
	function attendStatus($type)
	{
		switch ($type) { 
		   case 'Y': 
			   $qt="Yes"; 
			   break; 
		   case 'N': 
			   $qt="No"; 
			   break;
		   case 'P': 
			   $qt="Not Completed"; 
			   break;
		   default: 
			   $qt="No"; 
		}
		return $qt; 
	}
	function generateKey($length=6)
	{
		$_rand_src = array(
			array(48,57) //digits
			, array(97,122) //lowercase chars
			, array(65,90) //uppercase chars
		);
		srand ((double) microtime() * 1000000);
		$random_string = "";
		for($i=0;$i<$length;$i++){
			$i1=rand(0,sizeof($_rand_src)-1);
			$random_string .= chr(rand($_rand_src[$i1][0],$_rand_src[$i1][1]));
		}
		$row=parent::selectData(TABLE_SURVEY_CLIENT,"","survey_client_key='".$random_string."'",1);
		if($row==0)
		{
			return $random_string;
		}
		else
		{
			return $this->generateKey(6);
		}
	}
	function generateUserCode($length=6)
	{
		$_rand_src = array(
			array(48,57) //digits
			, array(97,122) //lowercase chars
			, array(65,90) //uppercase chars
		);
		srand ((double) microtime() * 1000000);
		$random_string = "";
		for($i=0;$i<$length;$i++){
			$i1=rand(0,sizeof($_rand_src)-1);
			$random_string .= chr(rand($_rand_src[$i1][0],$_rand_src[$i1][1]));
		}
		$row=parent::selectData(TABLE_SURVEY_USER,"","survey_user_code='".$random_string."'",1);
		if($row==0)
		{
			return $random_string;
		}
		else
		{
			return $this->generateUserCode(6);
		}
	}
	function getSurveyLink($survey_title,$survey_client_key)
	{
		return FURL.str_replace(" ", "-", $survey_title).'/'.$survey_client_key.'/';
	}
	function validate_email($email) 
	{
		return eregi("^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$", $email);
	}
	function getSurveyTitle($id)
	{
		$row=parent::selectData(TABLE_SURVEY,"survey_title","survey_id='".$id."'",1);
		return $row['survey_title'];
	}
	function getClientLogoBanner($id)
	{
		$row=parent::selectData(TABLE_CLIENT,"client_logo,client_banner","client_id='".$id."'",1);
		return array($row['client_logo'],$row['client_banner']);
	}
	function delete_all_files($Dir){
		if ($handle = @opendir($Dir)) {
		   while (false !== ($file = readdir($handle))) { 
			   if ($file != "." && $file != "..") { 
				   @unlink($Dir.$file); 
			   } 
		   } 
		   closedir($handle); 
		}
	}
	function getInfoDdArr($ddtype="")
	{
		if(!empty($ddtype))
		{
			$cond="infodd_type='".$ddtype."'";
		}
		$res=parent::selectData(TABLE_INFODD,"",$cond);
		while($row=mysql_fetch_array($res))
		{
			$infoarr[$row['infodd_type']]['title'][]=$row['infodd_title'];
		}
		return $infoarr;
	}
	function getInfoDd($arr,$selval="")
	{
		for($i=0;$i<count($arr);$i++)
		{
			$str="<option value='".$arr[$i]."'";
			if($arr[$i]==$selval)
			{
				$str.='selected';
			}
			$str.=">".$arr[$i]."</option>";
			echo $str;
		}
	}
	function fileWrite($content,$filename)
	{
		$text=stripcslashes($content);
		if(empty($text))
		{
			$text='  ';
		}
		if (file_exists($filename)) 
		{
			unlink($filename);
		}
		if (!$handle = fopen($filename, 'w+')) { 
				//print "Cannot open file ($filename)"; 
				return "Cannot open file:".$filename;
		   } 
		if (is_writable($filename)) { 
		   // In our example we're opening $filename in append mode. 
		   // The file pointer is at the bottom of the file hence 
		   // that's where $somecontent will go when we fwrite() it. 
		   // Write $somecontent to our opened file.
		   if (!fwrite($handle, $text)) { 
			   //print "Cannot write to file ($filename)"; 
			  return "Cannot open file:".$filename;
		   } 
		   else { 
			   return "Successfully updated."; 
		   } 
		   fclose($handle); 
							
		} else { 
			return "File:".$filename." Not Writeable."; 
		} 
	}
	function dateminus($datestr, $num, $unit)
	{
       $units = array("Y","m","d","H","i","s");
       $unix = strtotime($datestr);
       while(list(,$u) = each($units)) $$u = date($u, $unix);
       $$unit -= $num;
       return mktime($H, $i, $s, $m, $d, $Y);
	}
}
?>