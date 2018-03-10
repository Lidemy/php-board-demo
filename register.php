<?
  require_once('conn.php');

  if (!empty($_POST['username'])) {
    $nickname = $_POST['nickname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO users (username, password, nickname) VALUES ('$username', '$password', '$nickname')";
    $result = $conn->query($sql);

    if ($result) {
      $last_id = $conn->insert_id;
      setcookie("user_id", $last_id, time()+3600*24);
    }

    $conn->close();
    header('Location: index.php');
  }
  

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>註冊</title>
  <style type="text/css">

  </style>
  </head>
  <body>
    <h2>註冊</h2>
    <form method="POST" action="register.php">
        <div>username: <input name='username' type='text' /></div>
        <br>
        <div>password: <input name='password' type='password' /></div>
        <br>
        <div>nickname: <input name='nickname' type='text' /></div>
        <input type='submit' />
    </form>
  </body>
</html>