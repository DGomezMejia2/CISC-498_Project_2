<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$food_data = display_table($con);
?>

<DOCTYPE html>
<html>
    <head>
        <title>Availible Stores</title>
        <link rel="icon" type="image" href="icon.png">
        <style>
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
        <h1>Health Information</h1>
        <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:2px;font-size: 20px;">
            <h3>What is Basal Metabolic Rate (BMR)?</h3>
            <p>The BMR is the rate at which your body burns calories as it performs basic life-sustaining functions.</p>
            <h3>How is your BMR calculated?</h3>
            <p>Your BMR is calculated through your weight, height, and age.</p>
            <p>BMR = 10W + 6.25H - 5A + 5</p>
        </div>
    </body>
</html>