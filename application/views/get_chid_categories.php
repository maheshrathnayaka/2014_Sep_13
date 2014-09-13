<?php
include('dbcon.php');
//echo "<script type='text/javascript'>alert('Helll');</script>";
if($_REQUEST)
{
	$id 	= $_REQUEST['parent_id'];
	$query  = "SELECT * FROM category WHERE parentcategory = ".$id;
	$results  = @mysql_query( $query);
	$num_rows = @mysql_num_rows($results);
	if($num_rows > 0)
	{?>
		<select name="sub_category" class="form-control parent">
		<option value="" selected="selected">-- Sub Category --</option>
		<?php
		while ($rows = mysql_fetch_assoc(@$results))
		{?>
			<option value="<?php echo $rows['categoryid'];?>"><?php echo $rows['categoryname'];?></option>
		<?php
		}?>
		</select>	
	<?php	
	}
	else{echo '<label style="padding:7px;float:left; font-size:12px;">Finished!</label>';}
}
?>