<?php
    //Credential checking / mysql connection
    include_once('credentials.php');
    $con=mysqli_connect("127.0.0.1",$username,$password)
        or die("couldn't connect: ".mysql_error());
    mysqli_select_db($con, "tjb2597");

    if(isset($_POST['List_id'])){

        $list_id = $_POST['List_id'];


        $queryItem = "DELETE FROM items WHERE field_id = $list_id";
        $res = mysqli_query($con, $queryItem);
        
        $query = "DELETE FROM lists WHERE list_id = $list_id";
        $res = mysqli_query($con, $query);

        echo($queryItem);
    }
?>