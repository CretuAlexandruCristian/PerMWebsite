<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION['is_admin'] != 1) {
    header("location: /../PerM/frontend/login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <link rel="shortcut icon" type="image/x-icon" href="/../PerM/frontend/favicon.ico"/>
    <link rel="stylesheet" href="/../PerM/frontend/css/utilities.css"/>
    <link rel="stylesheet" href="/../PerM/frontend/css/style.css"/>
    <title>PerM | Admin</title>
</head>
<body>
<header>
    <!-- Navbar -->
    <nav class="navbar" id="admin-navbar">
        <div class="content">
            <div class="logo">
                <img src="/../PerM/frontend/images/logo-render.png" alt="logo"
                />
            </div>
            <ul class="menu-list">
                <li>
                    <div class="icon cancel-btn">
                        <i class="fas fa-times"></i>
                    </div>
                </li>

                <li>
                    <div class="dropdown" data-dropdown>
                        <button class="link">
                            <i class="fa-solid fa-user fa-2x" data-dropdown-button></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="/../PerM/backend/PermBackEnd/logout.php" class="menu-button"
                               id="profile">Profile</a>
                        
                            <a href="/../PerM/backend/PermBackEnd/logout.php" class="menu-button"
                               id="logout">Log&nbsp;Out</a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="dropdown" data-dropdown>
                        <button class="link">
                            <i
                                    class="fa-solid fa-circle-info fa-2x"
                                    data-dropdown-button
                            ></i>
                        </button>
                        <div class="dropdown-menu" id="about">
                            <a href="/../PerM/frontend/about.html" class="menu-button" id="about-us"
                            >About Us</a
                            >
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown" data-dropdown>
                        <button class="link">
                            <i class="fas fa-comment-dots fa-2x" data-dropdown-button></i>
                        </button>
                        <div class="dropdown-menu" id="contact">
                            <a href="/../PerM/frontend/contact.html" class="menu-button" id="contact-us"
                            >Contact Us</a
                            >
                        </div>
                    </div>
                </li>
            </ul>
            <div class="icon menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
</header>

<div class="admin-container">
    <div class="review-heading">
        <h1>ADMIN PAGE</h1>
    </div>

    <form action="generate.php" method="post">
        <Label for="pdf">Generate reports on perfumes</Label><br>
        <input type="submit" name="pdf" value="GENERATE PDF">
    </form>

</div>
<div class="table-admin">
<h2>Most Sold By Category(Family)</h2>
<table id="admin-data">
  <thead><tr>
    <th>Family</th>
    <th>Sold</th>
    <th>Price</th>
  </tr>
  </thead>
  <tbody id="category-data">
  
  </tbody>
</table>

<h2>Stock Situation</h2>
<table id="admin-data">
  <thead><tr>
    <th>Brand</th>
    <th>Perfume Name</th>
    <th>Stock</th>
  </tr>
  </thead>
  <tbody id="stocks-data">
 
  </tbody>
</table>


<h2>Sold In The Last 30 Days</h2>
<table id="admin-data">
  <thead><tr>
    <th>Orders</th>
    <th>Revenue</th>
    
  </tr>
  </thead>
  <tbody id="last30-data">
 
  </tbody>
</table>

<h3>Get JSON Data</h3>
<button onclick="window.location.href='http://localhost/PerM/backend/PermBackEnd/index.php/product/getSoldLast30Days';">Last 30 Days</button>
<button onclick="window.location.href='http://localhost/PerM/backend/PermBackEnd/index.php/product/getStocks';">Stock Situation</button>
<button onclick="window.location.href='http://localhost/PerM/backend/PermBackEnd/index.php/product/getMostSold';">Sold By Category</button>

</div>


</body>
<script src="/../PerM/frontend/app.js"></script>
<script>
    document.getElementById('profile').style.display='contents';
   document.getElementById('logout').style.display='contents';
    // Sold By Category 
   fetch('http://localhost/PerM/backend/PermBackEnd/index.php/product/getMostSold')
   .then((res)=>res.json())
   .then((data) => {
    let output='';
    data.forEach(function(products){
       output+='<tr>'+
    '<td>'+ products.family +'</td>'+
    '<td>'+ products.sold +'</td>'+
    '<td>'+ products.price +'</td>'+
  '</tr>';
    });
    document.getElementById('category-data').innerHTML=output;
   })

   fetch('http://localhost/PerM/backend/PermBackEnd/index.php/product/getStocks')
   .then((res)=>res.json())
   .then((data) => {
    let output='';
    data.forEach(function(products){
       output+='<tr>'+
    '<td>'+ products.brand +'</td>'+
    '<td>'+ products.perfume_name +'</td>'+
    '<td>'+ products.stock +'</td>'+
  '</tr>';
    });
    document.getElementById('stocks-data').innerHTML=output;
   })


   fetch('http://localhost/PerM/backend/PermBackEnd/index.php/product/getSoldLast30Days')
   .then((res)=>res.json())
   .then((data) => {
    let output='';
    data.forEach(function(products){
       output+='<tr>'+
    '<td>'+ products.Orders +'</td>'+
    '<td>'+ products.Revenue +'</td>'+
  '</tr>';
    console.log(data);
    console.log(output);
});
    document.getElementById('last30-data').innerHTML=output;
   })
   
</script>


</html>