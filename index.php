<?
  $is_login = false;
  $user_id = '';

  if(isset($_COOKIE["user_id"]) && !empty($_COOKIE["user_id"])) {
    $is_login = true;
    $user_id = $_COOKIE["user_id"];
  } else {

  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>留言板</title>
  <style type="text/css">
    .board__main {
      width: 500px;
      margin: 0 auto;
    }
    .board__form-input > input {
      width: 50%;
    }

    .board__form-textarea > textarea {
      width: 100%;
      height: 200px;
      margin-top: 10px;
    }
    .board__form-submit {
      padding: 10px 40px;
      background: #3597dc;
      color: white;
    }
    .comment {
      padding: 15px;
      border: 1px solid rgba(0, 0, 0, 0.5);
    }
    .comment ~ .comment {
      margin-top: 10px;
    }
    .comment__header {
      border-bottom: 1px solid rgba(0, 0, 0, 0.5);
      padding-bottom: 10px;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
    }
    .board__comments {
      margin-top: 25px;
    }
    .board__subcomments {
      margin-top: 15px;
      padding-left: 20px;
      position: relative;
      left: 10px;
    }
    .board__subcomments .comment {
      border: none;
      padding: 10px;
      background: #f2f7fb;
    }

    .board__subcomments .board__form {
      margin-top: 15px;
    }

    .board__subcomments .board__form-textarea > textarea {
      width: 80%;
      height: 100px;
    }
  </style>
  </head>
  <body>
    <div class='board__main'>
        <?
          if (!$is_login) {
        ?>
          <a href='register.php'>註冊</a>
          <a href='login.php'>登入</a>
        <? } else {
        ?>
          <a href='logout.php'>登出</a>
        <? }
        ?>
        <h1 class='board__title'>
            留言板
        </h1>
        <div class='board__form'>
            <form method='POST' action='add_comment.php'>
                <div class='board__form-textarea'>
                  <textarea name='content' placeholder="留言內容"></textarea>
                </div>
                <input type='hidden' name='parent_id' value='0' />
                <?
                  if ($is_login) {
                    echo "<input class='board__form-submit' type='submit' value='送出' />";
                  } else {
                    echo "<input class='board__form-submit' type='submit' value='請先登入' disabled />";
                  }
                ?>
                
            </form>
        </div>
        <div class='board__comments'>
          <?
            // 顯示所有留言
            require_once('conn.php');
            $sql = "SELECT comments.id, comments.content, comments.created_at, users.nickname FROM comments left join users on comments.user_id = users.id where parent_id = 0 order by created_at DESC";
            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
              require('template_comment.php');
            }
          ?>
        </div>
    </div>
  </body>
</html>