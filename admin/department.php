<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $department = $_POST['department'];
        $ret = mysqli_query($bd, "insert into department(department) values('$department')");
        if ($ret) {
            $_SESSION['msg'] = "Department Created Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Department not created";
        }
    }
    if (isset($_GET['del'])) {
        mysqli_query($bd, "delete from department where id = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Department deleted !!";
    }
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <title>Admin | department</title>
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
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Department </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading badge bg-success text-wrap text-uppercase fs-5 font-monospace d-flex justify-content-center ">
                            Department
                        </div>
                        <font color="green"
                              align="center"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></font>

                        <div class="card">
                            <div class="card-body">
                                <form name="dept" method="post">
                                    <div class="form-group">
                                        <label for="department" class="mt-3 font-monospace fw-bold card-title">Add Department </label>
                                        <input type="text" class="form-control" id="department" name="department"
                                               placeholder="department" required/>
                                    </div>
                                    <button type="submit" name="submit" class="btn bg-info mt-3">Add Department</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <font color="red"
                  align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading badge bg-success text-wrap text-uppercase fs-5 font-monospace d-flex justify-content-center mt-5">
                        Manage Department
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive table-bordered">
                            <table class="table table-dark table-striped"">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>department</th>
                                    <th>Creation Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = mysqli_query($bd, "select * from department");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($sql)) {
                                    ?>


                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo htmlentities($row['department']); ?></td>
                                        <td><?php echo htmlentities($row['creationDate']); ?></td>
                                        <td>
                                            <a href="department.php?id=<?php echo $row['id'] ?>&del=delete"
                                               onClick="return confirm('Are you sure you want to delete?')">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                } ?>


                                </tbody>
                            </table>
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
    </body>
    </html>
<?php } ?>
