<html>
<head>
<link rel="stylesheet" type="text/css" href="./fbstyle.css" />
</head>
<?php
print("<HTML>");
print("<TABLE>");
print("<TR><TD COLSPAN=2 VALIGN='CENTER'><IMG SRC='./images/fbheader.jpg'>");
print("<TR><TD VALIGN='TOP' BGCOLOR='#CCCCC' WIDTH=80>");
include("./dblib.inc");
sidebar();
print("<TD WIDTH=450 VALIGN='TOP'><B>Main Greeting</B><BR>");
print("<form action = './dbquery.php' method='POST'>");
print("<table>");
print("<tr><td>Subnet<td>");
print("<input type='text' size='3' name='octet1'>" . '.' . 
      "<input type = 'text' size='3' name='octet2'>" . '.' .
      "<input type = 'text' size='3' name='octet3'>" . '.' .
      "X");
print("<TR><TD>Start <TD><input type = 'text' size='3' name='octet4Start'>");
print("<TR><TD>End <TD><input type = 'text' size='3' name='octet4End'>");
print("</TABLE>");;
print("<table>
   <tr><td>ISP Name <td><input type = 'text' size='50' name='ispName'>
   <tr><td>Host Org <td><input type = 'text' size='50' name='hostOrg'>
   <tr><td>Host Country <td><input type = 'text' size='50' name='hostCountry'>
   <tr><td>Host Region <td><input type = 'text' size='50' name='hostRegion'>
   <tr><td>Host City <td><input type = 'text' size='50' name='hostCity'>
   <tr><td>Host Flag <td><input type = 'text' size='10' name='hostFlag'>");
print("</table>");
print("<input type='submit' value='Submit Batch'>");
print("</form>");
print("</TABLE>");
print("<BR><BR></FONT><TR><TD COLSPAN=2>");
footer();
echo'</TABLE>';
?>
</HTML>
