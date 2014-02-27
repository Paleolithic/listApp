<?php
    //Credential checking / mysql connection
    include_once('credentials.php');
    $con=mysqli_connect("127.0.0.1",$username,$password)
        or die("couldn't connect: ".mysql_error());
    mysqli_select_db($con, "tjb2597");

    if( isset( $_POST['List_id'] ) &&
        isset( $_POST['Item_name'] )
       ){

        $list_id   = $_POST['List_id'];
        $item_name = $_POST['Item_name'];
        
        $queryItem = "DELETE FROM items WHERE field_id = $list_id AND item_name = '" . $item_name . "'";
        $res = mysqli_query($con, $queryItem);

        echo($queryItem);
    }
?>