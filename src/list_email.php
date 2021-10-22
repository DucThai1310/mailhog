<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

    main {
      width: 60%;
      margin: 0 auto;
    }

    .top-table {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .top-table div {
      display: flex;
    }

    .btn {
      text-decoration: none;
      text-transform: uppercase;
      color: white;
      background-color: #4d4de1f2;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      font-weight: 500;
    }

    form+form {
      margin-left: 10px;
    }

    .btn-send {
      background-color: orange;
    }

    .btn-delete {
      background-color: #f73131;
    }
  </style>
</head>

<body>
  <main>
    <div class='top-table'>
      <h1>Show list email</h1>
      <div>
        <form action='index.php' method='post'>
          <button class='btn btn-add' name='add_mail'>add email</button>
        </form>
        <form method='post' action='send_email.php'>
          <button class='btn btn-send' name='send_mail'>Send email</button>
        </form>
        <form method='post'>
          <button class='btn btn-delete' name='delete_data'>Clear</button>
        </form>

      </div>
    </div>
    <?php

    include("function.php");
    $table_name = "table_mail";
   

    getenv('DATABASE_HOST') ? $db_host = getenv('DATABASE_HOST') : $db_host = "mysql";
    getenv('DATABASE_POST') ? $db_port = getenv('DATABASE_POST') : $db_port = "3306";
    getenv('MYSQL_USER') ? $db_user = getenv('MYSQL_USER') : $db_user = "root";
    getenv('MYSQL_PASSWORD') ? $db_pass = getenv('MYSQL_PASSWORD') : $db_pass = "root";
    getenv('MYSQL_DATABASE') ? $db_name = getenv('MYSQL_DATABASE') : $db_name = "db_table";

    //connect mysql
    $conn =  new mysqli("$db_host:$db_port", $db_user, $db_pass, $db_name);
    // Check connection
    if ($conn->connect_error)
      die("Connection failed: " . $conn->connect_error);
    //clear list mail in database
    if (isset($_POST['delete_data'])) {
      clear_table($conn, $table_name);
    }
    // get list mail form database and show in table
    if (!($result = $conn->query("select * from $table_name;")))
      printf("Error: %s\n", mysqli_error($conn));
    if ($result->num_rows > 0) {
      // output data of each row
      echo "<table>
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Added at</th>
        </tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr> <td>" . $row["id"] . " </td><td>" . $row["email"] . " </td><td>" . $row["reg_date"] . "</td></tr> ";
      }
      echo "</table>";
    } else {
      echo "0 results";
    }
    $result->free_result();
    $conn->close();
    ?>
  </main>
</body>

</html>