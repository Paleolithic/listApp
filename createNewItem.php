<?php
    //Credential checking / mysql connection
    include_once('credentials.php');
    $con=mysqli_connect("127.0.0.1",$username,$password)
        or die("couldn't connect: ".mysql_error());
    mysqli_select_db($con, "tjb2597");
    
    //Checking isset. Will return fail if not
    //Should check mysql injection
    if (isset($_POST['Title']) &&
        isset($_POST['List_id']) &&
        $_POST['Title']    != ''
        ) {

        $title = $_POST['Title'];
        $list_id = $_POST['List_id'];

        //Queries database with new list information
        $query = "INSERT INTO items(item_name, field_id) VALUES ('" . $title . "' , $list_id)";
        $res = mysqli_query($con, $query);

        //This function returns the id of the just inserted row
        //This is so that the ajax call can send you to the appropriate page
        //$id = mysqli_insert_id($con);
        //$res = $id;
        
        //$res = $title . " " . $list_id;
        echo ($query);
    }

    else{
        echo "fail";
    }

?>