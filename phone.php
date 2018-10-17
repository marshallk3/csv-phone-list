<?php  

$file = "Phone Directory.csv";
	  
	$search = '
	<hr> 
	<div align="center">
		<input class="form-control" id="Input" type="text" placeholder="Search here for a contact" style="width: 400px">
	</div>
	<br>
  ';
  
  $output = '

	  <table width="100%" class="table table-bordered table-striped">
	   <thead>
		<tr align="center">
			<th onclick="sortTable(0)">Name</th>
			<th onclick="sortTable(1)">Ext</th>
			<th onclick="sortTable(2)">Direct Dial</th>
			<th onclick="sortTable(3)">Mobile</th>
			<th onclick="sortTable(4)">Email</th>
			<th onclick="sortTable(5)">Branch</th>
			<th onclick="sortTable(6)">Department</th>

		</tr>
	   </thead>
	   <tbody id="table">
 ';
	
	
	$i = 1;  
	
   $handle = fopen($file, "r");
   while($row = fgetcsv($handle))
   {
		
		$name		= $row[0];
		$ext		= $row[1];
		$ddi		= $row[2];
		$ddi	   .= $row[3];
		$mobile		= $row[4];
		$email		= $row[5];
		$branch 	= $row[6];
		$depart		= $row[7];
//		$activity	= $row[8];
//		$acti		= $row[9];
		
	// Set the colour between the branches	
		switch ($branch) {
			
		  case "Sheerness":
			$color = 'yellow';
			break;

		case "Telford":
			$color = 'orange';
			break;
		
		case "Falkirk":
			$color = '#00ff00';
			break;
			
		  default:
			$color = '#42a0ff'; 
			
		}
		
	//Check if the DDI is not empty and add a 0
		if (!empty($ddi)){
			
			$ddi = "0".$ddi;
		}
		
	//Check if the Mobile is not empty and add a 0
		if (!empty($mobile)){
			
			$mobile = "0".$mobile;
		}
		
			
			
		

$email = "<b><a href='mailto:{$email}?Subject={$name}&body=Hello%20{$name}'>{$email}</a></b>";

			
	
			
		$output .= '
		<tr style="background-color:'.$color.'">
			<td><b>'.$name.'</b></td>
			<td align="center">'.$ext.'</td>
			<td align="center">'.$ddi.'</td>
			<td align="center">'.$mobile.'</td>
			<td align="center">'.$email.'</td>
			<td align="center">'.$branch.'</td>				
			<td align="center">'.$depart .'</td>
		  </tr>
		';
		
   }
   
   fclose($handle);
   
   
   $output .= ' </tbody> </table>  ';
 
?>
<?php
/* <!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<meta content="width=device-width, initial-scale=1" name="viewport">
<title>Phone List</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
</head>
 */
 ?>
<body>

<h3 align="center">Company Phone List</h3>

<div><?php echo $search;?></div>

<div class="table-responsive">
	<div class="col-sm-12 table-responsive">
		<div align="center">
			<?php	echo  $output;	?>
		</div>
	</div>
</div>
<hr>
<div align="center">
	<a href="https://nodem.network"><span align="center">&copy; Nodem Network
	</span></a></div>
<br>

</body>
<script>
$(document).ready(function(){
  $("#Input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("table");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 0; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

</html>
