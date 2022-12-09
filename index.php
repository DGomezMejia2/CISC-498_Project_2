<?php
session_start();

  include("connection.php");
  include("functions.php");

  $user_data = check_login($con);
  $food_data = display_table($con);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Project 2 Website</title>
        <link rel="icon" type="image" href="icon.png">
        <style>
          table{
            background-color: white;
          }

          a {
            font-size: 22px;
            border: 2px solid black;
          }
          .topnav {
            overflow: hidden;
            background-color: #333;
          }

          .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
          }

          .topnav a:hover {
            background-color: #ddd;
            color: black;
          }

          .topnav a.active {
            background-color: #04AA6D;
            color: white;
          }
        </style>
        <script>
        function myFunction() {
          alert("Your cart has been emailed!");
        }
        </script>
    </head>
    <body style="background-color:Beige;">
        <div class="topnav">
          <a class="active" href="index.php">Home</a>
          <a href="products.php">Check Products</a>
          <a href="cart.php">Food Plan</a>
          <a href="mailsend.php" onclick="myFunction()">Email</a>
          <a href="health.php">Health Information</a>
          <a href="stores.php">Availible Stores</a>
          <a href="about.php">Inventory</a>
          <a href="logout.php">Logout</a>
        </div>
        <h1>Welcome to the Home Page</h1>
        <div>
        <h1>Logged in as <?php echo $user_data['Name']; ?></h1>
        <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:2px;font-size: 20px;">
        Your weekly budget is $<?php echo $user_data['budget']; ?> <br>
        Your daily calorie intake should be <?php echo (10 * $user_data['weight'] + 6.25 * $user_data['height'] - 5 * $user_data['age'] + 5); ?>
        </div> <br><br>
        <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:5px; font-size: 25px;">
          <p>Check out your list of food items that you have picked for your weekly food plan:</p>
          <a href="cart.php">Look at your food plan</a>
          <p>If you have not yet picked out some items or would like to add or update some items, then click here:</p>
          <a href="products.php">Search for some food products</a>
        </div><br>
        <form method="post" style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:5px;font-size: 25px;">
        <p>Would you like an email of your food plan?</p>
        <a href="mailsend.php" onclick="myFunction()">Send your food list?</a>
        </form><br>
        <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:2px;font-size: 25px;">
          <p>Want some information on how we calculate your BMR?</p>
          <a href="health.php">Check out this page</a>
        </div><br>
        <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:2px;font-size: 25px;">
          <p>What stores are availible?</p>
          <a href="stores.php">Check out this page</a>
          <p>Which foods are availible?</p>
          <a href="about.php">Check out this page</a>
        </div>
        </div>
    </body>
</html>