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
       <h3 style="text-align: center;color:maroon;" >Update Your Profile</h3>
       <?php
  $err="";
  if($_SERVER['REQUEST_METHOD']=='POST')
  {
     $username = $_POST['username'];
     $email = $_POST['email'];
     $name = $_POST['name'];
     $website = $_POST['website'];
     if(empty($username)  || empty($email) || empty($name) || empty($website))
     {
        $err = "Field Must Be Filled Up";
     }
     else 
     {
        $result = $obj->udtaeuser($uid,$username,$email,$name,$website);
        if($result)
        {
            echo "<script>alert('Update Profile Successfully')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }

     }
  }

?>


   <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    <?php
      $row = $obj->getUpdateuserValue($uid);
      foreach ($row as $value) {
        
      
    ?>
         <table>
          <tr>
           <td>
            Username : 
           </td>
             <td>
              <input type="text" name="username" value="<?php echo $value['username']?>">
             </td>
          </tr>
          <tr>
           <td>
            Name: 
           </td>
             <td>
              <input type="text" name="name" value="<?php echo $value['name']?>" >
             </td>
          </tr>
          <tr>
          <tr>
           <td>
            Email: 
           </td>
             <td>
              <input type="text" name="email" value="<?php echo $value['email']?>">
             </td>
          </tr>
          <tr>
           <td>
            Website: 
           </td>
             <td>
              <input type="text" name="website" value="<?php echo $value['website']?>" >
             </td>
          </tr>
          <tr>
           <td colspan= "4">
            <input type="submit" name="Update" value="Update">
           </td>
          </tr>
          <tr>
            <br><br><span class="err"><?php echo $err?></span>
             </tr>
         </table>
         <?php } ?>
       </form>
      
      
   </div> 
 </body>
