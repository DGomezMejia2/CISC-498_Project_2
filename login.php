<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
	{
	//info posted
	$email = $_POST['email'];
	$password = $_POST['password'];

	if(!empty($email) && !empty($password) && !is_numeric($email))
		{
		//read from database
		$query = "select * from users where email = '$email' limit 1";
		$result = mysqli_query($con, $query);

		if($result)
			{
			if($result && mysqli_num_rows($result) > 0)
				{
				$user_data = mysqli_fetch_assoc($result);
					
				if($user_data['password'] === $password)
					{
					$_SESSION['user_id'] = $user_data['user_id'];
					header("Location: index.php");
					die;
					}
				}
			}
		echo "wrong email or password!";
		}else {
			echo "wrong email or password!";
		}
	}
?>

<!DOCTYPE html>
	<html>
    <head>
        <title>Login</title>
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
                <h1 style="font-size:50px">Login</h1>
				<div style="font-size:25px">Email:</div>
                <input type="text" name="email"><br><br>
				<div style="font-size:25px">Password:</div>
                <input type="password" name="password"><br><br>
                <input type="submit" value="Login" style="font-size:20px"><br><br>
                <a href="signup.php" style="font-size:20px">Click to sign up</a><br><br>
            </form>
        </div>
    </body>
	</html>