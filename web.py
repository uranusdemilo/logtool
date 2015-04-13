import sys
import urllib
from HTMLParser import HTMLParser

class Mstripper(HTMLParser):
    def __init__(self):
        self.reset()
        self.fed = []
    def handle_data(self, d):
        self.fed.append(d)
    def get_data(self):
        return ''.join(self.fed)

def strip_tags(html):
    s = Mstripper()
    s.feed(html)
    return s.get_data()
      
baseurl = 'http://www.abuseipdb.com/check/'
ipaddr = str(sys.argv[1])
pageurl = baseurl + ipaddr
siteSource = urllib.urlopen(pageurl)
ip_line = 'preload'
ipLine = 'preload'
regionFound = False;
flagFound = False;
while ipLine:
   ipLine = siteSource.readline()
   if "ISP:" in ipLine:
      ipLine = siteSource.readline()
      taggedISP = strip_tags(ipLine.strip())
      taggedISP = taggedISP.replace("'","-")
   elif "Host Name:" in ipLine:
      ipLine = siteSource.readline()
      taggedHostName = strip_tags(ipLine.strip())
   elif "Organization:" in ipLine:
      ipLine = siteSource.readline()
      taggedOrganization = strip_tags(ipLine.strip())
      taggedOrganization = taggedOrganization.replace("'","-")
   elif "Country:" in ipLine:
      ipLine = siteSource.readline()
      countryParts = ipLine.split('=',3)
      taggedCountry = strip_tags(ipLine.strip())
      if("img src=" in ipLine):
         flagPart = countryParts[1].replace("\"/i/flags/","")
         taggedFlag = flagPart.replace("\" style","")
      else:
         taggedFlag = "zz.png";
   elif "Region" in ipLine:
      ipLine = siteSource.readline()
      taggedRegion = strip_tags(ipLine.strip())
      taggedRegion = taggedRegion.replace("'","-")
      regionFound = True
   elif "City:" in ipLine:
      ipLine = siteSource.readline()
      taggedCity = strip_tags(ipLine.strip())
      taggedCity = taggedCity.replace("'","-")
   else:
      continue

print taggedISP
print taggedHostName
print taggedOrganization
print taggedCountry
if(regionFound == True):
   print taggedRegion 
else:
   print "N/A"
print taggedCity
print taggedFlag
#print ""



