<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $studentname = $_POST['studentname'];
        $photo = $_FILES["photo"]["name"];
        $cgpa = $_POST['cgpa'];
        move_uploaded_file($_FILES["photo"]["tmp_name"], "studentphoto/" . $_FILES["photo"]["name"]);
        $ret = mysqli_query($bd, "update students set studentName='$studentname',studentPhoto='$photo',cgpa='$cgpa'  where StudentRegno='" . $_SESSION['login'] . "'");
        if ($ret) {
            $_SESSION['msg'] = "Student Record updated Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Student Record not update";
        }
    }
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Student Profile</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="assets/css/font-awesome.css" rel="stylesheet"/>
        <link href="assets/css/style.css" rel="stylesheet"/>
    </head>

    <body>
    <?php include('includes/header.php'); ?>

    <?php if ($_SESSION['login'] != "") {
        include('includes/menubar.php');
    }
    ?>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Student Registration </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading badge bg-warning text-wrap text-uppercase fs-5 font-monospace d-flex justify-content-center">
                            Student Registration
                        </div>
                        <font color="green"
                              align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>
                        <?php $sql = mysqli_query($bd, "select * from students where StudentRegno='" . $_SESSION['login'] . "'");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($sql))
                        { ?>
<!--head card-->
                        <div class="card">
                            <div class="card-body" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;">
                                <form name="dept" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="studentname" class="mt-3 font-monospace fw-bold card-title">Student Name </label>
                                        <input type="text" class="form-control" id="studentname" name="studentname"
                                               value="<?php echo htmlentities($row['studentName']); ?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="studentregno" class="mt-3 font-monospace fw-bold card-title">Student Reg No </label>
                                        <input type="text" class="form-control" id="studentregno" name="studentregno"
                                               value="<?php echo htmlentities($row['StudentRegno']); ?>"
                                               placeholder="Student Reg no" readonly/>

                                    </div>


                                    <div class="form-group">
                                        <label for="Pincode" class="mt-3 font-monospace fw-bold card-title">Pincode </label>
                                        <input type="text" class="form-control" id="Pincode" name="Pincode" readonly
                                               value="<?php echo htmlentities($row['pincode']); ?>" required/>
                                    </div>

                                    <div class="form-group">
                                        <label for="CGPA" class="mt-3 font-monospace fw-bold card-title">CGPA </label>
                                        <input type="text" class="form-control" id="cgpa" name="cgpa"
                                               value="<?php echo htmlentities($row['cgpa']); ?>" required/>
                                    </div>


                                    <div class="form-group">
                                        <label for="Pincode" class="mt-3 font-monospace fw-bold card-title">Student Photo </label>
                                        <?php if ($row['studentPhoto'] == "") { ?>
                                            <img src="studentphoto/noimage.png" width="200" height="200"><?php } else { ?>
                                            <img src="studentphoto/<?php echo htmlentities($row['studentPhoto']); ?>"
                                                 width="200" height="200">
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="Pincode" class="mt-3 font-monospace fw-bold card-title">Upload New Photo </label>
                                        <input type="file" class="form-control" id="photo" name="photo"
                                               value="<?php echo htmlentities($row['studentPhoto']); ?>"/>
                                    </div>


                                    <?php } ?>

                                    <button type="submit" name="submit" id="submit" class="btn btn-warning mt-3" style="border-radius: 15px">Update</button>
                                </form>
                            </div>
                        </div>

<!--                        end card-->
                    </div>
                </div>

            </div>

        </div>


    </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>


    </body>
    </html>
<?php } ?>
