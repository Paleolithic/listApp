<!DOCTYPE html>
<html lang="en">
<?php include("./assets/includes/head.php"); ?>
<body>
<?php
$page = "list"; 
include("./assets/includes/header.php");
?>

<div class='container content'>
	<?php
	include_once('credentials.php');

	if (isset($_GET['list_id'])) {

		//Credential checking / mysql connection
		$con=mysql_connect("127.0.0.1",$username,$password)
		or die("couldn't connect: ".mysql_error());
		mysql_select_db("tjb2597");
		$Query = "select * from items where field_id =" . $_GET['list_id']; // set query to get everything from the db 
		$v_TheResult = mysql_query ($Query); 

		if ($v_TheResult) {

			$num_rows = mysql_num_rows($v_TheResult);
			if($num_rows == 0){
				$v_result = "<div class='sixteen columns item'>";
					$v_result .= "<h3>No items yet, add one!</h3>";
				$v_result .= '</div>';

				//echo $v_result;
			}
			else{
				while ($v_row = mysql_fetch_array($v_TheResult)) {
			        //$v_records[] = $v_row;
			        $v_result = "<div class='sixteen columns item'>";
				      	$v_result .= "<h3 class='item-title left'>" . $v_row['item_name'] . "</h3>";
				      	$v_result .= "<div class='delete right'><h3><a href='#' class='deleteItem'>Delete</a></h3></div>";
			        $v_result .= '</div>';
					
					echo $v_result;
			    }
			}
		}

	}

	?>

	<div class='sixteen columns inputDiv'>
		<span id='addItem'>
			<a href='#' class='left' onclick='createItem();'><img style='margin-top:16px;' src='assets/images/plus.png' height='35px' width='35px'></a>
			<input type='text' class='right' id='newItem' value='New item' onclick="this.value='';">
		</span>
		<input class='deleteList' type='button' value='Delete List'>
	</div>
</div>
</body>
</html>
<script type='text/javascript'>


	var toggle   =  0;
	
	$("#edit").click(function () {
    	// use cached object instead of searching
		var slideout = $(".delete");
		var name     = $("#list-name");
		var notif    = $("#notifications");
    	var del      = $(".deleteList");
    	var addItem  = $("#addItem");

    	if(toggle == 0){
	        slideout.animate({
	            right: '0px'
	        }, {
	            queue: false,
	            duration: 500
	        });

	        notif.slideDown();

	        del.css("display", "inline");
	        addItem.css("display", "none");
	        toggle = 1;
	    } else{
	    	slideout.animate({
	            right: '-117px'
	        }, {
	            queue: false,
	            duration: 500
	        });
	        
	        notif.slideUp();

			del.css("display", "none");
	        addItem.css("display", "inline");
	        toggle = 0;
	    }
    });

	//Sends ajax call to createNewList.php with list information
    function createItem(){

        //Some minor validation
        //TODO : mysql injection checking
        if( $( "#newItem" ).val() == '' 
         || $( "#newItem" ).val() == "New Item..." ){
            
            alert("Must enter title!");
    
        }
        else{
           
            $title    = $( "#newItem" ).val();
            $list_id  = $( "#list-name span").html();

            //Sends title and notification preferences over to createNewList.php
            $.ajax({
                url: "createNewItem.php",
                type: "POST",
                data: { 
                	"Title": $title,
                	"List_id": $list_id,
                },
                success: function(res){

                    if(res == "fail"){
                        //alert(res);
                        alert("Couldn't create list...sorry!");
                    }
                    //Moves to list page if successful
                    else{
                    	//alert(res);
                        var $add = "<div class='sixteen columns item'>";
                        $add += 	"<h3 class='item-title left'>" + $title + "</h3>";
                        $add += 	"<div class='delete right'><h3><a href='#' class='deleteItem'>Delete</a></h3></div>";
                        $add += "</div>";

                        $( ".inputDiv" ).before($add);


                        //document.location = "list.php?list_id=" + res;
                    }
                }
            });

            
        }
    }

    $(".deleteList").click(function(){
    	$list_id  = $( "#list-name span" ).html();
    	
    	//alert($item);
		$.ajax({
            url: "deleteList.php",
            type: "POST",
            data: { 
            	"List_id": $list_id,
            },
            success: function(res){

                if(res == "fail"){
                    //alert(res);
                    alert("Couldn't create list...sorry!");
                }
                //Moves to list page if successful
                else{
                    document.location = "index.php";
                }
            }
        });
    });

    $(".deleteItem").click(function(){
		$list_id   = $( "#list-name span" ).html();
		var this_item = $(this).parent().parent().parent();
		var item_name = this_item.find("h3").html();

		$.ajax({
            url: "deleteItem.php",
            type: "POST",
            data: { 
            	"List_id": $list_id,
            	"Item_name": item_name,
            },
            success: function(res){

                if(res == "fail"){
                    //alert(res);
                    alert("Couldn't create list...sorry!");
                }
                //Moves to list page if successful
                else{
                	this_item.remove();
                }
            }
        });
    });

</script>
