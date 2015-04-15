
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
$ConnectOK=mysqli_connect("localhost","dbagent","patches","hackdb");
}
?>
