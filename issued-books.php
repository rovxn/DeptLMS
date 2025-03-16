<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Manage Issued Books</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                    <h4 class="header-line">Manage Issued Books</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Issued Books
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>ISBN</th>
                                            <th>Issued Date</th>
                                            <th>Due Date</th>
                                            <th>Fine</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sid = $_SESSION['stdid'];
                                        echo "<script>console.log('Student ID: " . $sid . "');</script>"; // Debugging line

                                        $sql1 = "SELECT id FROM tblissuedbookdetails WHERE StudentID = :sid";
                                        $query1 = $dbh->prepare($sql1);
                                        $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
                                        $query1->execute();
                                        $issuedBookIds = $query1->fetchAll(PDO::FETCH_OBJ);

                                        if ($query1->rowCount() > 0) {
                                            $cnt = 1;
                                            foreach ($issuedBookIds as $issuedBookId) {
                                                $sql2 = "SELECT tblbooks.BookName, tblbooks.ISBNNumber, tblissuedbookdetails.IssueDate FROM tblissuedbookdetails JOIN tblbooks ON tblbooks.BookId = tblissuedbookdetails.BookId WHERE tblissuedbookdetails.id = :issuedBookId";
                                                $query2 = $dbh->prepare($sql2);
                                                $query2->bindParam(':issuedBookId', $issuedBookId->id, PDO::PARAM_STR);
                                                $query2->execute();
                                                $result = $query2->fetch(PDO::FETCH_OBJ);

                                                if ($result) {
                                                    $issueDate = new DateTime($result->IssueDate);
                                                    $dueDate = $issueDate->add(new DateInterval('P8D'))->format('Y-m-d');
                                                    $finePerDay = 1; // Rs. 1 per day
                                                    $fine = null;
                                                    // Calculate fine if the book is not returned on time
                                                    // Assuming $returnDate is fetched from the database
                                                    $returnDate = $result->ReturnDate ?? null;
                                                    if ($returnDate != "") {
                                                        $diff = strtotime($returnDate) - strtotime($dueDate);
                                                        $diffDays = floor($diff / (60 * 60 * 24));
                                                        $fine = max(0, $diffDays * $finePerDay);
                                                    }
                                        ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->BookName); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->IssueDate); ?></td>
                                                        <td class="center"><?php echo htmlentities($dueDate); ?></td>
                                                        <td class="center">
                                                            <?php
                                                            if ($fine !== null) {
                                                                echo "&#8377; " . htmlentities($fine);
                                                            } else {
                                                                echo "-";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                        <?php
                                                    $cnt = $cnt + 1;
                                                } else {
                                                    echo "<script>console.log('No result found for issuedBookId: " . $issuedBookId->id . "');</script>"; // Debugging line
                                                }
                                            }
                                        } else {
                                            echo "<script>console.log('No issued books found for Student ID: " . $sid . "');</script>"; // Debugging line
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>