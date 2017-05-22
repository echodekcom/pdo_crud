<?php
  require_once("libs/Db.php");
  $objDb = new Db();
  $db = $objDb->database;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Create Member</title>
  </head>
  <body>
    <?php
    if (isset($_POST['submit'])) {

      $query = $db->prepare("UPDATE member SET id=:id,firstname=:firstname,lastname=:lastname,status=:status WHERE id = :id");
      $result = $query->execute([
                                 "id" => $_GET['id']
                                ,"firstname" => $_POST['firstname']
                                ,"lastname" => $_POST['lastname']
                                ,"status" => $_POST['status'],]);

      if($result){
        echo "Successfully";
      }else{
        echo "Save fail!";
      }
    }
    ?>

    <?php

    $query = $db->prepare("SELECT * FROM member WHERE id = :id");
    $query->execute([ "id" => $_GET['id'],]);
    if($query->rowCount() > 0){
      $row = $query->fetch(PDO::FETCH_ASSOC);
      echo "Your name = ".$row['firstname']."<br/>";
     ?>

    <form method="post">
      <label>First Name</label><input type="text" name="firstname" value="<?=$row['firstname']?>"><br />
      <label>Last</label><input type="text" name="lastname" value="<?=$row['lastname']?>"><br />

      <label>Status</label><select name="status">
          <option value="1" <?=($row['status']==1)?'selected':''?>>Active</option>
          <option value="2" <?=($row['status']==2)?'selected':''?>>Ban</option>
      </select>
      <br />
      <input type="submit" name="submit" value="submit">
    </form>
    <?php
      }else{
        echo "Record not found.";
      }
    ?>
  </body>
</html>
