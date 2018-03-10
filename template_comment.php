<div class='comment'>
    <div class='comment__header'>
        <div class='comment__author'><? echo $row['nickname'] ?></div>
        <div class='comment__timestamp'><? echo $row['created_at'] ?></div>
    </div>
    <div class='comment__content'>
        <? echo $row['content'] ?>
    </div>
    <div class='board__subcomments'>
    <?
      $parent_id = $row['id'];
      $sql_child = "SELECT comments.*, users.nickname FROM comments left join users on users.id = comments.user_id where parent_id = $parent_id order by created_at DESC";

      $result_child = $conn->query($sql_child);

      while($sub_comment = $result_child->fetch_assoc()) {
        include('template_subcomment.php');
      }
    ?>
      <div class='board__form'>
          <form method="POST" action="add_comment.php">
              <div class='board__form-textarea'>
                <textarea name='content' placeholder="留言內容"></textarea>
              </div>
              <input name='parent_id' type='hidden' value='<? echo $row['id'] ?>' />
              <?
                  if ($is_login) {
                    echo "<input class='board__form-submit' type='submit' value='送出' />";
                  } else {
                    echo "<input class='board__form-submit' type='submit' value='請先登入' disabled />";
                  }
                ?>
          </form>
      </div>
    </div>
</div>