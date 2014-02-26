<?php
    //Credential checking / mysql connection
    include_once('credentials.php');
    $con=mysqli_connect("127.0.0.1",$username,$password)
        or die("couldn't connect: ".mysql_error());
    mysqli_select_db($con, "tjb2597");
    
    //Checking isset. Will return fail if not
    //Should check mysql injection
    if (isset($_POST['Title']) &&
        isset($_POST['Notif']) && 
        $_POST['Title']    != ''
        ) {

        $title = $_POST['Title'];
        $notif = $_POST['Notif'];

        //Translates true/false into 0/1 for database
        $bool  = ($notif == false) ? 0 : 1;

        //Queries database with new list information
        $query = "INSERT INTO lists(title, notifications) VALUES ('" . $title . "' , $bool)";
        $res = mysqli_query($con, $query);

        //This function returns the id of the just inserted row
        //This is so that the ajax call can send you to the appropriate page
        $id = mysqli_insert_id($con);
        $res = $id;
        echo ($res);
    }

    else{
        echo "fail";
    }

?>