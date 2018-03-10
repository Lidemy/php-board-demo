<?
  require_once('conn.php');

  $nickname = $_POST['nickname'];
  $content = $_POST['content'];
  $parent_id = $_POST['parent_id'];
  $user_id = $_COOKIE['user_id'];
  $sql = "INSERT INTO comments (user_id, content, parent_id) VALUES ($user_id, '$content', $parent_id)";
  $conn->query($sql);
  $conn->close();
  header('Location: index.php');
?>