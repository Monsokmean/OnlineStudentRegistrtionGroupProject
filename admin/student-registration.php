<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $studentname = $_POST['studentname'];
        $studentregno = $_POST['studentregno'];
        $password = md5($_POST['password']);
        $pincode = rand(100000, 999999);
        $ret = mysqli_query($bd, "insert into students(studentName,StudentRegno,password,pincode) values('$studentname','$studentregno','$password','$pincode')");
        if ($ret) {
            $_SESSION['msg'] = "Student Registered Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Student  not Register";
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
        <title>Admin | Student Registration</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="assets/css/font-awesome.css" rel="stylesheet"/>
        <link href="assets/css/style.css" rel="stylesheet"/>
    </head>

    <body>
    <?php include('includes/header.php'); ?>

    <?php if ($_SESSION['alogin'] != "") {
        include('includes/menubar.php');
    }
    ?>

    <div class="content-wrapper">
        <div class="container">
                <div class="col-md-12">
                    <h1 class="page-head-line">Student Registration </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading badge bg-dark text-wrap text-uppercase fs-5 font-monospace d-flex justify-content-center">
                            Student Registration
                        </div>
                        <font color="green"
                              align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>

                        <div class="card">
                            <div class="card-body">
                                <form name="dept" method="post">
                                    <div class="form-group mb-3">
                                        <label for="studentname"  class="form-label fw-bold">Student Name </label>
                                        <input type="text" class="form-control" id="studentname" name="studentname"
                                               placeholder="Student Name" required/>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="studentregno" class="form-label fw-bold">Student Reg No </label>
                                        <input type="text" class="form-control" id="studentregno" name="studentregno"
                                               onBlur="userAvailability()" placeholder="Student Reg no" required/>
                                        <span id="user-availability-status1" style="font-size:12px;">
                                    </div>


                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label fw-bold">Password </label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Enter password" required/>
                                    </div>

                                    <button type="submit" name="submit" id="submit" class="btn btn-outline-danger">Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>


    </div>
    </div>
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
        function userAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'regno=' + $("#studentregno").val(),
                type: "POST",
                success: function (data) {
                    $("#user-availability-status1").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () {
                }
            });
        }
    </script>


    </body>
    </html>
<?php } ?>
