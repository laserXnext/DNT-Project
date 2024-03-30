<?php
session_start();
include 'db_config.php';
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) 
{
        die("Connection failed: " . $conn->connect_error);
}

$name = mysqli_real_escape_string($conn, $_GET['title']);
$sql="SELECT * FROM tools WHERE category LIKE '%$name%'";
$result= mysqli_query($conn,$sql);
$queryResult= mysqli_num_rows($result);
$conn->close();
?>
<html>
        <head>
            <meta charset='utf-8'>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Tool Rental</title>
            <link rel="stylesheet" type="text/css" href="CSS/toolpage.css">
            <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="uicons-regular-rounded/css/uicons-regular-rounded.css" rel="stylesheet">
            <link href="uicons-brands/css/uicons-brands.css" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css2?family=Lilita+One&family=Madimi+One&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
            <script src="Js/nav bar.js" defer></script>
            <style>
                body
                {
                background-image: url("background/2.png");
                }
                .text-3
                {
                    font-size: 35px;
                    font-weight: 500;
                    color: #18191b;
                    font-family:sans-serif;
                    font-style: normal;
                    text-align: center;
                    padding: 10px 0;
                }
            </style>
        </head>
<body>
        <nav class="nav">
                <i class="uil uil-bars navOpenBtn"></i>
                <a href="#" class="nav-logo"><img src="logo/DNT C LOGO low.png"></a>
                <ul class="nav-links">
                    <i class="uil uil-times navCloseBtn"></i>
                    <li><a href="#" class="nav-item">Home</a></li>
                    <li><a href="#" class="nav-item">Projects</a></li>
                    <li><a href="toolrental.php" class="nav-item" id="nav-tool">Tools</a></li>
                    <li><a href="#" class="nav-item">Carrier</a></li>
                    <li><a href="#" class="nav-item">Quotation</a></li>
                    <li><a href="#" class="nav-item">About Us</a></li>
                    <li><a href="#" class="nav-item">Contact Us</a></li>
                </ul>
    
                <i class="uil uil-search search-icon" id="searchIcon"></i>
                <div class="search-box">
                    <i class="uil uil-search search-icon"></i>
                    <input type="text" placeholder="Search here..." />
                </div>
        </nav>
            <div class="main-text">
                <?php
                echo 
                "<
                    <h1 class='text-1' >".$sql."</h1>
                    <p class='text-2'>Find the right tool for your project</p>
                ";
                ?>
            </div>
        <section class="tools">
                <div>
                <?php
                    if($queryResult > 0)
                    {
                        while($tools = mysqli_fetch_assoc($result))
                        {
                            $available=($tools['availability'] == 1) ? 'Available' : 'Unavailable';
                            echo 
                            "<div class='tool-ex'>
                                <img src=".$tools['timg']." class='toolimg-ex'>
                                <div class='details'>
                                    <p class='tool-name'>".$tools['toolname']."- <a class='more-data'>".$available."</a></p>
                                    <p class='tool-desc'>".$tools['description']."</p>
                                    <div class='pricing'>
                                        <ul class='time-list'>
                                            <li>Day</li>
                                            <li>Week</li>
                                            <li>Month</li>
                                        </ul>
                                        <ul class='price-list'>
                                            <li>Rs.".$tools['price-d']."</li>
                                            <li>Rs.".$tools['price-w']."</li>
                                            <li>Rs.".$tools['price-m']."</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>";
                        }
                    }
                    else
                    {
                        echo "<p class='text-3'>Sorry! We couldnot find anything related</p>";
                    }     
                ?>
                </div>
        </section>
        <footer class="footer">
            <div>
                <a href="#" class="footer-logo"><img src="logo/DNT C LOGO low.png"></a>
                <p class="footer-text">
                    DNT Construction (Pvt) Ltd is a remarkably leading Construction Company in Sri Lanka that serves 
                    the economical infrastructure sector in the country as well as a leading and innovative construction company 
                    in the tourism sector in Maldives and Male. 
                    The company accesses the core requirements of the clients through the expertise they have gathered over the years.
                </p>
            </div>
            <div>
                <ul class="socialmedia-list">
                    <li><i class="fi-brands-facebook facebook"></i></i></li>
                    <li><i class="uil uil-linkedin linkedin"></i></i></li>
                    <li><i class="fi-brands-whatsapp whatsapp"></i></li>
                </ul>
            </div>
            <div>
                <h3 class="service-tag">OUR SERVICES</h3>
                <ul class="service-list">
                    <li>Construction</li>
                    <li>Interior Designing</li>
                    <li>Tool Rental</li>
                    <li>Project Management</li>
                </ul>
                <p class="footer-bottom">All right reserved by DNT Construction</p>
            </div>
        </footer>
</body>
</html>