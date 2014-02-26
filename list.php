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
			}
			else{
				while ($v_row = mysql_fetch_array($v_TheResult)) {
			        //$v_records[] = $v_row;
			        $v_result = "<div class='sixteen columns item'>";
				      	$v_result .= "<h3 class='item-title left'>" . $v_row['item_name'] . "</h3>";
				      	$v_result .= "<div class='delete right'><h3><a href='#'>Delete</a></h3></div>";
				      	$v_result .= "<div class='hider right'></div>";  
			        $v_result .= '</div>';
			    }
			}
		}

		echo $v_result;
	}

	?>

	<div class='sixteen columns'>
		<input type='text' value='New item' onclick="this.value='';" class='listTitle'>
	</div>
</div>
</body>
</html>
<script type='text/javascript'>
$(document).ready(function(){ 
	
	var slideout = $(".delete");
	var name     = $("#list-name");
	var notif    = $("#notifications");
	var toggle   =  0;

	$("#edit").click(function () {
    // use cached object instead of searching
    	
    	if(toggle == 0){
	        slideout.animate({
	            right: '0px'
	        }, {
	            queue: false,
	            duration: 500
	        });

	        notif.slideDown();
	        toggle = 1;
	    } else{
	    	slideout.animate({
	            right: '-117px'
	        }, {
	            queue: false,
	            duration: 500
	        });
	        notif.slideUp();
	        toggle = 0;
	    }
    });
});
</script>
