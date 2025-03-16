<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['add']))
{
    // Initialize an errors array
    $errors = array();
    
    // Validate book name (not empty and proper length)
    $bookname = trim($_POST['bookname']);
    if(empty($bookname)) {
        $errors[] = "Book name cannot be empty";
    } elseif(strlen($bookname) > 255) {
        $errors[] = "Book name is too long (maximum 255 characters)";
    }
    
    // Validate category and author selection
    $category = $_POST['category'];
    if(empty($category)) {
        $errors[] = "Please select a category";
    }
    
    $author = $_POST['author'];
    if(empty($author)) {
        $errors[] = "Please select an author";
    }
    
    // Validate ISBN (not empty, numeric, and unique)
    $isbn = trim($_POST['isbn']);
    if(empty($isbn)) {
        $errors[] = "ISBN cannot be empty";
    } elseif(!is_numeric(str_replace('-', '', $isbn))) {
        $errors[] = "ISBN must contain only numbers and hyphens";
    } else {
        // Check if ISBN already exists
        $check_sql = "SELECT ISBNNumber FROM tblbooks WHERE ISBNNumber = :isbn";
        $check_query = $dbh->prepare($check_sql);
        $check_query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $check_query->execute();
        if($check_query->rowCount() > 0) {
            $errors[] = "This ISBN already exists in the database";
        }
    }
    
    // Validate book count (must be a positive integer)
    $bookCount = trim($_POST['bookCount']);
    if(empty($bookCount)) {
        $errors[] = "Book count cannot be empty";
    } elseif(!is_numeric($bookCount) || $bookCount <= 0 || floor($bookCount) != $bookCount) {
        $errors[] = "Book count must be a positive integer";
    }
    
    // If no errors, proceed with insertion
    if(empty($errors)) {
        try {
            $sql="INSERT INTO tblbooks(BookName,CatId,AuthorId,ISBNNumber,BookCount) VALUES(:bookname,:category,:author,:isbn,:bookCount)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
            $query->bindParam(':category',$category,PDO::PARAM_INT); // Ensure category is an integer
            $query->bindParam(':author',$author,PDO::PARAM_INT); // Ensure author is an integer
            $query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
            $query->bindParam(':bookCount',$bookCount,PDO::PARAM_INT);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            
            if($lastInsertId) {
                $_SESSION['msg']="Book Listed successfully";
                header('location:manage-books.php');
                exit();
            } else {
                $errors[] = "Book could not be added. Please try again.";
            }
        } catch(PDOException $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Add Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add Book</h4>
            </div>
        </div>

<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<!-- Display validation errors if any -->
<?php if(isset($errors) && !empty($errors)): ?>
<div class="alert alert-danger">
    <strong>Error!</strong>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?php echo htmlentities($error); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="panel panel-info">
<div class="panel-heading">
Book Info
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Book Name<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="bookname" autocomplete="off" value="<?php echo isset($_POST['bookname']) ? htmlentities($_POST['bookname']) : ''; ?>" required />
</div>

<div class="form-group">
<label> Category<span style="color:red;">*</span></label>
<select class="form-control" name="category" required="required">
<option value=""> Select Category</option>
<?php 
$status=1;
$sql = "SELECT * from tblcategory where Status=:status";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{
    $selected = (isset($_POST['category']) && $_POST['category'] == $result->CatId) ? 'selected' : '';
?>  
<option value="<?php echo htmlentities($result->CatId);?>" <?php echo $selected; ?>><?php echo htmlentities($result->CategoryName);?></option>
 <?php }} ?> 
</select>
</div>


<div class="form-group">
<label> Author<span style="color:red;">*</span></label>
<select class="form-control" name="author" required="required">
<option value=""> Select Author</option>
<?php 
$sql = "SELECT * from tblauthors";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{
    $selected = (isset($_POST['author']) && $_POST['author'] == $result->AuthorId) ? 'selected' : '';
?>  
<option value="<?php echo htmlentities($result->AuthorId);?>" <?php echo $selected; ?>><?php echo htmlentities($result->AuthorName);?></option>
 <?php }} ?> 
</select>
</div>

<div class="form-group">
<label>ISBN Number<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="isbn" required="required" autocomplete="off" value="<?php echo isset($_POST['isbn']) ? htmlentities($_POST['isbn']) : ''; ?>" />
<p class="help-block">ISBN Must be unique</p>
</div>
<div class="form-group">
<label>Book Count<span style="color:red;">*</span></label>
<input class="form-control" type="number" name="bookCount" min="1" step="1" autocomplete="off" required="required" value="<?php echo isset($_POST['bookCount']) ? htmlentities($_POST['bookCount']) : '1'; ?>" />
<p class="help-block">Number of copies available</p>
</div>
<button type="submit" name="add" class="btn btn-info">Add </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>