# PHP MYSQLDUMP Backup Script
## Send your backup to telegram directly

------

In order to backup please set the following as per your setup
Please remember the maximum file size for Telegram SendDocument is **50MB**


```php
$databasedumplocation = "/root/db.sql";
$databaseuser = "user";
$databasepassword = "password";
$database = "database1";
$tbot_token = "bot32872398743"; //Remember to add 'bot'
$tbot_receiver = "00000000"; //Remember this is the chat_id not username
```

------
