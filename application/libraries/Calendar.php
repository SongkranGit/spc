<?php

class Calendar {
    
    public static function getCurDateYYYYMMDD(){
        return   date("dd-mm-yy");
    }
    public static function getSystemDate(){
      	return   date("Y-m-d");
    }
    
	 public static function getThaiSystemDate(){
      	$date =   date("d-m-Y");
		$strDate = date('d' , strtotime($date));
		$strMonth = date('m' , strtotime($date));
		$strYear = date('Y' , strtotime($date))+543;
		return $strDate.'-'.$strMonth.'-'.$strYear;
    }
	
	public static function getThaiSystemDateTime(){
      	$date =   date("d-m-Y");
		$strDate = date('d' , strtotime($date));
		$strMonth = date('m' , strtotime($date));
		$strYear = date('Y' , strtotime($date))+543;
		return $strDate.'-'.$strMonth.'-'.$strYear.' '.date("H:i" , time());
    }


    public static function systemTime(){
        return date("H:i:s" , time());
    }
	
	public static function currentDateTimeThai(){
		
	    $strDate = date("F j Y, g:i a");  
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
   }
	

	public static function currentDateTime(){
		$date = date("Y-m-d H:i:s");
		return $date;
	}
	
	public static function setDateTime($date){
		if($date!= ''){
		  // $arrDate = split('-',$date);
		  //$arrHourMin = split(':' ,date('H:i'));
	      $oDateTime = new DateTime($date);
		 // $oDateTime->setDate($date);
		  //$oDateTime->setTime(time());
          return  $sDate = $oDateTime->format("Y-m-d h:i:s");
		}else{
			return "";
		}
	}
	
	public static function con2MysqlDate($date){ 
		if(  $date !=NULL && $date !=''){
//			$spVal = explode( '-', $date);
//			$date = ($spVal[2]-543 )."/".$spVal[1]."/".$spVal[0];
//            $mysqlDate = date('Y-m-d', strtotime($date));
			//$datetime = date('Y-m-d H:i:s', strtotime($date));
			return date('Y-m-d H:i:s', strtotime($date));
		}else{
			return "";
		}
	}
	
	public static function getDateDDMMYYYYHS($dateTime){
		$bool = false; // check valid date time
	 	if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
			if (checkdate($matches[2], $matches[3], $matches[1])) {$bool = true;}
		}else{$bool = false;}
		if($bool){
			$dtm = new DateTime($dateTime);
	     	return $dtm->format("d-m-Y h:s");
		}else{
			return "";
		}
		
	}
	//=== get Date from Query
	public static function formatDateTimeToDDMMYYYY($mysqldate){
		if(empty($mysqldate)){
			return "-";
		}else{
			$format = 'd-m-Y H:i:s';
			$phpdate = strtotime( $mysqldate );
			$mysqldate = date( $format, $phpdate );
			return $mysqldate;
		}
	}

	public static function formatDateToDDMMYYYY($mysqldate){
		if(empty($mysqldate) || $mysqldate == 0){
			return "-";
		}else{
			$format = 'd-m-Y';
			$phpdate = strtotime( $mysqldate );
			$mysqldate = date( $format, $phpdate );
			return $mysqldate;
		}
	}
	
	public static function getTimeHHSS($dateTime){
		$bool = false; // check valid date time
	 	if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
			if (checkdate($matches[2], $matches[3], $matches[1])) {$bool = true;}
		}else{$bool = false;}
		
		if($bool ){
			$dtm = new DateTime($dateTime);
			return $dtm->format("hh:ss");
		}else{
			return "";
		}
	}
	
	function isValidDateTime($dateTime){
		if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
			if (checkdate($matches[2], $matches[3], $matches[1])) {
				return true;
			}
		}
		return false;
	}
	
}

?>
