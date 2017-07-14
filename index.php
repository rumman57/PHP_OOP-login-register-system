<?php
session_start();
include("functions.php");
$obj = new LoginRegistration;
$uid = $_SESSION['uid'];
$uname = $_SESSION['uname'];
if(!$obj->getSession())
{
   header("Location: login.php");
   exit();
}

?>

<!DOCTYPE html>
<html>
 <head>
  <title>About Us</title>
 <link href ="style.css" rel ="stylesheet" />
  <meta name="description" content ="Oito psd theke html ar ki"/>
  <meta name="keywords" content ="HTML,CSS"/>
  <meta name ="author" content ="Rumman" />
  <meta charset = "UTF-8" />
  </head>
 <body>
 <div class="wrapper">
    <div class = "header">
    	<h1>PHP OOP Login Resgister System</h1>
    </div>
    <div class="menu" style="margin-left: 175px;">
     <ul>
      <?php if($obj->getSession()) {?>
     	<li><a href = "index.php">Home</a></li>
     	<li><a href = "profile.php">My Profile</a></li>
     	<li><a href = "ChangePassword.php">Changed Password</a></li>
      <li><a href = "logout.php">Logout</a></li>
      <?php } else { ?>
     	<li><a href = "login.php">Login</a></li>    	
     	<li><a href = "register.php">Register</a></li>
      <?php } ?>
     </ul>
   </div>
   <div class="content">

      <h2 style="text-align: center; margin-right: 00px; color:#34516b;" >Welcome <?php echo $uname;?></h2>
      <h3 style="text-align: center;color:maroon;" >All user List</h3>
      <table style="overflow: hidden; width:500px;margin-left: 250px;">
      <tr style="height: 40px; color:forestgreen;">
        <th style="border: 1px solid gray;" >Serial</th>
        <th style="border: 1px solid gray;" >Name</th>
        <th style="border: 1px solid gray;" >Profile</th>
      </tr>
    <?php
      $i=0;
      $alluser = $obj->getAlluser($uid);
      foreach ($alluser as $value) {
        $i++;
      
    ?>  

      <tr style="height: 35px;" >
        <td style="border: 1px solid skyblue;font-weight: normal;"><?php echo $i?></td>
        <td style="border: 1px solid skyblue;font-weight: normal;"><?php echo $value['name']?></td>
        <td style="border: 1px solid skyblue;font-weight: normal;"><a href="viewProfile.php?id=<?php echo $value['id'];?>">View Details</a></td>
      </tr>
        <?php } ?>
      </table>
   </div> 
 </body>
