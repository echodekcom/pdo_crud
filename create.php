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

      $query = $db->prepare("INSERT INTO member (id, firstname, lastname, status) VALUES (NULL,:firstname, :lastname, :status);");
      $result = $query->execute(["firstname" => $_POST['firstname']
                                ,"lastname" => $_POST['lastname']
                                ,"status" => $_POST['status'],]);

      if($result){
        echo "Successfully";
      }else{
        echo "Save fail!";
      }
    }
    ?>


    <form method="post">
      <label>First Name</label><input type="text" name="firstname" value=""><br />
      <label>Last</label><input type="text" name="lastname" value=""><br />

      <label>Status</label><select name="status">
          <option value="1">Active</option>
          <option value="2">Ban</option>
      </select>
      <br />
      <input type="submit" name="submit" value="submit">
    </form>
  </body>
</html>
