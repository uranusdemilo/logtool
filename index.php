<html>
<head>;
<link rel="stylesheet" type="text/css" href="./fbstyle.css" />
</head>
<?php

##To fix: picking up "PDT" in last date function.  Change explode paramenters.

function createTableName($ipAddr){
   $tableName = str_replace(".","_",$ipAddr);
   $tableName = "ip_" . $tableName;
   return $tableName;
}

function createIP($tableName){
   $address = substr($tableName,3,15);
   $address = str_replace("_",".",$address);
   return $address;
}

function dropAll(){
   $dropListResult = mysql_query("SHOW TABLES");
   while($dropListLine=mysql_fetch_row($dropListResult)){
      if(($dropListLine[0]!='foundHackers') && ($dropListLine[0]!='hackerHistory')){
         $noResult=mysql_query("DROP TABLE " . $dropListLine[0]);
      }
   }
   mysql_query("delete from foundHackers");         
}

function hackerHistoryEntry($ipaddr){
   exec('python web.py ' . $ipaddr,$parts); 
   $hackHistoryEntryQuery = "insert into hackerHistory values('" . $ipaddr . "','" . 
      $parts[0] .   "','"  . $parts[1] . "','" . 
      $parts[2] . "','" . $parts[3] . "','" . 
      $parts[4] . "','" . $parts[5] . "','" . 
      $parts[6] . "')";
   mysql_query($hackHistoryEntryQuery);
   #0 - IPAddress ,#1 - ISP, #2 - Hostname, #3 - Organization, $4 = Country, #5 - Region, #6 - City
}

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
      $dateParts = explode(' ',$dateLine[0],7); # want 5 from 'Mon Mar 30 20:47:41 PDT 2015'
      $ltYearOld = strrpos($lsParts[8],":");  #Is there a colon in the date field?  if not, its a year
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

function compareTimeStamps($lastStamp,$testStamp){
   if($testStamp > $lastStamp){$newRecord=True;}
   else{$newRecord=False;}
   return $newRecord;
}   

include("./dblib.inc");
dbconnect();
print("<table>");
print("<TR><TD COLSPAN=2 VALIGN='CENTER'><IMG SRC='./images/fbheader.jpg'>");
print("<TR><TD VALIGN='TOP' BGCOLOR='#CCCCC' WIDTH=80>");
#dropAll();
sidebar();
$logYear=getLogYear();
$lastTimeStamp=getLastTimeStamp();
$initFile="./init.ini";
$logFileName = "./auth.log";
$sha1AuthDotLog = sha1_file($logFileName);
$fileHandle = fopen($logFileName, "r");
print("<td WIDTH=450 VALIGN='TOP'><fronthead>Recent Hackers Visiting 66.125.83.237</fronthead><br><br>");
print("<paratext>");
if($fileHandle){
    while (($line = fgets($fileHandle)) !== false) {
      $parts = explode(' ',$line,6); //0-2 Date,3-server,4 daemon, 5 description
      $hackDate = $parts[0].' '.$parts[1].' '.$parts[2];
      $hackProcess = $parts[4];
      $hackDescription = $parts[5];
      $ipRegEx = "/\b(?:[0-9]{1,3}\.){3}[0-9]{1,3}\b/";
      if (preg_match($ipRegEx,$line,$ipMatch)) {
         $hackAddress = $ipMatch[0];
         $foundYetQuery = 'SELECT hackerIP from foundHackers where hackerIP = \'' . $hackAddress . '\'';
         $tableExistsResult = mysql_query($foundYetQuery);
         $tableExistsRow = mysql_fetch_row($tableExistsResult);
         if(($tableExistsRow[0] == "") && ($hackAddress != "0.0.0.0") && ($hackAddress != '192.168.1.156')){
            $tableName = createTableName($hackAddress); #create a tablename of ip_xxx.xxx.xxx.xxx
            $newHackerEntry = "INSERT INTO foundHackers values('" . $hackAddress . "')";
            $newTableQuery="CREATE TABLE " . $tableName . "(hackDate varchar(15),hackProcess varchar(11),hackDescription varchar(150))";
            $newHackEntry="INSERT INTO " . $tableName . " VALUES('" . $hackDate . "','" . $hackProcess . "','" . $hackDescription ."')";
            $noResult = mysql_query($newHackerEntry);
            $noResult = mysql_query($newTableQuery);
            $noResult = mysql_query($newHackEntry);
            $checkHistoryResult = mysql_query("SELECT ipAddress from hackerHistory where ipAddress = '" . $hackAddress . "'");
            $checkHistoryLine = mysql_fetch_row($checkHistoryResult);
            if($checkHistoryLine == ''){
               hackerHistoryEntry($hackAddress);
               }
            }
         elseif($hackAddress != "0.0.0.0"){
            $testTimeStamp=convertDate($hackDate);
            $isEntryNew=compareTimeStamps($lastTimeStamp,$testTimeStamp);
            if($isEntryNew==True){
               $tableName = createTableName($hackAddress);
               $newHackEntry="INSERT INTO " . $tableName . " VALUES('" . $hackDate . "','" . $hackProcess . "','" . $hackDescription ."')"; 
               $noResult = mysql_query($newHackEntry);
            }
         }   
      }
   }
   if($testTimeStamp>$lastTimeStamp){
      setLastTimeStamp($testTimeStamp);}
   fclose($fileHandle);
   }    
else {
    print("Cant Open File");
}
$hackerListResult=mysql_query("SELECT hackerIP from foundHackers");
$hackerListLine = 'preload';
print("<TABLE>");
print("<TR><TD WIDTH='140'><parahead>Hacker IP Address<TD WIDTH='60'><parahead>Attacks<TD WIDTH='150'><parahead>Origin");
while($hackerListLine=mysql_fetch_row($hackerListResult)){   
   $tableName=createTableName($hackerListLine[0]);
   $ipaddr = createIP($tableName);
   $flagAndCountryQuery = "SELECT hostCountry,flag FROM hackerHistory WHERE ipaddress = '" . $ipaddr . "'";
   $flagAndCountryResult = mysql_query($flagAndCountryQuery);
   $flagAndCountryLine = mysql_fetch_row($flagAndCountryResult); 
   $hacksPerHackerQuery="SELECT COUNT(*) FROM " . $tableName;
   $hacksPerHackerResult=mysql_query("SELECT COUNT(*) FROM " . $tableName);
   $hacksPerHackerLine=mysql_fetch_row($hacksPerHackerResult);
   print("<TR><TD><paratext>");
   #print("<A HREF=http://192.168.1.237/logtool/ipInfo.php?tableName=" . $tableName 
   #   . "&flagFile=" . $flagAndCountryLine[1] 
   #   . ">" . $ipaddr . "</A>");
   print("<a href=\"javascript:void(window.open('./ipInfo.php?ip=" . $ipaddr . "','','width=600,height=350'))\"> $ipaddr </a>");
   print("<TD><paratext>");
   #print($hacksPerHackerLine[0]);
   print("<A HREF=http://192.168.1.237/logtool/ipList.php?tableName=" . $tableName 
      . "&flagFile=" . $flagAndCountryLine[1] 
      . ">" .$hacksPerHackerLine[0] . "</A>");
   print("<TD><IMG SRC = './flags/" . $flagAndCountryLine[1] . "'> ");
   print("<paratext>" . $flagAndCountryLine[0]);
   print("</paratext><BR>");
}
print"</paratext></TABLE>";
#dropAll();
footer();
?>
</HTML>
