<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $logat = 0;
    $user_id = 0;
} else {
    $logat = 1;
    $user_id = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    <link rel="stylesheet" href="css/utilities.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <title>Products | PerM</title>
    <!-- <style>
      body {
        background-color: #f7f7f7;
      }
    </style> -->
</head>
<body>
<nav class="navbar" id="prod-list-navbar">
    <div class="content">
        <div class="logo">
            <a href="index.php"
            ><img src="./images/logo-render.png" alt="logo"
                /></a>
        </div>
        <div class="search">

            <input id="searchProduct" type="text"
                   placeholder=" Search Perfumes By Brand, Name..."
                   name="search">


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
                        <a href="login.html" class="menu-button" id="login">Login</a>
                        <a href="register.html" id="register" class="menu-button"
                        >Register</a
                        >
                        <a href="/../PerM/backend/PermBackEnd/profile.php" class="menu-button"
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
                                class="fa-solid fa-cart-shopping fa-2x"
                                data-dropdown-button
                        ></i>
                    </button>
                    <div class="dropdown-menu" id="cart">
                        <a
                                href="/../PerM/backend/PermBackEnd/shopping-cart.php"
                                class="menu-button"
                                id="cart-link"
                        >My Cart</a
                        >
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
                        <a href="about.html" class="menu-button" id="about-us"
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
                        <a href="contact.html" class="menu-button" id="contact-us"
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
<div class="container">

    <div class="products-page">
        <div class="filter">
            <form>

                <h4>Brand</h4>
                <div class="filter-group">
                    <input type="checkbox" id="Armani" name="brand" value="Armani">
                    <label for="Armani">Armani</label>
                </div>

                <div class="filter-group">
                    <input type="checkbox" id="HUGO.BOSS" name="brand" value="HUGO.BOSS">
                    <label for="HUGO.BOSS"> HUGO BOSS</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Chanel" name="brand" value="Chanel">
                    <label for="Chanel">Chanel</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Dior" name="brand" value="Dior">
                    <label for="Dior">Dior</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Lancome" name="brand" value="Lancome">
                    <label for="Lancome">Lancome</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Marc.Jacobs" name="brand" value="Marc.Jacobs">
                    <label for="Marc.Jacobs">Marc Jacobs</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Mugler" name="brand" value="Mugler">
                    <label for="Mugler">Mugler</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Paco.Rabanne" name="brand" value="Paco.Rabanne">
                    <label for="Paco.Rabanne">Paco Rabanne</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Tiffany" name="brand" value="Tiffany">
                    <label for="Tiffany">Tiffany</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Tom.Ford" name="brand" value="Tom.Ford">
                    <label for="Tom.Ford">Tom Ford</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Yves.Saint.Laurent" name="brand" value="Yves.Saint.Laurent">
                    <label for="Yves.Saint.Laurent">Yves Saint Laurent</label>
                </div>
                <div class="linie"></div>

                <h4>Gender</h4>
                <div class="filter-group">
                    <input type="checkbox" id="Male" name="gender" value="Male">
                    <label for="Male"> Male</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Female" name="gender" value="Female">
                    <label for="Female">Female</label>
                </div>
                <div class="linie"></div>

                <h4>Capacity</h4>
                <div class="filter-group">
                    <input type="checkbox" id="30" name="capacity" value="30">
                    <label for="30"> 30ML</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="50" name="capacity" value="50">
                    <label for="50">50ML</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="60" name="capacity" value="60">
                    <label for="60"> 60ML</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="100" name="capacity" value="100">
                    <label for="100"> 100ML</label>
                </div>
                <div class="linie"></div>

                <h4>Season</h4>
                <div class="filter-group">
                    <input type="checkbox" id="Winter" name="season" value="Winter">
                    <label for="Winter"> Winter</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Spring" name="season" value="Spring">
                    <label for="Spring">Spring</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Summer" name="season" value="Summer">
                    <label for="Summer">Summer</label>
                </div>
                <div class="filter-group">
                    <input type="checkbox" id="Autumn" name="season" value="Autumn">
                    <label for="Autumn">Autumn</label>
                </div>


                <input id="filter-submit" type="submit" value="Apply">
            </form>
        </div>
        <div>
            <h1 id="searchresult"></h1>
            <div class="products" id="product">

            </div>
            <!-- <div class="product-card">
              <div class="product-image">
                <span class="discount-tag">25% off</span>
                <img src="images/scent.png" class="product-thumb" alt="" />
                <button class="card-btn">View Product</button>
              </div>
              <div class="product-info">
                <h2 class="product-brand">HUGO BOSS</h2>
                <p class="product-short-description">The Scent</p>
                <p class="product-short-description">Eau de Toilette - 100ML</p>
                <span class="price">$75</span><span class="actual-price">$100</span>
              </div>
            </div> -->
        </div>
    </div>
</div>
<!-- <script>
  var xhr = new XMLHttpRequest();
  var url='http://localhost/PermBackEnd/index.php/product/list';
  xhr.open('GET','http://localhost/PermBackEnd/index.php/product/list');

  xhr.onload=function() {
    var products=JSON.parse(xhr.responseText);
    console.log(products);
    var output='';
      for(var i in products){
      //   <div class="product-card">
      //   <div class="product-image">
      //     <span class="discount-tag">25% off</span>
      //     <img src="images/scent.png" class="product-thumb" alt="" />
      //     <button class="card-btn" id="produs">View Product</button>
      //   </div>
      //   <div class="product-info">
      //     <h2 class="product-brand">HUGO BOSS</h2>
      //     <p class="product-short-description">The Scent</p>
      //     <p class="product-short-description">Eau de Toilette - 100ML</p>
      //     <span class="price">$75</span><span class="actual-price">$100</span>
      //   </div>
      // </div>
        output+= '<div class="product-card">' +
          '<div class="product-image">' +
          '<img src="images/scent.png" class="product-thumb" alt="" />' + 
          '<button class="card-btn" id="produs">View Product</button>' +
          '</div>' +
          ' <div class="product-info">' +
          '<h2 class="product-brand">'+products[i].perfume_name+'</h2>' +
          '<p class="product-short-description">The Scent</p>' +
          '<p class="product-short-description">Eau de Toilette - 100ML</p>' +
          '<span class="price">'+'$'+products[i].price+'</span>'+
          '</div>' +
          '</div>';
          console.log(products[i].perfume_name);
      }
      document.getElementById("product").innerHTML=output;


      document.getElementById("produs").addEventListener("click",productPage);

      function productPage() {
        console.log(JSON.parse(xhr.response));
      }
  }
    xhr.send();
</script> -->
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Affiliate Program</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Get Help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Order Status</a></li>
                    <li><a href="#">Payment Options</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Online Shop</h4>
                <ul>
                    <li><a href="#">Male Perfumes</a></li>
                    <li><a href="#">Female Perfumes</a></li>
                    <li><a href="#">Kids Perfumes</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Follow Us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="progress-bar">
    <button class="back-to-top hidden">
        <i class="fa-solid fa-circle-up fa-3x"></i>
    </button>
</div>
<script>


    const urlParams = new URLSearchParams(window.location.search);
    const search = urlParams.getAll('search');
    console.log("search:" + search);
    const brand = urlParams.getAll('brand');
    console.log("brand:" + brand);

    const gender = urlParams.getAll('gender');
    console.log("gender:" + gender);
    const capacity = urlParams.getAll('capacity');
    console.log("capacity:" + capacity);

    const season = urlParams.getAll('season');
    console.log("season:" + season);
    var OK = 0;
    if (brand.length == 0 && gender.length == 0 && capacity.length == 0 && search.length == 0 && season.length == 0)
        var url = 'http://localhost/PerM/backend/PermBackEnd/index.php/product/list';
    else {
        var url = 'http://localhost/PerM/backend/PermBackEnd/index.php/product/filter/';
        if (search.length != 0) {

            OK = 1;
            url += 'search=' + search;
            document.getElementById('searchresult').innerHTML = 'Your results after: ' + search;
        }


        if (brand.length != 0) {
            if (OK == 1) url += '&';
            else OK = 1;
            url += 'brand=' + brand[0];
            for (i = 1; i < brand.length; i++)
                url += '&brand=' + brand[i];
        }
        if (gender.length != 0) {
            if (OK == 1) url += '&';
            else OK = 1;
            url += 'gender=' + gender[0];
            for (i = 1; i < gender.length; i++)
                url += '&gender=' + gender[i];
        }
        if (capacity.length != 0) {
            if (OK == 1) url += '&';
            else OK = 1;
            url += 'capacity=' + capacity[0];
            for (i = 1; i < capacity.length; i++)
                url += '&capacity=' + capacity[i];
        }
        if (season.length != 0) {
            if (OK == 1) url += '&';
            else OK = 1;
            url += 'season=' + season[0];
            for (i = 1; i < season.length; i++)
                url += '&season=' + season[i];
        }
    }


    for (let i = 0; i < brand.length; i++)
        document.getElementById(brand[i]).checked = true;
    for (let i = 0; i < gender.length; i++)
        document.getElementById(gender[i]).checked = true;
    for (let i = 0; i < capacity.length; i++)
        document.getElementById(capacity[i]).checked = true;
    for (let i = 0; i < season.length; i++)
        document.getElementById(season[i]).checked = true;


    console.log(url);
    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            let output = '';
            data.forEach(function (products) {
                output += '<div class="product-card">' +
                    '<div class="product-image">' +
                    '<img src="images/' + products.image_name + '" class="product-thumb" alt="" />' +
                    '<button  class="card-btn" id="produs" onclick="pagina(' + products.id + ')' + '"' + ' >View Product</button>' +
                    '</div>' +
                    ' <div class="product-info">' +
                    '<h2 class="product-brand">' + products.brand + '</h2>' +
                    '<p class="product-short-description">' + products.perfume_name + '</p>' +
                    '<p class="product-short-description">' + products.perfume_type + ' - ' + products.capacity + 'ML</p>' +
                    '<span class="price">' + '$' + products.price + '</span>' +
                    '</div>' +
                    '</div>';
            });

            document.getElementById('product').innerHTML = output;
        })


    function pagina(n) {
        console.log(n);
        window.location = "product.php?id=" + n;
    }

</script>
<script src="searchBar.js"></script>
<script src="app.js"></script>
<script>
    const loggedin = <?php echo $logat?>;
    if (loggedin == 1) {
        document.getElementById('profile').style.display = 'contents';
        document.getElementById('logout').style.display = 'contents';

    } else {
        document.getElementById('login').style.display = 'contents';
        document.getElementById('register').style.display = 'contents';
    }
</script>
</body>
</html>