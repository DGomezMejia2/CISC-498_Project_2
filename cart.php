<?php
session_start();
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
    $food_data = display_table($con);
    $user_basket = display_cart($con);
    $user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Basket</title>
        <link rel="icon" type="image" href="icon.png">
        <style>
            a {
                font-size: 22px;
                border: 2px solid black;
            }
            table{
                border: 2px solid black;
                text-align: center;
                background-color: white;
                margin-left: auto; 
                margin-right: auto;
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
    </div> <br>
    <a href="index.php" style="background-color:white;">Return to Home Page</a>
    <a href="products.php" style="background-color:white;">Add More?</a>
    <br><br>
    <div style="clear:both"></div>  
        <br />  
        <h3 style="text-align:center;border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:2px;font-size: 20px;">Order Details</h3>  
        <div>  
            <?php
            $result = mysqli_query($con,"SELECT item_id, item_name, item_price, item_quantity, item_calories FROM user_basket WHERE user_id=$user_id");
            echo "<table style='border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:2px;font-size: 20px;'>";

            if(mysqli_num_rows($result) > 0) {
                echo "<tr>";
                echo "<th>" . "Item ID" . "</th>";
                echo "<th>" . "Item Name" . "</th>";
                echo "<th>" . "Price" . "</th>";
                echo "<th>" . "Quantity" . "</th>";
                echo "<th>" . "Calories" . "</th>";
                echo "</tr>";

                $i = 1;
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
                
                $result = mysqli_query($con,"SELECT item_price, item_quantity, item_calories FROM user_basket WHERE user_id=$user_id");
                $i = 0;
                $total = 0;  
                $cals_calc = 0;

                foreach ($result as $keys => $values)  {
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                    $cals_calc = $cals_calc + ($values["item_quantity"] * $values["item_calories"]);
                }
                
                echo "<tr>";
                echo "<th>" . "" . "</th>";
                echo "<th>" . "" . "</th>";
                echo "<th>" . "Total Price" . "</th>";
                echo "<th>" . "" . "</th>";
                echo "<th>" . "Total Calories" . "</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>" . "" . "</th>";
                echo "<th>" . "" . "</th>";
                echo "<th>" . "$" . $total . "</th>";
                echo "<th>" . "" . "</th>";
                echo "<th>" . $cals_calc . "</th>";
                echo "</tr>";
                echo "</table><br>";
                
                $cals_total = (10 * $user_data['weight'] + 6.25 * $user_data['height'] - 5 * $user_data['age'] + 5) * 7;
                if ($cals_calc <= $cals_total){
                    echo "<div style='text-align:center; border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:2px;font-size: 20px;'><p>All your items meets your weekly calorie intake condition</p>";
                } else if ($cals_calc > $cals_total){
                    echo "<div style='text-align:center;'><p>All your items exceeds your weekly calorie intake condition</p>";
                }

                if ($total <= $user_data['budget']){
                    echo "<p>All your items meets your budget condition</p></div>";
                } else if ($total > $user_data['budget']){
                    echo "<p>All your items exceeds your budget condition</p></div>";
                }

                mysqli_close($con);
            } else {
                echo "NOTHING IS INSIDE YOUR CART";
            }
            ?> 
        </div>
    </body>
</html>