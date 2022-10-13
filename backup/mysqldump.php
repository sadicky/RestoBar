
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$database = 'db_easy_resto_gros';
$user = 'root';
$pass = '';
$host = 'localhost';
$name_file=date('Y-m-d');
$dir = dirname(__FILE__) . '/'.$name_file.'.sql';
echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
exec("C:\wamp\bin\mysql\mysql5.6.17\bin\mysqldump.exe --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
var_dump($output);
