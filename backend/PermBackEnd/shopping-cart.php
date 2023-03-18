<?php 
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /../PerM/frontend/login.html");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="shortcut icon" type="image/x-icon" href="/../PerM/frontend/favicon.ico" />
    <link rel="stylesheet" href="/../PerM/frontend/css/style.css" />

    <title>Shopping Cart | PerM</title>
  </head>
  <body>

  <nav class="navbar" id="prod-list-navbar">
      <div class="content">
          <div class="logo">
              <a href="/../PerM/frontend/index.php"
              ><img src="/../PerM/frontend/images/logo-render.png" alt="logo"
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
                          <a href="/../PerM/frontend/login.html" class="menu-button" id="login">Login</a>
                          <a href="/../PerM/frontend/register.html" id="register" class="menu-button"
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
                          <a href="/../PerM/frontend/   contact.html" class="menu-button" id="contact-us"
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
    <div class="container cart-page">
      <table>
        <thead>
          <th>Product</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </thead>
        <tbody id="cartproducts">
          
        </tbody>
      </table>

      <div class="total-price">
        <table>
          <tr>
            <td>Total</td>
            <td id="total">$0</td>
          </tr>
        </table>
      </div>

      <div class="cart-button" id="checkout">
        <!-- <button onclick="order(total)">Checkout</button> -->
      </div>
    </div>

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
  </body>

  <script>

  // $_SESSION["loggedin"]

    var id = <?php echo $_SESSION['user_id']?>;
    console.log(id);
    var total=0;
    let afteroutput = "";
    var url =
      "http://localhost/PerM/backend/PermBackEnd/index.php/cart/list/" + id;
    fetch(url)
      .then((res) => res.json())
      .then((data) => {
        console.log(data);

        data.forEach(function (products) {
          
          var productURL =
            "http://localhost/PerM/backend/PermBackEnd/index.php/product/listSingle/" +
            products.product_id;

          //   fetch(productURL)
          //   .then((res) =>res.json())
          //   .then((data) => {
          //     console.log(data);

          //     var name=data.perfume_name;
          //     var price='$' + data.price;
          //     output +='<tr>' +
          //         '<td>' +
          //           '<div class="cart-info">' +
          //             '<img src="/../PerM/frontend/images/ronaldo.png" alt="">' +
          //             '<div>' +
          //             '<p>' + name + '</p>' +
          //             '<a href="">Remove</a>' +
          //           '</div>' +
          //          '</div>' +
          //        '</td>' +
          //        '<td><input type="number" value="1"></td>' +
          //        '<td>' + price + '</td>' +
          //      '</tr>' ;
          //     // <tr>
          //     //     <td>
          //     //       <div class="cart-info">
          //     //         <img src="/../PerM/frontend/images/ronaldo.png" alt="">
          //     //         <div>
          //     //         <p>Cristiano Ronaldo</p>
          //     //         <a href="">Remove</a>
          //     //       </div>
          //     //       </div>
          //     //     </td>
          //     //     <td><input type="number" value="1"></td>
          //     //     <td>50.00$</td>
          //     //   </tr>

          // afteroutput+=output;
          // console.log(afteroutput);
          //      document.getElementById('cart-porducts').innerHTML=output;
          //   })

            
            
            fetch(productURL)
              .then((res) => res.json())
              .then((data) => {
                console.log(data);
                let output = "";
                
                var name = data.perfume_name;
                var price = "$" + (data.price * products.quantity) ;
                total=total+data.price * products.quantity;

                output +=
                  "<tr>" +
                  "<td>" +
                  '<div class="cart-info">' +
                  '<a href="http://localhost/PerM/frontend/product.php?id='+ data.id +'">'+
                  '<img src="/../PerM/frontend/images/'+data.image_name+'" alt="">' +
                  '</a>'+
                  "<div>" +
                  '<p class="scris">' +
                  name +
                  "</p>" +
                  '<a onclick="deleteProduct('+ data.id +')">Remove</a>' +
                  "</div>" +
                  "</div>" +
                  "</td>" +
                  '<td>' +
                  '<select name="quantity" id="quantity'+ products.id +'" onchange="updateQuantity('+ products.id +')">';
                  var maxStock=0;
                  if(data.stock >6)
                  maxStock=6;
                  else
                  maxStock=data.stock;
                  for(let i=1;i<=maxStock;i++) {
                    if(i==products.quantity)
                  output+='<option value="'+ i +'" selected>'+ i +' </option>';
                    else
                    output+='<option value="'+ i +'">'+ i +'</option>';
                  }
                  output+='</select>' +
                  '</td>' +
                  "<td>" +
                  price +
                  "</td>" +
                  "</tr>";
                // <tr>
                //     <td>
                //       <div class="cart-info">
                //         <img src="/../PerM/frontend/images/ronaldo.png" alt="">
                //         <div>
                //         <p>Cristiano Ronaldo</p>
                //         <a href="">Remove</a>
                //       </div>
                //       </div>
                //     </td>
                //     <td><input type="number" value="1"></td>
                //     <td>50.00$</td>
                //   </tr>
                console.log(output);
                afteroutput+=output;
                document.getElementById("cartproducts").innerHTML = afteroutput;
              console.log(total);
              document.getElementById("total").innerHTML = '$'+total;
                console.log('afteroutput:'+afteroutput);
                document.getElementById("checkout").innerHTML='<button onclick="order('+total+')">Checkout</button>';  

            
              console.log("id:"+products.id);
              });
              
          
        });
      });


           
     
    function deleteProduct(pId) {
      var deleteURL= 'http://localhost/PerM/backend/PermBackEnd/index.php/cart/delete/'+id+'/' + pId;
      console.log("detele"+pId);
      fetch(deleteURL, {
    method: "DELETE",
    headers: {
        'Content-type': 'application/json'
    }
})
.then(res => {
    if (res.ok) { console.log("HTTP request successful") }
    else { console.log("HTTP request unsuccessful") }
    return res
})
.then(res => res.json())
.then(data => console.log(data))
.catch(error => console.log(error))
location.reload();
}


function order(n) {
                  console.log("total din functie:" + n);
                  window.location = "orderForm.php?total=" + n;
                }

console.log("total:"+total);

function updateQuantity(n) {
  console.log("id cart:"+n);
  var x = document.getElementById("quantity"+n).value;
  console.log("You selected:" + x);
  var urlUpdate='http://localhost/PerM/backend/PermBackEnd/index.php/cart/update/'+ n + '/' + x;
  fetch(urlUpdate, {
    method: "PUT"
  })
  .then((response) => response.json())
          .then((data) => {
            console.log("Success:", data);
            location.reload();
          })
          .catch((error) => {
            console.error("Error:", error);
          });
  
}

  </script>
  <script src="/../PerM/frontend/app.js "></script>
  <script>
    document.getElementById('searchProduct').addEventListener("keypress",function (e){
  if(e.key === 'Enter') {
      window.location = "/../PerM/frontend/productlist.php?search=" + document.getElementById('searchProduct').value;
  }
});


   document.getElementById('profile').style.display='contents';
   document.getElementById('logout').style.display='contents';
  


  </script>
</html>
