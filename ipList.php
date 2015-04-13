<html>
<head>;
<link rel="stylesheet" type="text/css" href="./fbstyle.css" />
</head>
<?php
function createIP($tableName){
   $address = substr($tableName,3,15);
   $address = str_replace("_",".",$address);
   return $address;
}

print("<HTML>");
print("<TABLE>");
print("<TR><TD COLSPAN=2 VALIGN='CENTER'><IMG SRC='./images/fbheader.jpg'>");
print("<TR><TD VALIGN='TOP' BGCOLOR='#CCCCC' WIDTH=80>");
include("./dblib.inc");
sidebar();
dbconnect();
$tableName = str_replace("'","",$_GET['tableName']);
$flagFile = str_replace("'","",$_GET['flagFile']);
$ipaddr=createIP($tableName);
print("<TD WIDTH=600 VALIGN='TOP'><fronthead>Auth.log entries from " 
   . $ipaddr . "</fronthead> " . "<IMG SRC=./flags/" 
   . $flagFile . "><BR><BR>\n");
$hacksQuery="select * from " . $tableName;
$hacksResult=mysql_query($hacksQuery);
$line = 'preload';
print("<TABLE>\n");
print("<TR><TD WIDTH='100'><parahead>Date & Time<TD WIDTH='85'><parahead>Port/Process<TD><parahead>Error Description");
while($line){
   $line=mysql_fetch_row($hacksResult);
   print("<TR><TD><paratext>" . $line[0]
      . "<TD><paratext>" . $line[1] 
      . "<TD><paratext>" . $line[2] 
      . "</paratext><BR>");
}
print("<BR><BR></FONT><TR><TD COLSPAN=3>");
footer();
echo'</TABLE>';
?>
</HTML>
