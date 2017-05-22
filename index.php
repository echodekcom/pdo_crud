<?php
  require_once("libs/Db.php");
  $objDb = new Db();
  $db = $objDb->database;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PDO & CRUD</title>
  </head>
  <body>

    <a href="create.php">สร้างสมาชิก</a>

    <div class="">
      <table border="1">
        <thead>
          <tr>
            <th>#</th>
            <th>ชื่อ-นามสกุล</th>
            <th>สถานะ</th>
            <th>Action</th>
          </tr>
        </thead>
          <?php
          $query = $db->prepare("SELECT * FROM member");
          $query->execute();//ประมวลผลคำสั่ง sqlite_fetch_all

          if ($query->rowCount()>0) { #rowCount เช็คจำนวนแถวที่ได้มา
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) { #ดึงข้อมูลมาแต่ละรอบใส่ใน $row
          ?>
        <tbody>
          <tr>
            <td><?=$row['id']?></td>
            <td><?=$row['firstname'].' '.$row['lastname']?></td>
            <td><?=$row['status']?></td>
            <td><a href="view.php?id=<?=$row['id']?>">ดู</a> | <a href="update.php?id=<?=$row['id']?>">แก้ไข</a> | <a href="delete.php?id=<?=$row['id']?> onclick="return confirm('คุณแน่ใจที่จะลบมัน?');">ลบ</a></td>
          </tr>
        </tbody>
        <?php
          } #while
        } # if ?>
      </table>
    </div>

  </body>
</html>
