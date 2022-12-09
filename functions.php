<?php

function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";

        $result = mysqli_query($con,$query);
        if ($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect
    header("Location: login.php");
    die;
}

function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length = 5;
    }
    $len = rand(4,$length);

    for ($i=0; $i < $len; $i++) {
        $text .= rand(0,9);
    }
    return $text;
}

function display_table($con)
{
    $query = "SELECT * FROM food_data";
    $result = mysqli_query($con, $query);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck > 0)
    {
        $food_data = mysqli_fetch_assoc($result);
        return $food_data;    
    }
}

function display_cart($con){
    $query = "SELECT * FROM user_basket";
    $result = mysqli_query($con, $query);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck > 0)
    {
        $user_basket = mysqli_fetch_assoc($result);
        return $user_basket;    
    }
}
function email($con)
{

    $to      = 'DGomez2@my.harrisburgu.edu';
    $subject = 'Food List';
    $message = 'Here is your food list';
    $headers = 'From: project2@example.com';
    mail($to, $subject, $message, $headers);
        
}