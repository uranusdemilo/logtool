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
print("<BR><BR></FONT><TR><TD COLSPAN=3>");
footer();
echo'</TABLE>';
?>
</HTML>
