<?php
require_once ("db.php");
$db = new MyDB();
session_start();
if (!isset($_SESSION['log_name']) || !isset($_SESSION['log_id']))
{
    echo "<script>alert('Please Login or Sign up')</script>";
    header("Location: index.php");
}

$id = $_SESSION['log_id'];

$ssql = <<<EFO
SELECT * FROM User WHERE ID = $id;
EFO;

$sret = $db->query($ssql);

while ($srow = $sret->fetchArray(SQLITE3_ASSOC)) {
$userid = $srow['ID'];
$userimg = $srow['image'];


?>
<!DOCTYPE html>
<html xmlns:https="http://www.w3.org/1999/xhtml">
<head>
    <title>E-Xport | Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen">

    <link rel="stylesheet" href="fonts/font-awesome.css">

    <script src="js/popup.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-3.1.0.js"></script>
    <script type="text/javascript" src="js/msg.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/cycle2.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        function searchq() {
            var searchTxt = $("input[name='cat_search']").val();

            $.post("instant_search.php", {searchVal: searchTxt}, function (echo) {
                $('.cat_questions').html(echo);
            });
        }
    </script>
</head>
<body style="background: #f8f8f8">
<div class="padding">
    <div class="head_col">
        <div class="header">
            <div class="notify_icon">
            </div>
            <div class="request_icon">
            </div>
            <div class="msgn_icon">
            </div>
            <div class="chats_icon">
            </div>
            <div class="contact_support">
                <p>Contact Support</p>
            </div>
            <div class="user_account">
                <div class="user_prof_image">
                    <?php echo "<img src='$userimg'>";?>
                </div>
                <div class="user_prof_func"><p><?php echo $_SESSION['log_name'];?></p></div>
            </div>
        </div>
        <div class="user_prof_menu">
            <ul>
                <li>
                    <?php

                    echo "<a href='useraccount.php?ID=$userid'>My Account</a>";


                    }
                    ?>
                </li>
                <li>
                    <form action="logout.php" method="post" enctype="multipart/form-data">
                        <input type="submit" name="logout" id="logout" value="Logout">
                    </form>
                </li>
            </ul>
        </div>
        <div class="divider"></div>
        <div class="header_menu">
            <form action="searchall.php" method="post" enctype="multipart/form-data">
                <input type="submit" name="search" id="submit_search" value="">
                <input type="search" name="search" id="search" placeholder="Ask your question">
            </form>
            <div class="main_nav">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="get_questions.php?category_id=5">CATEGORIES</a></li>
                    <li><a href="news.php">NEWS</a></li>
                    <li><a href="programs.php">PROGRAMS</a></li>
                    <li><a href="#">POTENTIALS</a></li>
                    <li class="active"><a href="#">LOANS</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="loan_content">

<?php

$sql =<<<EOF
SELECT * FROM loaners;
EOF;

$ret = $db->prepare($sql);
$ret = $db->query($sql);

while ($row = $ret->fetchArray(SQLITE3_ASSOC))
{
    $loaner_name = $row['loaner_name'];
    $loaner_des = $row['loaner_des'];
    $loaner_req = $row['loaner_req'];
    $loaner_logo = $row['loaner_logo'];

    echo "<div class='loaner_info_area_2'>
            <div class='loaner_info'>
                <div class='loaner_logo'><img src='$loaner_logo' id='loan_logo_prev'></div>
                <div class='loaner_name'><p>$loaner_name</p></div>
                <div class='loaner_brief'><p>$loaner_des</p></div>
            </div>
            <div class='loaner_requirements'>
                <div class='loaner_verified'><img src='images/verified.png'><p>Verified</p></div>
                <div class='loaner_req_btn'><img src='images/require.png'><p>More Info</p></div>
            </div>
            <div class='req_details'><p>$loaner_req</p></div>
        </div>";
}
?>

</div>
<div class="laon_news"><br><br><br><br><br><br><br><br><br></div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.loaner_requirements').click(function () {
            $(this).next().slideToggle();
        });
    });
</script>
</body>
</html>
