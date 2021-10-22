<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Send mail test mailhog</title>
</head>
<style>
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
  .container{
    display: block;
    width: 500px;
    margin: 0 auto;
  }
</style>

<body>

  <div class="container">
    <h1>Enter list email.</h1>
    <form action="insert_email.php" method="POST">
      <label for="mail">List email:</label><br>
      <textarea name="mail" id="mail" cols="50" rows="10"></textarea><br>
      <input type="submit" class="btn" name="submit" />
    </form>
  </div>
  <?php

  ?>

</body>


</html>