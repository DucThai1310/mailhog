<?php
function send_mail($to, $sub, $msg)
{
  $result = FALSE;
  $header = "From: testmailhog@gmail.com";

  $result = mail($to, $sub, $msg, $header);
  return $result;
}

function send_mail_list($list_mail, $sub, $msg)
{
  foreach ($list_mail as $mail) {
    $result = send_mail($mail, $sub, $msg);
    sleep(2);
    echo $result;
  }
}
function tableExists($pdo, $table)
{
  try {
    $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
  } catch (Exception $e) {

    return FALSE;
  }

  return $result !== FALSE;
}
function create_table($pdo, $table)
{
  $sql = "CREATE TABLE $table (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
  if ($pdo->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
  } else {
    echo "Error creating table: " . $pdo->error;
  }
}
function insert_mail_sql($pdo, $mail, $table)
{
  $sql = "INSERT INTO $table(email) VALUES($mail)";
}

function get_mail_list($pdo, $table)
{
  $sql = "SELECT mail FROM $table";
  try {
    $result = $pdo->query($sql);
  } catch (Exception $e) {

    return [];
  }
  return $result;
}
function clear_table($pdo, $table)
{
  $sql = "DELETE FROM $table;";
  try {
    $result = $pdo->query($sql);
  } catch (Exception $e) {

    return FALSE;
  }
  return $result !== FALSE;
}
