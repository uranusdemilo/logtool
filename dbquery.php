<html>
<head>
<link rel="stylesheet" type="text/css" href="./fbstyle.css" />
</head>
<?php
$dbcon=mysqli_connect("localhost","dbagent","patches","hackdb");
#variables octet1-3,octet4Start,octet4End,ispName,hostName,hostOrg,hostCountry,hostRegion,hostCity,hostFlag
print("<html>");
print("<table>");
print("<tr><td colspan=2 valign='center'><img src='./images/fbheader.jpg'>");
print("<tr><td VALIGN='TOP' BGCOLOR='#CCCCC' WIDTH=80>");
include("./dblib.inc");
sidebar();
print("<td WIDTH=450 VALIGN='TOP'><B>Main Greeting</B><BR>");
$startVal=(int)$_POST['octet4Start'];
$endVal=(int)$_POST['octet4End'];
$subnet=$_POST['octet1'] . "." . 
        $_POST['octet2'] . "." . 
        $_POST['octet3'] . ".";
for($ad=$startVal;$ad<=$endVal;$ad++){
   $isThereQuery="SELECT ipaddress from hackerHistory where ipaddress = '" . $subnet . $ad . "'";
   $insertQuery="insert into hackerHistory values(" .
      "'" . $subnet . $ad . "'," .
      "'" . $_POST['ispName'] . "'," .
      "'" . $subnet . $ad . "'," .
      "'" . $_POST['hostOrg'] . "'," .
      "'" . $_POST['hostCountry'] . "'," .
      "'" . $_POST['hostRegion'] . "'," .
      "'" . $_POST['hostCity'] . "'," .
      "'" . $_POST['hostFlag'] . "')";
      $updateQuery="update hackerHistory set
          ispName='" . $_POST['ispName'] . "'," .
          "hostOrg='" . $_POST['hostOrg'] . "'," .
          "hostCountry='" . $_POST['hostCountry'] . "'," .
          "hostRegion='" . $_POST['hostRegion'] . "'," .
          "hostCity='" . $_POST['hostCity'] . "'," . 
          "flag='" . $_POST['hostFlag'] . "' where ipaddress = '" . $subnet . $ad . "'";
      $isThereResult=mysqli_query($dbcon,$isThereQuery);
      $isThereRow=mysqli_fetch_row($isThereResult);
   #$dropQuery="delete from hackerHistory where ipaddress = '" .  $subnet . $ad . "'";
   #print($subnet . $ad . ' ');
   if($isThereRow[0]==""){
      print($subnet . $ad . " " . "IP ENTRY NOT FOUND<BR>");
      $enterResult=mysqli_query($dbcon,$insertQuery);
      #print("<BR>");
   }
   else{
      print($subnet . $ad . " " . "IP ENTRY PRESENT<BR>");
      mysqli_query($dbcon,$updateQuery);   
      #$enterResult=mysqli_query($dbcon,$isThereQuery); 
   }
   #print($updateQuery);
   #print("<BR>");
}
print("<br><br></font><tr><td colspan=2>");
footer();
echo'</table>';
?>
<html/>
