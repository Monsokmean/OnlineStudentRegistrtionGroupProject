<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0 or strlen($_SESSION['pcode']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $studentregno = $_POST['studentregno'];
        $pincode = $_POST['Pincode'];
        $session = $_POST['session'];
        $dept = $_POST['department'];
        $level = $_POST['level'];
        $course = $_POST['course'];
        $sem = $_POST['sem'];
        $ret = mysqli_query($bd, "insert into courseenrolls(studentRegno,pincode,session,department,level,course,semester) values('$studentregno','$pincode','$session','$dept','$level','$course','$sem')");
        if ($ret) {
            $_SESSION['msg'] = "Enroll Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Not Enroll";
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
        <title>Course Enroll</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="assets/css/font-awesome.css" rel="stylesheet"/>
        <link href="assets/css/style.css" rel="stylesheet"/>
    </head>

    <body>
    <?php include('includes/header.php'); ?>
    <!-- LOGO HEADER END-->
    <?php if ($_SESSION['login'] != "") {
        include('includes/menubar.php');
    }
    ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Course Enrollment </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading badge bg-primary text-wrap text-uppercase fs-5 font-monospace d-flex justify-content-center">
                            Course Enroll
                        </div>
                        <font color="green"
                              align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>
                        <?php $sql = mysqli_query($bd, "select * from students where StudentRegno='" . $_SESSION['login'] . "'");
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($sql))
                        { ?>
<!--                        card-->
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
                                        <label for="Pincode" class="mt-3 font-monospace fw-bold card-title">Student Photo </label>
                                        <?php if ($row['studentPhoto'] == "") { ?>
                                            <img src="studentphoto/noimage.png" width="200" height="200"><?php } else { ?>
                                            <img src="studentphoto/<?php echo htmlentities($row['studentPhoto']); ?>"
                                                 width="200" height="200">
                                        <?php } ?>
                                    </div>
                                    <?php } ?>

                                    <div class="form-group">
                                        <label for="Session" class="mt-3 font-monospace fw-bold card-title">Session </label>
                                        <select class="form-control" name="session" required="required">
                                            <option value="">Select Session</option>
                                            <?php
                                            $sql = mysqli_query($bd, "select * from session");
                                            while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['session']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="Department" class="mt-3 font-monospace fw-bold card-title">Department </label>
                                        <select class="form-control" name="department" required="required">
                                            <option value="">Select Depertment</option>
                                            <?php
                                            $sql = mysqli_query($bd, "select * from department");
                                            while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['department']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="Level" class="mt-3 font-monospace fw-bold card-title">Level </label>
                                        <select class="form-control" name="level" required="required">
                                            <option value="">Select Level</option>
                                            <?php
                                            $sql = mysqli_query($bd, "select * from level");
                                            while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['level']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Semester" class="mt-3 font-monospace fw-bold card-title">Semester </label>
                                        <select class="form-control" name="sem" required="required">
                                            <option value="">Select Semester</option>
                                            <?php
                                            $sql = mysqli_query($bd, "select * from semester");
                                            while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['semester']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="Course" class="mt-3 font-monospace fw-bold card-title">Course </label>
                                        <select class="form-control" name="course" id="course" onBlur="courseAvailability()"
                                                required="required">
                                            <option value="">Select Course</option>
                                            <?php
                                            $sql = mysqli_query($bd, "select * from course");
                                            while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['courseName']); ?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="course-availability-status1" style="font-size:12px;">
                                    </div>


                                    <button type="submit" name="submit" id="submit" class="btn btn-primary mt-3" style="border-radius: 15px">Enroll</button>
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
    <script>
        function courseAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'cid=' + $("#course").val(),
                type: "POST",
                success: function (data) {
                    $("#course-availability-status1").html(data);
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
