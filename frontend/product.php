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
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    <link rel="stylesheet" href="css/utilities.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <title>Product | PerM</title>

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
<div id="product-details" class="container">
    <div class="single-product-image">
        <img src="" width="100%" id="MainImg" alt=""/>

        <div class="small-img-group">
            <div class="small-img-col">
                <img src="" width="100%" id="pic1" class="small-img" alt=""/>
            </div>
            <div class="small-img-col">
                <img src="" width="100%" id="pic2" class="small-img" alt=""/>
            </div>
            <div class="small-img-col">
                <img src="" width="100%" class="small-img" id="pic3" alt=""/>
            </div>

        </div>
    </div>

    <div class="single-product-details">
        <h5 id="brand"></h5>
        <h2 id="perfume-name"></h2>

        <div class="review-stars" id="review-stars">
            <!-- <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star-half"></i> -->
        </div>
        <span id="rating"></span>
        <span id="numberOfReviews"></span>


        <div>
            <span id="perfume_type"></span> <span>-</span> <span id="capacity"></span>
            <h2 id="perfume-price"></h2>
            <p id="stock">Available</p>
        </div>
        <div id="buttonAdd">

        </div>


        <p id="alert">Cannot add to cart. <span><a href="login.html">Login here</a></span></p>
        <p id="alertStock">Cannot add to cart. Stock not available.</p>
    </div>
</div>
<div class="container">
    <dl>
        <div class="dl-group">
            <dt>Gender</dt>
            <dd id="gender"></dd>
        </div>
        <div class="dl-group">
            <dt>Occasion</dt>
            <dd id="occasion"></dd>
        </div>
        <div class="dl-group">
            <dt>Top Notes</dt>
            <dd id="top_notes"></dd>
        </div>
        <div class="dl-group">
            <dt>Base Notes</dt>
            <dd id="base_notes"></dd>
        </div>
        <div class="dl-group">
            <dt>Heart Notes</dt>
            <dd id="heart_notes"></dd>
        </div>
        <div class="dl-group">
            <dt>Launch Year</dt>
            <dd id="launch_year"></dd>
        </div>
        <div class="dl-group">
            <dt>Family</dt>
            <dd id="family"></dd>
        </div>
        <div class="dl-group">
            <dt>Subfamily</dt>
            <dd id="subfamily"></dd>
        </div>

    </dl>

    <div class="descriere">
        <h4>Product Details</h4>
        <div class="descrierespan">
            <span id="perfume-description"></span>
        </div>
    </div>

    <div class="descriere">
        <h4>Ingredients</h4>
        <div class="descrierespan">
            <span id="perfume-ingredients"></span>
        </div>
    </div>

    <!-- <div id="commentForm" class="comment form-wrap">

      <h3>Bought the product? Leave a review!</h3>
      <form action="/../PerM/backend/PermBackEnd/submit_comment.php" method="post" class="comment-form">
          <div class="form-group">
              <label>Please leave a rating for the product</label>
              <div class="rate">
                  <input type="radio" id="star5" name="rate" value="5"/>
                  <label for="star5" title="text">5 stars</label>
                  <input type="radio" id="star4" name="rate" value="4"/>
                  <label for="star4" title="text">4 stars</label>
                  <input type="radio" id="star3" name="rate" value="3"/>
                  <label for="star3" title="text">3 stars</label>
                  <input type="radio" id="star2" name="rate" value="2"/>
                  <label for="star2" title="text">2 stars</label>
                  <input type="radio" id="star1" name="rate" value="1"/>
                  <label for="star1" title="text">1 star</label>
              </div>
              <br><br>
          </div>
          <div id="prod_id">
          </div>
          <div class="form-group">
              <label>
                  Feedback <span><br></span>
                  <textarea cols="75" name="commentText" rows="5" style="width:100%"></textarea>
              </label><br>
          </div>
          <button type="submit" name="comment" class="btn">Submit</button>
      </form>
  </div> -->
    <section id="reviews">


        <div class="review-heading">
            <span>Comments</span>
            <h1>Clients Reviews</h1>
        </div>
        <div id="addAComment">

        </div>
        <div class="review-box-container" id="review-single">
            <!-- <div class="review-box">
              <div class="top-box">
                <div class="review-profile">
                  <div class="profile-img">
                    <img src="images/default-profile.png" alt="">
                  </div>
                  <div class="review-username">
                    <strong>John Doe</strong>
                  </div>
                </div>
                <div class="review-stars">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star"></i>
                </div>
              </div>

                <div class="client-comment">
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit incidunt nesciunt ducimus iste porro numquam eaque recusandae consequuntur omnis, magni nam, consectetur at aspernatur quod excepturi asperiores, rem reprehenderit nihil!</p>
                </div>
            </div> -->

        </div>


    </section>
