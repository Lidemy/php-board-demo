<?
  require_once('conn.php');

  $error_message = '';

  if (!empty($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users where username='$username' and password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      setcookie("user_id", $row['id'], time()+3600*24);
      header('Location: index.php');
    } else {
      $error_message = '帳號或密碼錯誤';
    }
    $conn->close();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>登入</title>
  <style type="text/css">

  </style>
  </head>
  <body>
    <h2>登入</h2>
    <?
      if ($error_message !== '') {
        echo $error_message;
      }
    ?>
    <form method="POST" action="login.php">
        <div>username: <input name='username' type='text' /></div>
        <br>
        <div>password: <input name='password' type='password' /></div>
        <br>
        <input type='submit' />
    </form>
  </body>
</html>