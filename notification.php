<?php include 'header.php' ?>

<form action="pagingnotificationsP2.php?page=0" method="post">
  Filter IdTutore:
  <input type="number" name="numar" min="0" max="10000" value="0">
  <input type="submit" onClick="location.href='notification.php'" name="Ok" value="Ok">
</form>
<?php include 'pagingnotificationsP.php' ?>
<?php include 'footer.php' ?>