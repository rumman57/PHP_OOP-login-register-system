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
      <h3 style="text-align: center;color:maroon;" >Change Password</h3>
      <?php
  $err="";
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
     $old_pass = md5($_POST['old_pass']);
     $new_pass = $_POST['new_pass'];
     $confirm_pass = $_POST['confirm_pass'];
     if(empty($old_pass) || empty($new_pass) || empty($confirm_pass))
     {
      $err = "Field Must Be Filled Up";
     }
     else 
     {
        $confirm_pass = md5($confirm_pass);
        $new_pass = md5($new_pass);
        if($new_pass!= $confirm_pass)
        {
          $err = "Password does not match";
        }
        else
        {
          $result = $obj->changePassword($uid,$old_pass,$new_pass);
          if(!$result)
          {
            $err = "Password is not correct";
          }
          else
          {
             echo "<script>alert('Update Password Successfully')</script>";
             echo "<script>window.open('logout.php','_self')</script>";
          }
        }
        
     }
  }

?>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
         <table>
          <tr>
           <td>
            Old Password : 
           </td>
             <td>
              <input type="password" name="old_pass" placeholder="Give Your Old Passsword">
             </td>
          </tr>
            <tr>
           <td>
            New Password: 
           </td>
             <td>
              <input type="password" name="new_pass" placeholder="Give New  password">
             </td>
          </tr>
          <tr>
           <td>
            Confirm Password: 
           </td>
             <td>
              <input  type="password" name="confirm_pass" placeholder="Confirm Your Password">
             </td>
          </tr>
          
          <tr>
           <td colspan= "4">
            <input type="submit" class="chanPass"  name="change_pass" value="Change Password">
          </tr>
          <tr>
            <br><br><span class="err"><?php echo $err?></span>
             </tr>
         </table>
       </form>
   </div> 
 </body>
