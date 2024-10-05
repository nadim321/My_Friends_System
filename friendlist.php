<?php
include 'connect.php';
session_start();

?>

<?php
    $friendCount = 0;
    $friend_id = 0;
    if(isset($_SESSION["friend_id"])){
        $friend_id = $_SESSION["friend_id"];
    }else{
        header('Location: login.php');
    }

    // delete frind from myfriends
if(isset($_POST['unfriend'])) {
    $remove_item = $_POST["remove_item"];
    $sql = "DELETE from myfriends where friend_id1 = $friend_id and friend_id2 = $remove_item";
    $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

}

?>


<!DOCTYPE html>
<html>
<body>

<div  align='center'>
<h1>My Friend System</h1>
<h2><?php echo $_SESSION["name"]; ?> Friend List Page</h2>

<?php 

    // get the total friend to show friend list
    $sql = "Select f.friend_id f_id , f.profile_name profile_name, friend_id2 from myfriends mf inner join friends f on f.friend_id = mf.friend_id2 where friend_id1 = $friend_id";
    $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        $friendCount = $stmt->rowCount();
        echo "<h3> Total number of friends is $friendCount</h3>" ;

        if($stmt->rowCount()){
            echo "<table width='40%' border='1px solid black'>";
            while ($row = $stmt->fetch()) {
                echo "<tr><td >".$row["profile_name"]."</td><td align='center'><form method='post'> 
                <input type='hidden' name='remove_item' value='".$row["friend_id2"]."'/>
                <input type='submit' name='unfriend' id='unfriend' value='Unfriend'/></form></td>";
            }
            echo "</table>";
        }
?>
</div>

<br/>
<div  align='center' style="width:100%;" > 
    <span> <a href="friendadd.php">Add Friend</a></span> &nbsp;&nbsp;&nbsp;
    <span> <a href="friendadd.php">Log out</a></span>
</div>





</body>
</html> 