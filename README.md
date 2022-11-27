# TrainAlarm

Project Name： TrainAlarm<br>
Devopement Time：2020年11月～2021年２月<br>
Language：PHP<br>
DB：MySQL（MariaDB)<br>
Utility：jQuery、Bootstrap<br>
Development Environment：PHPStorm

## Overview：<br>
This Project is a train alarm set up application built on top of a Japan-based public Transportation API.<br>
The API can be found at: https://developer-tokyochallenge.odpt.org/en/info<br>

## How to use：<br>
In the configuration screen, four inputs are prompted to the user. The main script will then process the API based on the inputted information, and if no errors are encountered, the alarm will be set and the configuration will be complete.

## Functions：<br>
Registered users will be able to access their usage history and select their favorites. Also, upon login, the system checks if the user has an active alarm, and if so, redirects the user to the alarm screen.
<br>
Users who do not wish to register can still use this application. In that case, you will need to enter your phone number along with the alarm setting information. Then, to return to the alarm screen, select "Confirm Alarm" from the top menu and enter the phone number you used.

## File Overview：<br>

### /access<br>
dbh.access.php・・・Contains the database access information

### /add<br>
footer.add.html・・・Footer used in many files<br>
header.add.php・・・Header used in many files<br>
error_handler.add.php・・・Contains various error/success messages
<br>

### /function<br>
functions.js ・・・It is used in the alarm configuration form in the index.php file.<br>
functions.php・・・Function used by files in the includes directory.

### /includes<br>
Files included in this folder will handle the form requests in the main directory<br>
These files will check input information and interact with the database
alarm.inc.php・・・Including what was mentioned above, this file is also where the API processing takes place<br>

### / Main Directory<br>
Files included the webpage layouts used in building the frontend.

