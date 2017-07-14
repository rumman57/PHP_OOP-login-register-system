<?php
require("config.php");
class LoginRegistration{
    public function __construct()
    {
    	$database = new DatabaseConnection;
    }
    public function registeruser($username,$password,$email,$name,$website)
    {
    	global $conn;
    	$sql = "select id from users where username = ? && password= ?";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute(array($username,$password));
    	$num = $stmt->rowCount();
    	if($num == 0)
    	{
    		$query = "insert into users(username,password,name,email,website) values (?,?,?,?,?) ";
    		$pdo = $conn->prepare($query);
    		$pdo->execute(array($username,$password,$name,$email,$website));
    		return true;
    	}

    }
    public function UserLogin($username,$password)
    	{
    		global $conn;
    		$sql = "select * from users where username = ? && password = ?";
    		$stmt = $conn->prepare($sql);
    		$stmt->execute(array($username,$password));
    		$userdata = $stmt->fetch();
    		$row = $stmt->rowCount();
    		if($row ==1)
    		{
    			$_SESSION['login'] = true;
    			$_SESSION['uid'] = $userdata['id'];
    			$_SESSION['uname'] = $userdata['username'];
    			$_SESSION['login_msg'] = "Login Seccessfully";
    			return true;

    		}
    		else
    		{
    			return false;
    		}

    	}
    	public function getSession()
    	{
    		return @$_SESSION['login'];
    	}

       public function getAlluser($id)
       {
       	global $conn;
       	  $sel = "select * from users where id != ? order by id DESC";
       	  $stmt = $conn->prepare($sel);
       	  $stmt->execute(array($id));
       	  return $stmt->fetchAll(PDO::FETCH_ASSOC);

       }

    public function getProfile($id)
    {
    	global $conn;
    	$sel = "select * from users where id = ?";
    	$stmt = $conn->prepare($sel);
    	$stmt->execute(array($id));
    	$result = $stmt->fetch();
    	echo $result['name'];
    }
    public function showalluser($id)
    {
    	global $conn;
       	$sel = "select * from users where id = ?";
    	$stmt = $conn->prepare($sel);
    	$stmt->execute(array($id));
    	return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function udtaeuser($uid,$username,$email,$name,$website)
   {
   	    global $conn;
    	$sel = "update users set username = ?,name = ?,email=?,website=? where id = ?";
    	$stmt = $conn->prepare($sel);
    	$stmt->execute(array($username,$name,$email,$website,$uid));
    	return true;
   }
   public function getUpdateuserValue($uid)
   {
   	   global $conn;
    	$sel = "select * from users where id = ?";
    	$stmt = $conn->prepare($sel);
    	$stmt->execute(array($uid));
    	return $stmt->fetchAll(PDO::FETCH_ASSOC);

   }

   public function changePassword($uid,$old_pass,$new_pass)
   {
   	    global $conn;
    	$sel = "select * from users where password = ?";
    	$stmt = $conn->prepare($sel);
    	$stmt->execute(array($old_pass));
    	$row = $stmt->rowCount();
    	if($row==0)
    	{
    		return false;
    	}
    	else
    	{
    		$sql = "update users set password = ? where id = ?";
    		$stmt = $conn->prepare($sql);
    	    $stmt->execute(array($new_pass,$uid));
    	    return true;
    	}
   }
    public function userLogout()
    {
        session_start();
        $_SESSION['login'] = false;
        unset($_SESSION['uid']);
        unset($_SESSION['uname']);
        session_destroy();
        header("Location: login.php");
    }




}



?>