******Mike Wyatt's Lamp-Server Auth.log Analysis Tool********

Not long ago, I put something of a honey-pot SSH server with port 21 open to the internet.  I expected to get several visitors in the first week or so.  What happened surprised the heck out of me.....the log file hit almost 7 megs within the first two days.  This wasn't at a bank, a brokerage house, or a big millitary installation.  This was essentially a hobby server running out of my closet on 24th Street in San Francisco.

I wanted to know how many hits where coming from each IP address, and where the IP addresses were from.  It didn't take long to figure out that I needed some kind of tool to analyze this log...hence the birth of this project.

It's still a work in progress....and pretty rough.

PROJECT SCOPE:




INSTALLATION INSTRUCTIONS:

You will need a basic LAMP server setup.  For my server, I chose Ubuntu 14.04, MySQL 5.5.1, and PHP 5....though in honesty, there isn't alot of rocket science in this project, and any basic LAMP server setup should run it....

(In progress)