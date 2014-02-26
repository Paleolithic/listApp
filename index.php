<!DOCTYPE html>
<html lang="en">
<?php include("./assets/includes/head.php"); ?>

<body>
<?php
$page = "main"; 
include("./assets/includes/header.php");
?>

<div class='container content'>
	<?php
	//Credential checking / mysql connection
	include_once('credentials.php');
	$con=mysql_connect("127.0.0.1",$username,$password)
		or die("couldn't connect: ".mysql_error());
	mysql_select_db("tjb2597");
	
	$Query = "select * from lists"; // set query to get everything from the db 

	//Goes through query results
	$v_TheResult = mysql_query ($Query); 
	if ($v_TheResult) {

		$num_rows = mysql_num_rows($v_TheResult);
		//If no rows, suggests the creation of a list
		if($num_rows == 0){
			$v_result = "<div class='sixteen columns item'>";
				$v_result .= "<h3>No lists yet, try making one!</h3>";
			$v_result .= '</div>';
		}
		//Otherwise it prints all lists
		else{
		    while ($v_row = mysql_fetch_array($v_TheResult)) {
		        //$v_records[] = $v_row;
		        $v_result = "<div class='sixteen columns item'>";
				        $v_result .=  "<h3><a href='list.php?list_id=" . $v_row['list_id'] . "'>" . $v_row['title'] . "</a></h3>";
		        $v_result .= '</div>';

		        echo $v_result;
		    }
		}
	}
	
	

	?>
</div>
</body>
</html>
