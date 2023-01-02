<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Admin | Student Password</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <style>
        /* CSS */
        .changepassword_button {
            color: #fff;
            padding: 15px 25px;
            border-radius: 100px;
            background-color: #4C43CD;
            background-image: radial-gradient(93% 87% at 87% 89%, rgba(0, 0, 0, 0.23) 0%, transparent 86.18%), radial-gradient(66% 87% at 26% 20%, rgba(255, 255, 255, 0.41) 0%, rgba(255, 255, 255, 0) 69.79%, rgba(255, 255, 255, 0) 100%);
            box-shadow: 2px 19px 31px rgba(0, 0, 0, 0.2);
            font-weight: bold;
            font-size: 16px;

            border: 0;

            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;

            cursor: pointer;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        .my-navdar {
            overflow: hidden;
            background-color: #333;
        }
        .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 10px 10px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: red;
            border-radius: 15px;
        }
    </style>
</head>
<nav class='navbar navbar-expand-lg navbar-dark bg-dark my-navdar'>
    <div class='container-fluid'>
        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target = '#navbarSupportedContent' aria-controls ='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                <li class='nav-item'>
                    <a class='nav-link active' aria-current= 'page' href='pincode-verification.php'>Enroll for Course </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' aria-current= 'page' href='enroll-history.php'>Enroll History  </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' aria-current= 'page' href='my-profile.php'>My Profile  </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' aria-current= 'page' href='my-profile.php'>My Profile  </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' aria-current= 'page' href='change-password.php'>Change Password </a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' aria-current= 'page' href='logout.php'>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>