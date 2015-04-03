<?php
function convertDate($rawDate){
   global $logYear;
   $dateParts = explode(' ',$rawDate,4);
   switch($dateParts[0]){
      case "Jan":$monthNum = "01"; break;  case "Feb":$monthNum = "02"; break;
      case "Mar":$monthNum = "03"; break;  case "Apr":$monthNum = "04"; break;
      case "May":$monthNum = "05"; break;  case "Jun" :$monthNum = "06"; break;
      case "Jul":$monthNum = "07"; break;  case "Aug" :$monthNum = "08"; break;
      case "Sep" :$monthNum = "09"; break;  case "Oct" :$monthNum = "10"; break;
      case "Nov" :$monthNum = "11"; break;  case "Dec" :$monthNum = "12"; break;
   }
   
   if($dateParts[1]==""){
   $newDate = $logYear . "-" . $monthNum . "-0" . $dateParts[2] . " " . $dateParts[3];
   }
   else{
   $newDate = $logYear . "-" . $monthNum . "-" . $dateParts[1] . " " . $dateParts[2];
   }
   return $newDate;
}

function getLogYear(){
   exec('ls -l auth.log',$lsDashL);
   exec('date',$dateLine);
   $lsParts = explode(' ',$lsDashL[0],10); #want 8 from'-rwxrwxrwx 1 mikebike mikebike 7095724 Mar 24 18:50 auth.log'
   $dateParts = explode(' ',$dateLine[0],6); # want 5 from 'Mon Mar 30 20:47:41 PDT 2015'
   $ltYearOld = strrpos($lsParts[7],":");  #Is there a colon in the date field?  if not, its a year
   if($ltYearOld==False){
      return $lsParts[8];}
   else{
      return $dateParts[5];} 
}

function setLastTimeStamp($lastTimeStamp){
   #$initFile="config.txt";
   $fileHandle = fopen('config.txt','w');
   fwrite($fileHandle,$lastTimeStamp);
   fwrite($fileHandle,"\n");
   fclose($fileHandle);
}
   
function getLastTimeStamp(){
   $fileHandle = fopen('config.txt','r');
   $line = fgets($fileHandle);
   return $line;
   fclose($fileHandle);
}

include("./dblib.inc");
dbconnect();
#start mysql flag experiment
$thisServerIP = '192.168.237';
$ipaddr = '115.230.126.151';
$squery = "SELECT hostCountry,flag FROM hackerHistory WHERE ipaddress = '" . $ipaddr . "'";
$result = mysql_query($squery);
$line = mysql_fetch_row($result);
print $squery; #does query look OK when printed?
print("<BR>" . $line[1] . " "); #print flag filename
print("<IMG SRC = './flags/cn.png'>");
print("<BR>");
print("<IMG SRC = './flags/jp.png' ALT = './flags/zz.png'>");
print("<BR>");
#start SHA1 Logfile Experiment
print("***Sha1 Logfile Experiment****<BR>");
$sha1AuthDotLot = sha1_file("./auth.log");
print($sha1AuthDotLot);
print("<BR>");
#start get time experiment
print("<BR>***PHP Time Experiment****<BR>");
$thisDate=getdate();
print_r($thisDate); #print array
print("<BR>");
print "$thisDate[weekday]";
print("<BR>");
print("*****Date Convert and Compare Test*****<BR>");
#Date Convert and Compare test, global variable
$testDate = "Feb 23 01:09:01";
$lastDate = "Jan 11 11:22:54";
$logYear=getLogYear();
$convertedTestDate = convertDate($testDate);
$convertedLastDate = convertDate($lastDate);
print("Test Date: " . $convertedTestDate);
print("<BR>");
print("LastDate: " . $convertedLastDate);
print("<BR>");
#Date Compare
if($convertedTestDate > $convertedLastDate){
   print("test date after last date<BR>");}
else{
   print("last date after test date<BR>");}
#set-get last timestamp in file
#setLastTimeStamp($convertedLastDate);
#$lastStamp=getLastTimeStamp();
#print($lastStamp);
$hackAddress = '108.23.12.22';
$thisServersIP = "192.168.1.237";
$tableName="ip_108_23_12_22";
print("<A HREF=http://" . $thisServersIP . "/loglook/ipInfo.php?val1=" . $tableName . ">" . $hackAddress . "</A>");
?>