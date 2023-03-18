<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $logat = 0;
    $user_id = 0;
    $gender = 0;
} else {
    $logat = 1;
    $user_id = $_SESSION['user_id'];
    $gender = $_SESSION['gender'];
}
?>

<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="css/utilities.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <title>PerM | Home</title>
</head>
<body>
<header class="bg">
    <!-- Navbar -->
    <nav class="navbar">
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
                        <div class="dropdown-menu" id="dropdownLoggedUnlogged">
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
    <div class="bg-content">
        <h1>Go Check Our</h1>
        <a href="productlist.php" class="header-btn">Products</a>
    </div>
</header>

<!-- Main -->
<main>
    <!-- First Image Slider -->
    <div class="img-slider1">
        <div class="slide active">
            <img src="./images/perfume1.jpeg" alt=""/>
            <div class="info">
                <h2>Blooming</h2>
                <p>great deals</p>
            </div>
        </div>
        <div class="slide">
            <img src="./images/perfume2.jpeg" alt=""/>
            <div class="info">
                <h2>A gift to remember</h2>
                <p>this spring</p>
            </div>
        </div>
        <div class="slide">
            <img src="./images/perfume3.jpeg" alt=""/>
            <div class="info">
                <h2>Blooming</h2>
                <p>great deals</p>
            </div>
        </div>
        <div class="navigation">
            <div class="btn active"></div>
            <div class="btn"></div>
            <div class="btn"></div>
        </div>
    </div>

    <!-- Perfume logos section -->
    <div class="perfume-logo">
        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=Armani"
            ><img src="./logoImages/armani-1624536437.png" alt=""
                /></a>
        </div>
        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=HUGO.BOSS"
            ><img src="./logoImages/BOSS_NEW_LOGO-1643643880.jpeg" alt=""
                /></a>
        </div>
        php
        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=Chanel"
            ><img src="./logoImages/chanel-1624536503.png" alt=""
                /></a>
        </div>
        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=Dior"><img
                        src="./logoImages/dior-1624537132.png" alt=""/></a>
        </div>

        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=Marc.Jacobs"
            ><img src="./logoImages/marc-jacobs-1624537748.png" alt=""
                /></a>
        </div>
        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=Mugler"
            ><img src="./logoImages/mugler-1624537826.png" alt=""
                /></a>
        </div>
        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=Paco.Rabanne"
            ><img src="./logoImages/paco-rabanne-1624537900.png" alt=""
                /></a>
        </div>
        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=Tiffany"
            ><img src="./logoImages/tiffany-co-1624537910.png" alt=""
                /></a>
        </div>
        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=Tom.Ford"
            ><img src="./logoImages/tom-ford-1624537944.png" alt=""
                /></a>
        </div>
        <div class="perfume">
            <a href="http://localhost/PerM/frontend/productlist.php?brand=Yves.Saint.Laurent"><img
                        src="./logoImages/ysl-1624537978.png" alt=""/></a>
        </div>
    </div>

    <!-- Second image slider -->
    <div class="img-slider2">
        <div class="slide2 active2">
            <img src="./images/slide1.jpeg" alt=""/>
            <div class="info">
                <h2>Blooming</h2>
                <p>great deals</p>
            </div>
        </div>
        <div class="slide2">
            <img src="./images/slide2.jpeg" alt=""/>
            <div class="info">
                <h2>A gift to remember</h2>
                <p>this spring</p>
            </div>
        </div>
        <div class="slide2">
            <img src="./images/slide3.jpeg" alt=""/>
            <div class="info">
                <h2>Blooming</h2>
                <p>great deals</p>
            </div>
        </div>
        <div class="slide2">
            <img src="./images/slide4.jpeg" alt=""/>
            <div class="info">
                <h2>Marc Jacobs</h2>
                <p>find the perfect gift</p>
            </div>
        </div>
        <div class="navigation2">
            <div class="btn2 active2"></div>
            <div class="btn2"></div>
            <div class="btn2"></div>
            <div class="btn2"></div>
        </div>
    </div>


</main>

<!-- back to top Button -->
<div class="progress-bar">
    <button class="back-to-top hidden">
        <i class="fa-solid fa-circle-up fa-3x"></i>
    </button>
</div>

<!-- Best Sellings Section -->

<section class="product" id="products">
    <h2 class="product-category">Best Sellings</h2>
    <button class="pre-btn"><img src="images/arrow.png" alt=""/></button>
    <button class="nxt-btn"><img src="images/arrow.png" alt=""/></button>
    <div class="product-container" id="bestSellers">
    </div>
</section>

<!-- For You Section -->

<section class="product" id="forYouSection">
    <div id="forYouSlider">
        <!--  -->
    </div>
    <div class="product-container" id="forYou">

    </div>
</section>

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
                    <li><a href="http://localhost/PerM/frontend/productlist.html?gender=Male">Male Perfumes</a></li>
                    <li><a href="http://localhost/PerM/frontend/productlist.html?gender=Female">Female Perfumes</a></li>
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

<!-- js link -->


<script>
    // BESTSELLERS
    var URLBestSellers = 'http://localhost/PerM/backend/PermBackEnd/index.php/product/list/bestsellers';
    fetch(URLBestSellers)
        .then((res) => res.json())
        .then((data) => {
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
            console.log(output);
            document.getElementById('bestSellers').innerHTML = output;
        })

    // FOR YOU
    const loggedin = <?php echo $logat?>;
    const user_id = <?php echo $user_id?>;
    const gender = '<?php echo $gender?>';
    if (loggedin == 1) {
        var el = '<h2 class="product-category">For You</h2>' +
            '<button class="pre-btn"><img src="images/arrow.png" alt=""/></button>' +
            '<button class="nxt-btn"><img src="images/arrow.png" alt=""/></button>';
        document.getElementById('forYouSlider').innerHTML = el;
        //http://localhost/PerM/backend/PermBackEnd/index.php/preference/listSingle/32
        fetch('http://localhost/PerM/backend/PermBackEnd/index.php/preference/listSingle/' + user_id)
            .then((res) => res.json())
            .then((data) => {
                var URLForYou = 'http://localhost/PerM/backend/PermBackEnd/index.php/product/filter/';
                URLForYou += 'gender=' + gender + '&';
                data.forEach(function (preferences) {
                    var pr = preferences.preference;
                    URLForYou += 'occasion=' + pr.replace(' ', '.');
                    URLForYou += '&';
                })
                URLForYou = URLForYou.slice(0, -1);
                console.log(URLForYou);
                fetch(URLForYou)
                    .then((res) => res.json())
                    .then((perfumes) => {
                        let output = '';
                        perfumes.forEach(function (products) {
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
                        document.getElementById('forYou').innerHTML = output;
                    })

            })


    }

    function pagina(n) {
        console.log(n);
        window.location = "product.php?id=" + n;
    }


    if (loggedin == 1) {
        document.getElementById('profile').style.display = 'contents';
        document.getElementById('logout').style.display = 'contents';

    } else {
        document.getElementById('login').style.display = 'contents';
        document.getElementById('register').style.display = 'contents';
    }

</script>

<script src="searchBar.js"></script>
<script src="app.js"></script>
<script>
    const productContainers = [...document.querySelectorAll(".product-container")];
    const nxtBtn = [...document.querySelectorAll(".nxt-btn")];
    const preBtn = [...document.querySelectorAll(".pre-btn")];

    productContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtn[i].addEventListener("click", () => {
            item.scrollLeft += containerWidth;
        });

        preBtn[i].addEventListener("click", () => {
            item.scrollLeft -= containerWidth;
        });
    });
</script>
</body>
</html>
