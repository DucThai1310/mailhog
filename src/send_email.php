<?php
// information email
$subject_mail = "test mail";
$message_mail = "I'm a student Computer engineering major - Faculty of
       electronic and telecommunication engineering in University Of
       science and Technology- the University of Danang. Although I
       am a final year student majoring in electronics and
       telecommunications, with a passion for programming, I have a
       direction to develop my future career and become a front end
       programmer.Besides trying to self-study and to have a solid and
       professional background, I chose to study front end
       programming course at iViettech and now I am confident with
       the knowledge I have equipped and ready for the position of
       front end programmer!";
//send mail to list email in database when click button Send email
include("function.php");
$table_name = "table_mail";
getenv('DATABASE_HOST') ? $db_host = getenv('DATABASE_HOST') : $db_host = "mysql";
getenv('DATABASE_POST') ? $db_port = getenv('DATABASE_POST') : $db_port = "3306";
getenv('MYSQL_USER') ? $db_user = getenv('MYSQL_USER') : $db_user = "root";
getenv('MYSQL_PASSWORD') ? $db_pass = getenv('MYSQL_PASSWORD') : $db_pass = "root";
getenv('MYSQL_DATABASE') ? $db_name = getenv('MYSQL_DATABASE') : $db_name = "db_table";

$conn =  new mysqli("$db_host:$db_port", $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error)
  die("Connection failed: " . $conn->connect_error);

// check table in database. if not in db, create table
$result = $conn->query("select * from $table_name;");
while ($row = $result->fetch_assoc()) {

  send_mail($row["email"], $subject_mail, $message_mail);
}
header("location:send_success.php");
$result->free_result();
$conn->close();
