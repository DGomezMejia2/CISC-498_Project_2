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
        <h1>About</h1>
        <h2>Look at whats availibe in the inventory: </h2><br>
        
        <?php
        $result = mysqli_query($con,"SELECT food_name, price, category, calories, store_name FROM food_data");

        echo "<table border='1' style='text-align:center;'>";
        
        $i = 0;
        while($row = $result->fetch_assoc())
        {
            if ($i == 0) {
              $i++;
              echo "<tr>";
              foreach ($row as $key => $value) {
                echo "<th>" . $key . "</th>";
              }
              echo "</tr>";
            }
            echo "<tr>";
            foreach ($row as $value) {
              echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        
        mysqli_close($con);
        ?>
    </body>
</html>