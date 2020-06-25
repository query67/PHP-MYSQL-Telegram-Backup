<?php
/** 

REMEMBER THIS ONLY WORKS IF YOUR DATABASE BACKUP IS BELOW 50MB 

Simple Telegram MYSQL Database Backup Script 
Replace the following variables according to your preference 

$databasedumplocation = eg /root/db.sql
$databaseuser = eg root
$databasepassword = eg 30223jefjf
$database = eg database1
$tbot_token = eg bot3284393uyfeufse
$tbot_receiver = eg 98273298732 (this has to be the chat ID and not the username)

After the backup has been sent the file will be deleted from the server, comment out the last line if you do not want this 

Created by github.com/rushilshah14
**/


//Set these as per your server/database/telegram
$databasedumplocation = "INSERTHERE";
$databaseuser = "INSERTHERE";
$databasepassword = "INSERTHERE";
$database = "INSERTHERE";
$tbot_token = "INSERTHERE";
$tbot_receiver = "INSERTHERE";

//Execute the dump and gzip it
exec("mysqldump -u".$databaseuser." -p".$databasepassword." ".$database." | gzip > ".$databasedumplocation."");

//Curl the file to the API
$file = $databasedumplocation;
$fileup = new CURLFile($file);

$target_url = "https://api.telegram.org/".$tbot_token."/sendDocument";
$data = array(
    "chat_id" => $tbot_receiver,
    "document" => $fileup
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$target_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);


//Delete the file after sending it
exec(unlink($databasedumplocation));


?>