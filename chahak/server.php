<?php

$con = new mysqli_connect("localhost", "acs_de_gam", "acslab","acs_draft");
if(!$con)
	{
	die("Could not connect: ".mysql_error());
	}
$result = mysqli_query($con,"SELECT * FROM use1");
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
{
	$output[]=$row;
}
print(json_encode($output));
mysqli_close($con);

?>