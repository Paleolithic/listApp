<!DOCTYPE html>
<html lang="en">
<?php include("./assets/includes/head.php"); ?>

<body>
<?php
	$page = "newList"; 
	include("./assets/includes/header.php"); 
?>

<div class='container content'>
	<div class='sixteen columns'>
		<input type='text' value='Title...' onclick="this.value='';" class='listTitle'>
		<h3 class='left'>Notifications</h3>
        <a class='right' id="slider" title="button" ></a>
	</div>
</div>
<script type='text/javascript'>

    //Toggles down class to create toggle button look alike
    $(document).ready(function(){
        $('a#slider').click(function(){
             $(this).toggleClass( "down", 500 );
        });

    });

    //Sends ajax call to createNewList.php with list information
    function createList(){

        //Some minor validation
        //TODO : mysql injection checking
        if( $( ".listTitle" ).val() == '' 
         || $( ".listTitle" ).val() == "Title..." ){
            
            alert("Must enter title!");
    
        }
        else{
           
            $title    = $(".listTitle").val();
            $notifbut = $("a#slider");

            $notif = $notifbut.hasClass( "down" ) ? true : false;

            //Sends title and notification preferences over to createNewList.php
            $.ajax({
                url: "createNewList.php",
                type: "POST",
                data: { 
                    "Title": $title,
                    "Notif": $notif, 
                },
                success: function(res){

                    if(res == "fail"){
                        //alert(res);
                        alert("Couldn't create list...sorry!");
                    }
                    //Moves to list page if successful
                    else{
                        
                        document.location = "list.php?list_id=" + res;
                    }
                }
            });
        }
    }
</script>
</body>
</html>
