<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>ຮ້ານເຝີຕົ້ນຕານ</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icon -->
    <link rel="icon" href="images/fevicon.png" type="image/png" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="style.css" />
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- color css -->
    <link rel="stylesheet" href="css/colors.css" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body class="dashboard dashboard_1">
    <?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }

    $username = $_SESSION['username'];

    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "tontarn";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



    ?>
    <div class="full_container">
        <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar_blog_1">
                    <div class="sidebar-header">
                        <div class="logo_section">

                        </div>
                    </div>
                    <div class="sidebar_user_info">
                        <div class="icon_setting"></div>
                        <div class="user_profle_side">

                            <div class="user_info ">
                                <h6>ຜູ້ໃຊ້ງານ : <span class="orange_color"><?php echo htmlspecialchars($username); ?></span></h6>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidebar_blog_2">

                    <ul class="list-unstyled components">

                        <li><a href="admin_index.php"><i class=" fa fa-home  orange_color"></i> <span>ໜ້າຫຼັກ</span></a>
                        </li>
                        <li><a href="food.php"><i class=" fa fa-cutlery blue2_color"></i><span>ລາຍການອາຫານ</span></a></li>
                        <li><a href="food_list.php"><i class="fa fa-pencil-square-o purple_color2"></i> <span>ຄີບິນ</span></a></li>
                        <li><a href="order_report.php"><i class="fa fa-bar-chart-o green_color"></i>
                                <span>ຈັດການໃບບິນ</span></a></li>
                        <li><a href="sales_report.php"><i class="fa fa-line-chart blue1_color"></i>
                                <span>ລາຍງານຍອດຂາຍ</span></a></li>
                        <li>

                            <a href="employee.php"><i class="fa fa-users yellow_color"></i> <span>ຜູ້ໃຊ້ງານ</span></a>

                        </li>
                    
                     
                        <li><a href="logout.php"><i class="fa fa-sign-out red_color"></i>
                                <span>ອອກຈາກລະບົບ</span></a></li>
                    </ul>
                </div>
            </nav>
            <!-- end sidebar -->
            <div id="content">
                <!-- topbar -->
                <div class="topbar">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="full">
                            <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i
                                    class="fa fa-bars p-2"></i></button>
                            <div class="logo_section">
                                <h2 class="p-4" style="color: white;">ຮ້ານເຝີຕົ້ນຕານ</h2>
                            </div>
                        </div>
                    </nav>
                </div>
                <!-- end topbar -->




                <!-- jQuery -->
                <script src="js/jquery.min.js"></script>
                <script src="js/popper.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
                <!-- wow animation -->
                <script src="js/animate.js"></script>
                <!-- select country -->
                <script src="js/bootstrap-select.js"></script>
                <!-- owl carousel -->
                <script src="js/owl.carousel.js"></script>
                <!-- chart js -->
                <script src="js/Chart.min.js"></script>
                <script src="js/Chart.bundle.min.js"></script>
                <script src="js/utils.js"></script>
                <script src="js/analyser.js"></script>
                <!-- nice scrollbar -->
                <script src="js/perfect-scrollbar.min.js"></script>
                <script>
                    var ps = new PerfectScrollbar('#sidebar');
                </script>
                <!-- custom js -->
                <script src="js/custom.js"></script>
                <script src="js/chart_custom_style1.js"></script>