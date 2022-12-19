<?php
session_start();
include("includes/config.php");
date_default_timezone_set('Asia/Phnom_Penh');// change according timezone
$currentTime = date('d-m-Y h:i:s A');
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    if ($_POST['password'] === $_POST['cpassword']) {
        $sql = mysqli_query($bd, "INSERT INTO admin(username,password,creationDate) VALUES('$username','$password','$currentTime')");
        $_SESSION['msg'] = "Admin Created Successfully !!";

        $query = mysqli_query($bd, "SELECT * FROM admin WHERE username='$username' and password='$password'");
        $num = mysqli_fetch_array($query);
        if ($num > 0) {
            $extra = "index.php";
            $_SESSION['alogin'] = $_POST['username'];
            $_SESSION['id'] = $num['id'];
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("location:http://$host$uri/$extra");
            //=> http://localhost:63342/Online%20Course%20Registration/admin/change-password.php
            //$host = localhost:63342
            //$uri = /Online%20Course%20Registration/admin
            //$extra = "change-password.php";
            exit();
        } else {
            $_SESSION['errmsg'] = "Invalid username or password";
            $extra = "index.php";
            $host = $_SERVER['HTTP_HOST'];
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("location:http://$host$uri/$extra");
            exit();
        }
    } else {
        $_SESSION['errmsg'] = "Password and Confirm Password not match !!";
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

    <title>Admin Creation</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../assets/css/font-awesome.css" rel="stylesheet"/>
    <link href="../assets/css/style.css" rel="stylesheet"/>
</head>
<script type="text/javascript">
    function valid() {
        if (document.admin.cpass.value == "") {
            alert("Current Password Filed is Empty !!");
            document.chngpwd.cpass.focus();
            return false;
        } else if (document.admin.newpass.value == "") {
            alert("New Password Filed is Empty !!");
            document.chngpwd.newpass.focus();
            return false;
        } else if (document.admin.cnfpass.value == "") {
            alert("Confirm Password Filed is Empty !!");
            document.chngpwd.cnfpass.focus();
            return false;
        } else if (document.admin.newpass.value != document.chngpwd.cnfpass.value) {
            alert("Password and Confirm Password Field do not match  !!");
            document.chngpwd.cnfpass.focus();
            return false;
        }
        return true;
    }
</script>

<body>
<?php include('includes/header.php'); ?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Please Create Your Admin Account</h4>

            </div>

        </div>
        <span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ""); ?></span>
        <div class="card center-block" style="width: 50rem;">
            <div class="card-body">
                <form name="admin" method="post" onsubmit ="return valid();">
                    <label>Enter Username : </label>
                    <input type="text" name="username" class="form-control" name  = "cpass" required/>
                    <label>Enter Password : </label>
                    <input type="password" name="password" class="form-control" name="newpass" required/>
                    <label>Enter Confirm Password : </label>
                    <input type="password" name="cpassword" class="form-control" name="cnfpass" required/>
                    <hr/>
                    <button type="submit" name="submit" class="btn btn-info"><span
                                class="glyphicon glyphicon-user"></span> &nbsp;Create
                    </button>&nbsp;
                </form>

            </div>
            <div class="text-center mt-2">
                <p>Already have an account? <a href="index.php"> Login here</a></p>
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
