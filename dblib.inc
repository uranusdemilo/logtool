
<?php

function sidebar()
{
print("<H3 class='sidebar'>Navigation</H3>
   - <A class='sidebar' HREF='index.php'>Home Page</A><BR><BR>
     <H3 class='sidebar'>Company Information</H3>
   - <A HREF='/about.php'><sidebarlink> About Flying Bovine</sidebarlink></A><BR>
   - <A HREF='/contact.php'><sidebarlink>Contact Info</sidebarlink></A>
   <BR>
   <H3 class='sidebar'>Services</H3>
      - <A HREF='./describe.php?service=System Tune Up Services&text=tuneup.txt'>
        <sidebarlink>Tune-Up</sidebarlink></A><BR>
      - <A HREF='./describe.php?service=System Tune Up Services&text=tuneup.txt'>
	<sidebarlink>Troubleshooting</sidebarlink></A><BR>
      - <A HREF='./describe.php?service=System Rebuild Services&text=rebuild.txt'><sidebarlink>Rebuild</sidebarlink></A><BR>
      - <A HREF='./repair.php'><sidebarlink>Repair</sidebarlink></A><BR>- <A HREF='./describe.php?service=System Upgrade Services&text=upgrades.txt'><sidebarlink>Upgrades</sidebarlink></A><BR>
      - <A HREF='./dropin.php'><sidebarlink>Drop-in Replacements</sidebarlink></A><BR>
   <H3 class='sidebar'><A HREF='./forsaleindex.php'>Items For Sale</A></H3>
      - <A HREF='./pcforsale.php'><sidebarlink>PC's For Sale</sidebarlink></A><BR>
      - <A HREF='./hdds.php'><sidebarlink>Hard Drives</sidebarlink></A><BR>
      - <A HREF='./cards.php'><sidebarlink>PC Cards</sidebarlink></A><BR>
      - <A HREF='./ps.php'><sidebarlink>Power Supplies</sidebarlink></A><BR>
      - <A HREF='./mon.php'><sidebarlink>Monitors</sidebarlink></A><BR>
      - <A HREF='./nw.php'><sidebarlink>Networking Stuff</sidebarlink></A><BR><BR>
   <H3 class='sidebar'>Self-Help Links</H3>
      - <FONT SIZE=1><A HREF='./virus/virus.php'>Manual Adware + Virus Removal</A><BR>
      <br><br>
");
}

function imsidebar()
{
echo"<FONT FACE='ARIAL' SIZE=2><DIV ALIGN='CENTER'>
<B><U>Inventory<BR>Management</U></DIV></B><BR>";
echo"- <A HREF='./index.php'><FONT SIZE=1>Home Page</A><BR><BR>";
echo"- <A HREF='./pcim.php'><FONT SIZE=1>PC Management</A><BR><BR>";
echo"<FONT SIZE=2><DIV ALIGN='CENTER'><B><U>System Components</U></DIV></B><BR>";
echo"- <A HREF='./mbim.php'><FONT SIZE=1>Mainboards</A><BR>";
echo"- <A HREF='./hdim.php'><FONT SIZE=1>Hard Drives</A><BR>";
echo"- <A HREF='./memim.php'>Memory</A><BR>";
echo"- <A HREF='./cardim.php'>Cards</A><BR>";
echo"- <A HREF='./nwim.php'>Networking</A><BR>";
echo"- <A HREF='./psim.php'><FONT SIZE=1>Power Supplies</A><BR><BR>";
echo"<FONT SIZE=2><DIV ALIGN='CENTER'><B><U>Items For Sale</U></DIV></B><BR><BR>";
echo"- <FONT SIZE=1><A HREF='./pcforsale.php'>PC's For Sale</A><BR><BR>";
echo"<FONT SIZE=2><DIV ALIGN='CENTER'><B><U>System Categories</U></DIV></B><BR>";
echo"- <A HREF='./impc.php'><FONT SIZE=1>PC's and Servers</A><BR>";
echo"- <A HREF='./mac.php'>Macintosh</A><BR>";
echo"<BR>";
echo"</FONT>";
}

function footer()
{
echo"<BR><DIV ALIGN='CENTER'><FONT SIZE=2>";
echo"<B>Flying Bovine Computing Services</B><BR>";
echo"3770 24th Street, #202<BR>";
echo"San Francisco, CA.<BR>";
echo"94114<BR></DIV>";
}

function dbconnect()
{
$ConnectOK=mysql_connect('localhost','dbagent','patches');
$SelOK=mysql_select_db('hackdb');
}

function session_check($u,$p)
{
$query="select uname,passwd from users where uname='$u' and passwd='$p'";
$result=mysql_query($query);
$loginok=mysql_fetch_row($result);
return($loginok);
}

function dbgetitem($getcol,$havecol,$tablename,$matchcol)
{
$squery="select $getcol from $tablename where $havecol='$matchcol'";
$sptr=mysql_query($squery);
$sdata=mysql_fetch_row($sptr);
return($sdata[0]);
}

function dbmenuwd($colname,$tablename,$formitem,$defaultval)
{
$squery="select $colname from $tablename";
$sdata=mysql_query($squery);
print("<SELECT NAME=\"$formitem\">\n");
while($pdata=mysql_fetch_row($sdata))
{
if($pdata[0]==$defaultval)
   print("<OPTION SELECTED>$pdata[0]\n");
else
   print("<OPTION>$pdata[0]\n");
}
print("</OPTION></SELECT>\n");
}

function dbdmenuwd($colname,$tablename,$formitem,$defaultval)
{
$squery="select distinct $colname from $tablename";
$sdata=mysql_query($squery);
print("<SELECT NAME=\"$formitem\">\n");
while($pdata=mysql_fetch_row($sdata))
{
if($pdata[0]==$defaultval)
   print("<OPTION SELECTED>$pdata[0]\n");
else
   print("<OPTION>$pdata[0]\n");
}
print("</OPTION></SELECT>\n");
}

function textout($ifile)
{
while(!feof($file))
	{
	$lineout=fgets($ifile,255);
	print("$lineout");
	}

}

function getsearchdates()
{
numbermenu(1,12,bmonth);
numbermenu(1,31,bday);
numbermenuwd(2002,2005,2003,byear);
echo" TO ";
numbermenu(1,12,emonth);
numbermenu(1,31,eday);
numbermenuwd(2002,2005,2003,eyear);
}




function datecrunch($month,$day,$year)
{
$uxdate=$year;
$uxdate.='-';
$uxdate.=$month;
$uxdate.='-';
$uxdate.=$day;
return($uxdate);
}

function uxdatecvt($uxdate)
{
$mdy=split("[-]",$uxdate,4);
$date=$mdy[1];
$date.='-';
$date.=$mdy[2];
$date.='-';
$date.=$mdy[0];
return($date);
}

function dbmenu2iwd($colname1,$colname2,$tablename,$formitem,$defaultval)
{
$squery="select $colname1,$colname2 from $tablename";
$sdata=mysql_query($squery);
print("<SELECT NAME=\"$formitem\">\n");
while($pdata=mysql_fetch_row($sdata))
{
if($pdata[0]==$defaultval)
   {
   print("<OPTION SELECTED>$pdata[0]");
   print("-");
   print("$pdata[1]");
   }
else
   {
   print("<OPTION>$pdata[0]");
   print("-");
   print("$pdata[1]\n");
   }
}
print("</OPTION></SELECT>\n");
}


function numbermenu($startval,$endval,$formitem)
{
print("<SELECT NAME=\"$formitem\">\n");
for($i=$startval;$i<=$endval;$i++)print("<OPTION>$i\n");
print("</OPTION></SELECT>\n\n");
}

function numbermenuwd($startval,$endval,$defaultval,$formitem)
{
print("<SELECT NAME=\"$formitem\">\n");
print("<OPTION SELECTED>$defaultval\n");
for($i=$startval;$i<=$endval;$i++)print("<OPTION>$i\n");
print("</OPTION></SELECT>\n\n");
}

?>
