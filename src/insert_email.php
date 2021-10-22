<?php
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
if (!tableExists($conn, $table_name)) {
  create_table($conn, $table_name);
}
// get input in textarea 
$mail_string = trim(addslashes($_POST['mail']));


if ($mail_string !== "") {
  // split email
  $list_mail = explode("\n", $mail_string);
  $sql = "";
  // make query db
  foreach ($list_mail as $email) {
    $sql .= "INSERT INTO $table_name (email) VALUES('$email'); ";
  }
  //insert into table
  if ($conn->multi_query($sql) === TRUE) {
    header("location:list_email.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $result->free_result();
  $conn->close();
}
