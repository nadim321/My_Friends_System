<?php
include 'connect.php';

if(isset($_POST['loginForm'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(
      $email !== null && $email !== "" &&
      $password !== null && $password !== ""
    ){
        // query for retrive Data
        $sql = "Select * from friends where friend_email = '$email' and password = '$password'";

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        if($stmt->rowCount()){
            while ($row = $stmt->fetch()) {
                session_start();
                $_SESSION["friend_email"] = $email;
                $_SESSION["name"] = $row["profile_name"];
                $_SESSION["friend_id"] = $row["friend_id"];
                header('Location: friendlist.php');
            }
        }else{
            header('Location: login.php?message=badCredential');	
        }
    }else{
      header('Location: login.php?message=error');	
    }
}

?>



<!DOCTYPE html>
<html>
<body>

<div  align='center'>
<h1>My Friend System</h1>
<h2>Registration Page</h2>
</div>

<div  align='center' style="width:100%;" > 
    <form  method="post" >
        <table> 
          <tr>
            <td style="text-align: right"><label for="email">Email</label></td>
            <td><input id="email" name="email" type="email"></td>
          </tr>
          <tr>
            <td style="text-align: right"><label for="password">Password</label>
            <td><input id="password" name="password" type="password">
          </tr>   
          <tr>
            <td></td>
            <td>
              <input type="submit" value="Login" name="loginForm" id="loginForm"/> &nbsp;&nbsp;&nbsp;&nbsp;
              <input type="reset" value="Clear" />
            </td>
          </tr>

        </table>
    </form>
<br/>


<?php 
  if(isset($_GET["message"])){
    if( $_GET["message"] == 'error') {  
      echo '<span style="color:red"> Input Data wrong </span>';
    }
    if( $_GET["message"] == 'badCredential') {  
      echo '<span style="color:red"> Bad Credential</span>';
    }
    
  }
?>

</div>





</body>
</html> 
