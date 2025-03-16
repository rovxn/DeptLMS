<?php 
require_once("includes/config.php");
if(!empty($_POST["bookid"])) {
  $bookid = $_POST["bookid"];
 
  $sql = "SELECT BookName, BookId FROM tblbooks WHERE ISBNNumber = :bookid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0) {
    foreach ($results as $result) { ?>
      <option value="<?php echo htmlentities($result->BookId); ?>"><?php echo htmlentities($result->BookName); ?></option>
      <b>Book Name :</b> 
      <?php echo htmlentities($result->BookName); ?>
      <script>$('#submit').prop('disabled', false);</script>
    <?php }
  } else { ?>
    <option class="others">Invalid ISBN Number</option>
    <script>$('#submit').prop('disabled', true);</script>
  <?php }
}
?>