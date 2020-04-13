# Covid-19-HelpDesk

## Present problems: 

* many people are not aware about the risk of infection present in their locality itself 
* there is no self-test or online doctor portal available readily 
* no means to mark the infected persons’ location and show their proximity from you.  

#### This website does the following work

## Installation

Open __Command Prompt/Terminal__ and copy-paste the following command:
```
git clone https://github.com/chandrikadeb7/Covid-19-HelpDesk.git
```
### For using on localserver/ localhost
* Download Files.
* Install Xampp/Wamp or any Apache server.
  * Install [Xampp](https://www.apachefriends.org/download.html)
#### For Xampp:
* After installing. 
* Put all the files in "user\Applications\XAMPP\htdocs\webucator\Covid-19 Helpdesk". 
* Open Xampp Control Panel.
* Start "MySQL Database", "ProFTPD", "Apache Web Server".
* Click on Restart all and the status will show running.
![screenshot 30](https://github.com/chandrikadeb7/Covid-19-HelpDesk/blob/master/Screen%20Shot%202020-04-13%20at%206.02.26%20PM.png)

### For Database:
Kindly have a look at '_html/dbconnect.php_' file
  * Set username = "root" and password = " " on _Phpmyadmin_: "http://localhost/phpmyadmin/"
  * Create Database: __covid-19__ by clicking 'New' option on left side panel.
  * Import the following tables in the database:
    * data/users.sql
    * data/patient.sql
    * html/gps-tracker-master/sql/1a-track.sql
    * html/gps-tracker-master/sql/1b-riders.sql
    
![screenshot 29](https://github.com/chandrikadeb7/Covid-19-HelpDesk/blob/master/Screen%20Shot%202020-04-13%20at%206.15.12%20PM.png)

* Now, open it on browser "http://localhost/webucator/Covid-19%20Helpdesk/html/login.php". 

Best Of Luck! :+1: 

:e-mail: chandrikadeb7@gmail.com
