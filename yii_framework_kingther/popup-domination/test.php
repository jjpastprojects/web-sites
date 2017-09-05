<!doctype html>
<html>
  <head>
    <title>PopUp Domination Test Page</title>
    <meta charset="utf-8" />

  </head>
  <body>
<?php 
  if (!empty($_POST))
  {
?>
  Name - <?php echo $_POST['name'] ?><br/>
  Email - <?php echo $_POST['email'] ?>
<?php
  }
?>
  </body>
</html>