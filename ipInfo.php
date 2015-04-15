<HTML>
<TABLE>
<TR><TD COLSPAN=2 VALIGN='CENTER'><IMG SRC='./images/shortHeader.jpg'>
<?php
$ipAddr = str_replace("'","",$_GET['ip']);
$dbcon=mysqli_connect("localhost","dbagent","patches","hackdb");
$hackerInfoQuery="SELECT * from hackerHistory where ipaddress = '" . $ipAddr . "'";
$result=mysqli_query($dbcon,$hackerInfoQuery);
$row=mysqli_fetch_row($result);
print("<TR><TD>IP Address<TD>" . $ipAddr);
print("<TR><TD>ISP Name:<TD>" . $row[1]);
print("<TR><TD>Host Name:<TD>" . $row[2]);
print("<TR><TD>Host Orgainzation:<TD>" . $row[3]);
print("<TR><TD>Host Country:<TD>" . $row[4]);
print("<TR><TD>Host Region:<TD>" . $row[5]);
print("<TR><TD>Host City:<TD>" . $row[6]);
#print("<BR><BR></FONT><TR><TD COLSPAN=2>");
echo'</TABLE>';
?>
</HTML>