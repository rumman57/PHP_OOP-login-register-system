<?php
session_start();
include("functions.php");
$obj = new LoginRegistration;
if($obj->getSession())
{
   header("Location: index.php");
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
    <div class="menu" style="margin-left: 320px;">
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

<?php
  $err="";
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
  	 $username = $_POST['username'];
     $password = $_POST['password'];
     if(empty($username) || empty($password))
     {
        $err = "Field Must Not Be Empty";
     }
     else
     {
        $password = md5($password);
        $login= $obj->UserLogin($username,$password);
        if($login)
        {
          header("Location: index.php");
        }
        else
        {
          $err = "Username Or Password is not correct";
        }
     }
  }

?>


   <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
         <table>
         	<tr>
         	 <td>
         	 	Username : 
         	 </td>
             <td>
             	<input type="text" name="username" placeholder="Give Username">
             </td>
         	</tr>
            <tr>
         	 <td>
         	 	Password: 
         	 </td>
             <td>
             	<input type="password" name="password" placeholder="Give password">
             </td>
         	</tr>
         	<tr>
         	 <td colspan= "4">
         	 	<input type="submit" name="login" value="Login">
         	 </td>
         	</tr>
         	<tr>
            <br><br><span class="err"><?php echo $err?></span>
             </tr>
         </table>
       </form>
   </div>
 </body>