</div>
<section class="product">
    <h2 class="product-category">More like this</h2>
    <button class="pre-btn"><img src="images/arrow.png" alt=""/></button>
    <button class="nxt-btn"><img src="images/arrow.png" alt=""/></button>
    <div class="product-container" id="productMore">
        <!-- <div class="product-card">
            <div class="product-image">
                <span class="discount-tag">50% off</span>
                <img src="images/ronaldo.png" class="product-thumb" alt="SIUUU"/>
                <button class="card-btn">View Product</button>
            </div>
            <div class="product-info">
                <h2 class="product-brand">CR7</h2>
                <p class="product-short-description">Cristiano Ronaldo CR7</p>
                <p class="product-short-description">Eau de Parfum - 50ML</p>
                <span class="price">$20</span><span class="actual-price">$40</span>
            </div>
        </div> -->


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
<script src="app.js"></script>
<script>

    // SCRIPT FOR CHANGING IMAGES
    var mainImg = document.getElementById("MainImg");
    var smallImg = document.getElementsByClassName("small-img");
    smallImg[0].onclick = function () {
        mainImg.src = smallImg[0].src;
    };
    smallImg[1].onclick = function () {
        mainImg.src = smallImg[1].src;
    };
    smallImg[2].onclick = function () {
        mainImg.src = smallImg[2].src;
    };


    // GET ID FROM PAGE
    url = window.location.search;
    const urlParams = new URLSearchParams(url);
    // var id = url.searchParams.get("id");

    const id = urlParams.get("id");

    console.log(id);
    var url =
        "http://localhost/PerM/backend/PermBackEnd/index.php/product/listSingle/" +
        id;
    var stockGl = 0;
    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            var brand = data.brand;
            var name = data.perfume_name;
            var price = "$" + data.price;
            var capacity = data.capacity + 'ML';
            var top_notes = data.top_notes;
            var base_notes = data.base_notes;
            var heart_notes = data.heart_notes;
            var launch_year = data.launch_year;
            var description = data.description;
            var stock = data.stock;
            var gender = data.gender;
            var occasion = data.occasion;
            var ingredients = data.ingredients;
            var perfume_type = data.perfume_type;
            var family = data.family;
            var subfamily = data.subfamily;
            StockGl = stock;
            var family = data.family;
            console.log(brand);
            console.log(name);
            document.getElementById("brand").innerHTML = brand;
            document.getElementById("perfume-name").innerHTML = name;
            document.getElementById("capacity").innerHTML = capacity;
            document.getElementById("perfume-price").innerHTML = price;
            document.getElementById("top_notes").innerHTML = top_notes;
            document.getElementById("base_notes").innerHTML = base_notes;
            document.getElementById("heart_notes").innerHTML = heart_notes;
            document.getElementById("launch_year").innerHTML = launch_year;
            document.getElementById("perfume_type").innerHTML = perfume_type;
            document.getElementById("occasion").innerHTML = occasion;
            document.getElementById("gender").innerHTML = gender;
            document.getElementById("family").innerHTML = family;
            document.getElementById("subfamily").innerHTML = subfamily;
            document.getElementById("perfume-ingredients").innerHTML = ingredients;
            if (stock > 0) {
                document.getElementById("stock").innerHTML = 'Available';
                document.getElementById("stock").style.color = "green";
            } else {
                document.getElementById("stock").innerHTML = 'Not Available';
                document.getElementById("stock").style.color = "red";
            }
            document.getElementById('buttonAdd').innerHTML = '<button onclick="addToCart(' + stock + ')">Add To Cart</button>';
            document.getElementById("perfume-description").innerHTML =
                description;
            document.getElementById("MainImg").src = 'images/' + data.image_name;
            document.getElementById("pic1").src = 'images/' + data.image_name;
            document.getElementById("pic1").style.cursor = "pointer";
            if (data.image_name2) {
                document.getElementById("pic2").src = 'images/' + data.image_name2;
                document.getElementById("pic2").style.cursor = "pointer";
            }
            if (data.image_name3) {
                document.getElementById("pic3").src = 'images/' + data.image_name3;
                document.getElementById("pic3").style.cursor = "pointer";
            }
            showMore(family);
        });

    console.log("stock:" + stockGl);

    function showMore(n) {
        var text = n;
        var URL = 'http://localhost/PerM/backend/PermBackEnd/index.php/product/filter/family=' + text.replace(' ', '.');
        console.log(URL);
        fetch(URL)
            .then((res) => res.json())
            .then((data) => {
                console.log(data);

                let output = '';
                data.forEach(function (products) {
                    if (products.id != id)
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
                document.getElementById('productMore').innerHTML = output;
            })
    }

    function addToCart(n) {
        //         {
        //     "user_id":9,
        //     "product_id":8
        // }
        if (n == 0) {
            document.getElementById('alertStock').style.visibility = 'visible';
            return;
        }
        var loggedin = 0;
        if (<?php echo $logat?> ==1
    )
        loggedin = 1;
        if (loggedin == 1) {
            const user_id = <?php echo $user_id ?>;
            console.log(user_id);
            console.log("add");

            var text = "{" + 'user_id":' + user_id + "," + "product_id:" + id + "}";

            var data = {
                user_id: user_id,
                product_id: id,
                quantity: 1
            };

            console.log(JSON.stringify(data))
            fetch("http://localhost/PerM/backend/PermBackEnd/index.php/cart/create", {
                method: "POST", // or 'PUT'
                body: JSON.stringify(data)
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log("Success:", data);
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        } else {
            document.getElementById('alert').style.visibility = 'visible';
        }
    }

    fetch('http://localhost/PerM/backend/PermBackEnd/index.php/comment/list/' + id)
        .then((res) => res.json())
        .then((data) => {
            let output = '';
            let average = 0;
            let number = 0;
            var alta = 0;

            data.forEach(function (review) {
                rating = review.rating;
                number = number + 1;
                average = average + rating;
                //  average=parseFloat(average).toFixed(2);
                output += '<div class="review-box">' +
                    '<div class="top-box">' +
                    '<div class="review-profile">' +
                    '<div class="profile-img">' +
                    '<img src="images/default-profile.png" alt="">' +
                    '</div>' +
                    '<div class="review-username">' +
                    '<strong id="fnamelname' + review.user_id + '">';

                output += '</strong>' +
                    '</div>' +
                    '</div>' +
                    '<div class="review-stars">';
                let i = 0;
                for (i = 0; i < rating; i++)
                    output += '<i class="fa-solid fa-star"></i>';
                for (let j = i; j < 5; j++)
                    output += '<i class="fa-regular fa-star"></i>';
                output += '</div>' +
                    '</div>' +
                    '<div class="client-comment">' +
                    '<p>' + review.comment + '</p>' +
                    '</div>' +
                    '</div>';
            });
            average = average / number;
            if (number == 0) {
                average = 0;
            }
            // average=5;
            document.getElementById('rating').innerHTML = '(' + average.toFixed(2) + ')';
            document.getElementById('rating').style.color = 'black';
            document.getElementById('numberOfReviews').innerHTML = '<a href="#reviews">Read ' + number + ' reviews</a>';

            let ratingstar = '';
            let i = 0;
            console.log("average:" + average);
            if (average != 0)
                for (i = 0; i < average - 1; i++) {
                    console.log("i:" + i)
                    ratingstar += '<i class="fa-solid fa-star"></i>';
                }
            // <i class="fa-solid fa-star"></i>
            // <i class="fa-solid fa-star-half"></i>
            if (average != 0)
                i = i + 1;


            if (i != average) {
                ratingstar += '<i class="fa-solid fa-star-half-stroke"></i>';
            } else if (average == 0) {
            } else ratingstar += '<i class="fa-solid fa-star"></i>';
            for (let j = i; j < 5; j++)
                ratingstar += '<i class="fa-regular fa-star"></i>';
            document.getElementById('review-stars').innerHTML = ratingstar;
            console.log(output);
            console.log(data);
            var OK = 0;
            data.forEach(function (user) {
                console.log(user);
                var loggedin =<?php echo $logat ?>;
                const user_id = <?php echo $user_id ?>;
                var userId = user.user_id;
                if (loggedin == 1) {
                    if (userId == user_id) OK = 1;
                }

                fetch('http://localhost/PerM/backend/PermBackEnd/index.php/user/listSingle/' + userId)
                    .then((res) => res.json())
                    .then((username) => {
                        console.log('username:' + username.first_name + ' ' + username.last_name);
                        document.getElementById('fnamelname' + userId).innerHTML = username.first_name + ' ' + username.last_name;
                    })
            });
            if (OK == 0)
                document.getElementById('addAComment').innerHTML = '<a href="submit_comment.html?id=' + id + '"><p>Add your comment</p></a>';
            document.getElementById('review-single').innerHTML = output;
        })


    function pagina(n) {
        console.log(n);
        window.location = "product.php?id=" + n;
    }

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

<script src="searchBar.js"></script>
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
