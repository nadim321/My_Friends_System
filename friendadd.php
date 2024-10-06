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

if(isset($_POST['addAsFriend'])) {
    $add_item = $_POST["add_item"];
    $sql = "INSERT INTO myfriends ( friend_id1, friend_id2)  VALUES ($friend_id , $add_item) ";
    // echo $sql;
    $stmt = $conn->prepare($sql);
        $result = $stmt->execute();

}

?>


<!DOCTYPE html>
<html>
<body>

<div  align='center'>
<h1>My Friend System</h1>
<h2><?php echo $_SESSION["name"]; ?> Add Friend Page</h2>


<?php 
    // get the total number of friend
    $sql = "Select f.friend_id f_id , f.profile_name profile_name, friend_id2 from myfriends mf inner join friends f on f.friend_id = mf.friend_id2 where friend_id1 = $friend_id";
    $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        $friendCount = $stmt->rowCount();
        echo "<h3> Total number of friends is $friendCount</h3>" ;
    $pageNumber = 1;
    if(isset($_GET["pageNo"])){
        $pageNumber = $_GET["pageNo"];
    }
    $pageCount = ($pageNumber-1) * 10;    


    // get total row count
    $sql = "
    SELECT profile_name , friend_id , 
    (SELECT count(*) from myfriends WHERE friend_id1 = A.friend_id and friend_id2 in (Select friend_id2 from myfriends where friend_id1 = $friend_id)) mutual 
    from ( Select profile_name , friend_id from friends where friend_id !=$friend_id and friend_id not in (Select friend_id2 from myfriends where friend_id1 = $friend_id) ) A      
    ";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    $rowCount = $stmt->rowCount();   

    // get all the registered user list with mutual friend count
    $sql = "
    SELECT profile_name , friend_id , 
    (SELECT count(*) from myfriends WHERE friend_id1 = A.friend_id and friend_id2 in (Select friend_id2 from myfriends where friend_id1 = $friend_id)) mutual 
    from ( Select profile_name , friend_id from friends where friend_id !=$friend_id and friend_id not in (Select friend_id2 from myfriends where friend_id1 = $friend_id) ) A 
    LIMIT 10
    OFFSET  $pageCount
     
    ";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();

    // prepar the table
    if($stmt->rowCount()){
        echo "<table width='40%' border='1px solid black'>";
        while ($row = $stmt->fetch()) {
            echo "<tr><td >".$row["profile_name"]."</td><td align='center'>".$row["mutual"]."</td><td align='center'><form method='post'> 
            <input type='hidden' name='add_item' value='".$row["friend_id"]."'/>
            <input type='submit' name='addAsFriend' id='addAsFriend' value='Add as friend'/></form></td></tr>";
        }
        echo "</table>";
    }
    echo "</br>";
    for ($x = 1; $x <= ceil(($rowCount/10)); $x++) {
        echo "<a href='friendadd.php?pageNo=$x'>$x</a> &nbsp;&nbsp;";
    }


?>


</div>
<br/>
<div  align='center' style="width:100%;" > 
    <span> <a href="friendlist.php">Friend Lists</a></span> &nbsp;&nbsp;&nbsp;
    <span> <a href="logout.php">Log out</a></span>
</div>




</body>
</html> 