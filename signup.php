<?php
include 'connect.php';

if(isset($_POST['signupForm'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confpassword = $_POST['confpassword'];

    if(
      $email !== null && $email !== "" &&
      $name !== null && $name !== "" &&      
      $password !== null && $password !== "" && 
      $confpassword !== null && $confpassword !== ""
    ){
      if(strcmp($password , $confpassword) != 0 ){
        echo "Hello";
        header('Location: signup.php?message=doesNotMatch');
      }
      else{
        // query for insert firends Data
        $sql = "INSERT into friends (friend_email,password,profile_name,date_started,num_of_friends) VALUES ('$email','$password','$name',current_timestamp(),0)";
      //  echo $sql;
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        header('Location: friendadd.php?message=successfull');
      }
    }else{
      header('Location: signup.php?message=error');	
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
    <form   method="post" >
        <table> 
          <tr>
            <td style="text-align: right"><label for="email">Email</label></td>
            <td><input id="email" name="email" type="email"></td>
          </tr>
          <tr>
            <td style="text-align: right"><label for="name">Profile Name</label></td>
            <td><input id="name" name="name" type="text">
          </tr>
          <tr>
            <td style="text-align: right"><label for="password">Password</label>
            <td><input id="password" name="password" type="password">
          </tr>         
          <tr>
            <td style="text-align: right"><label for="confpassword">Confirm Password</label>
            <td><input id="confpassword" name="confpassword" type="password">
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" value="Register" name="signupForm" id="signupForm"/> &nbsp;&nbsp;&nbsp;&nbsp;
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
    if( $_GET["message"] == 'doesNotMatch') {  
      echo '<span style="color:red"> Password and Confirm password does not match </span>';
    }
    
  }
?>
    <div> <a href="index.php">Home</a></div>
</div>





</body>
</html> 

