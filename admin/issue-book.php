<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else { 

    if(isset($_POST['issue'])) {
        $studentid = strtoupper($_POST['studentid']);
        $bookid = $_POST['bookdetails'];

        try {
            $dbh->beginTransaction();

            $sql = "INSERT INTO tblissuedbookdetails(StudentID, BookId) VALUES(:studentid, :bookid)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
            $query->bindParam(':bookid', $bookid, PDO::PARAM_INT);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            // Execute this query to decrement the BookCount by one
            $sql = "UPDATE tblbooks SET BookCount = BookCount - 1 WHERE BookId = :bookId";
            $query = $dbh->prepare($sql);
            $query->bindParam(':bookId', $bookid, PDO::PARAM_INT);
            $query->execute();

            $dbh->commit();

            if($lastInsertId) {
                $_SESSION['msg'] = "Book issued successfully";
                header('location: manage-issued-books.php');
            } else {
                $_SESSION['error'] = "Something went wrong. Please try again";
                header('location: manage-issued-books.php');
            }
        } catch (PDOException $e) {
            $dbh->rollBack();
            $_SESSION['error'] = "Database error: " . $e->getMessage();
            header('location: manage-issued-books.php');
        }
    }

    // Fetch all books for dropdown
    $sql = "SELECT BookId, BookName, ISBNNumber FROM tblbooks WHERE BookCount > 0";
    $query = $dbh->prepare($sql);
    $query->execute();
    $books = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Issue a new Book</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // function for getting student name
        function getStudent() {
            $("#loaderIcon").show();
            $.ajax({
                url: "get_student.php",
                data: 'studentid=' + $("#studentid").val(),
                type: "POST",
                success: function (data) {
                    $("#get_student_name").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
            });
        }

        // Function to update ISBN when book is selected
        function updateISBN() {
            var selectElement = document.getElementById("bookdetails");
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var isbn = selectedOption.getAttribute("data-isbn");
            document.getElementById("bookisbn").value = isbn || "";
        }
    </script>
    <style type="text/css">
        .others {
            color: red;
        }
    </style>
</head>
<body>
    <!-- MENU SECTION START -->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END -->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Issue a New Book</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Issue a New Book
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Student ID<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="studentid" id="studentid" onBlur="getStudent()" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <span id="get_student_name" style="font-size:16px;"></span> 
                                </div>
                                <div class="form-group">
                                    <label>Select Book <span style="color:red;">*</span></label>
                                    <select class="form-control" name="bookdetails" id="bookdetails" onChange="updateISBN()" required="required">
                                        <option value="">Select Book</option>
                                        <?php 
                                        if($query->rowCount() > 0) {
                                            foreach($books as $book) {
                                                echo "<option value='".$book->BookId."' data-isbn='".$book->ISBNNumber."'>".$book->BookName."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ISBN Number</label>
                                    <input class="form-control" type="text" name="bookisbn" id="bookisbn" readonly />
                                </div>
                                <button type="submit" name="issue" id="submit" class="btn btn-info">Issue Book</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END -->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END -->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME -->
    <!-- CORE JQUERY -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>