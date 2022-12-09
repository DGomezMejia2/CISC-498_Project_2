<?php
session_start();

include("connection.php");
include("functions.php");

$food_data = display_table($con);
$user_data = check_login($con);
$user_basket = display_cart($con);
$user_id = $_SESSION['user_id'];

if(isset($_POST["add_to_cart"]))  
 {
    $user_id = $_SESSION['user_id'];
    $item_id = $_GET["id"];
    $item_name = $_POST["hidden_name"];
    $item_price = $_POST["hidden_price"];
    $item_quantity = $_POST["quantity"];
    $item_calories = $_POST["hidden_calories"];
    
    $check = mysqli_query($con,"SELECT * FROM user_basket WHERE user_id = $user_id AND item_id = $item_id");
    $check = mysqli_fetch_assoc($check);
    $checked = $check['item_name'];
    
    if (isset($checked)){
        $q_total = $item_quantity + $check['item_quantity'];
        $query = "update user_basket set item_quantity = '$q_total' where item_id = '$item_id' and user_id = '$user_id'";
    } else {
        $query = "insert into user_basket (user_id, item_id, item_name, item_price, item_quantity, item_calories) values ('$user_id', '$item_id', '$item_name', '$item_price', '$item_quantity', '$item_calories')";
    }
    mysqli_query($con, $query);
 }

if (isset($_POST["delete_from_cart"]))
 {
    $user_id = $_SESSION['user_id'];
    $item_id = $_POST["hidden_id"];
    $item_name = $_POST["hidden_name"];
    $item_price = $_POST["hidden_price"];
    $item_quantity = $_POST["hidden_quantity"];
    $item_calories = $_POST["hidden_calories"];

    $query = "delete from user_basket where user_id = '$user_id' and item_id = '$item_id'";
    mysqli_query($con, $query);
 }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <link rel="icon" type="image" href="icon.png">
        <style>
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
        </div><br>
        <a href="index.php" style="background-color:white;">Return to Home Page</a>
        <a href="cart.php" style="background-color:white;">Check your Cart</a>
        <br><br>
            <?php
            $query = "SELECT * FROM user_basket WHERE user_id=$user_id";
            $result = mysqli_query($con,$query); 

            if ($num = mysqli_num_rows($result) > 0) {  
                while ($row = mysqli_fetch_assoc($result)) {  
            ?>
            <div class="container">
            <form method="post" action="products.php?action=delete&id=<?php echo $row['item_id']; ?>">
                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:3px; padding:2px;font-size: 20px">  
                    <p class="text-info">ID:<?php echo $row["item_id"]; ?> &emsp; Name: <?php echo $row["item_name"]; ?> &emsp; Price:<?php echo $row["item_price"]; ?> &emsp; Quantity:<?php echo $row["item_quantity"]; ?> &emsp; Calories:<?php echo $row["item_calories"]; ?></p> 
                    <input type="hidden" name="hidden_id" value="<?php echo $row["item_id"]; ?>" />  
                    <input type="hidden" name="hidden_name" value="<?php echo $row["item_name"]; ?>" />  
                    <input type="hidden" name="hidden_price" value="<?php echo $row["item_price"]; ?>" />
                    <input type="hidden" name="hidden_quantity" value="<?php echo $row["item_quantity"]; ?>" />
                    <input type="hidden" name="hidden_calories" value="<?php echo $row["item_calories"]; ?>" />
                    <input type="submit" name="delete_from_cart" class="btn btn-success" value="Delete" />
                </div>
            </form>
            </div>
            <?php
                } 
            } 
            ?>
            </form>
            <h3>Showing all products</h3>
            <div style="clear:both"></div>  
            <br />  
            <h3>Order Details</h3>  
            <?php
            $query = "SELECT * FROM food_data ORDER BY food_id ASC ";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="col-md-4">
                <form method="post" action="products.php?action=add&id=<?php echo $row["food_id"]; ?>">  
                    <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:2px;font-size: 20px">  
                        <h4 class="text-info">Name:<?php echo $row["food_name"]; ?> &emsp; Price:$ <?php echo $row["price"]; ?> &emsp; Calories:<?php echo $row["calories"]; ?></h4>  
                        <input type="text" name="quantity" class="form-control" value="1" />  
                        <input type="hidden" name="hidden_name" value="<?php echo $row["food_name"]; ?>" />  
                        <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                        <input type="hidden" name="hidden_calories" value="<?php echo $row["calories"]; ?>" />
                        <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                    </div>
                </form>
            </div>
        <?php
            }
            mysqli_close($con);
        }
        ?>    
        </div>
    </body>
</html>