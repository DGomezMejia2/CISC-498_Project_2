    <?php
session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //info posted
        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['u_name'];
        $age = $_POST['age'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $budget = $_POST['budget'];

        if(!empty($email) && !empty($password) && !is_numeric($email))
        {
            //save to database
            $user_id = random_num(20);
            $query = "insert into users (user_id,email,password,Name,age,weight,height,budget) values ('$user_id','$email','$password', '$name', '$age','$weight','$height','$budget')";

            mysqli_query($con, $query);

            header("Location: login.php");
            die;
        }else
            {
                echo "please enter valid information";
            }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
        <link rel="icon" type="image" href="icon.png">
        <style>
			.center{
				margin-left: 75px;
				margin-right: auto;
			}
			a {
				border: 2px solid black;
			}
            input{
                width:200px;
                margin:5px;
                padding: 10px;
            }
            div {
            width: 30%;
            }
		</style>
    </head>
    <body class="center" style="background-color:Beige;">
        <div id="box" style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:2px;font-size: 20px;">
            <form method="post">
                <h1 style="font-size:50px">Sign Up</h1>
                <div style="font-size:25px">Email:</div>
                <input type="text" name="email"><br><br>
                <div style="font-size:25px">Password:</div>
                <input type="password" name="password"><br><br>
                <div style="font-size:25px">Name:</div>
                <input type="text" name="u_name"><br><br>
                <div style="font-size:25px">Age:</div>
                <input type="int" name="age"><br><br>
                <div style="font-size:25px">Weight(lb):</div>
                <input type="text" name="weight"><br><br>
                <div style="font-size:25px">Height(cm):</div>
                <input type="text" name="height"><br><br>
                <div style="font-size:25px">Budget:</div>
                <input type="text" name="budget"><br><br>
                <input type="submit" value="Sign Up" style="font-size:20px"><br><br>
                <a href="login.php" style="font-size:20px">Click to log in</a><br><br>
            </form>
        </div>
    </body>
</html>