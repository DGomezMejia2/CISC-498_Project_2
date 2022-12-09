<?php
session_start();
include("connection.php");
include("functions.php");
$user_data = check_login($con);
$food_data = display_table($con);
$user_basket = display_cart($con);
$user_id = $_SESSION['user_id'];
$result = mysqli_query($con,"SELECT item_id, item_name, item_price, item_quantity, item_calories FROM user_basket WHERE user_id=$user_id");
$table = "<div id='status'>
<table cellspacing='0' cellpadding='0' border=''>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Calories</th>
    </tr>";
    while ( $row = $result->fetch_assoc() ) {
        $table .= "<tr>";
        $table .= "<td>" . $row['item_id'] . "</td>";
        $table .= "<td>" . $row['item_name'] . "</td>";
        $table .= "<td>" . $row['item_price'] . "</td>";
        $table .= "<td>" . $row['item_quantity'] . "</td>";
        $table .= "<td>" . $row['item_calories'] . "</td>";
    }
    $table .= "
    </tr>
    </table>
</div>";

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "pj2.hf.hu@gmail.com";
$mail->Password   = "eyhqhlbnjlmhpvlw";
$mail->Subject = "Check out your what you need for your food plan!";
$mail->SetFrom("pj2.hf.hu@gmail.com");
$mail->IsHTML(true);
$mail->Body = "<p>.$table.</p>";
$mail->AddAddress($user_data['email']);
if($mail->Send()) {
  echo "Email sent successfully";
} else {
  echo "Email not successful";
}
$mail->smtpClose();

header("Location: index.php");
?>