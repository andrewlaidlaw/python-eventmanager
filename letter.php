<?php

require_once 'functions.php';

$letter = $_REQUEST['submit'];

$con=connect();

$query1 = "SELECT id, fname, lname FROM attendees WHERE fname LIKE '" . $letter . "%' ORDER BY fname";
$result1 = mysqli_query($con, $query1);
$query2 = "SELECT id, fname, lname FROM attendees WHERE lname LIKE '" . $letter . "%' ORDER BY lname";
$result2 = mysqli_query($con, $query2);

disconnect($con);

echo "
<html>
<head>
<title>Launch Event</title>
<meta name='viewport' content='width=device-width, user-scalable=no'>
<link rel='stylesheet' type='text/css' href='style.css' />
</head>
<body>
<a href='index.php'>&lt; back</a>
<form name='name' method='get' action='name.php'>
Attendees (" . $letter . ")<br />
<table>
";

if (mysqli_num_rows($result1)==0)
	{
	
	}
else
	{
	echo "<tr><th>By First Name</th><th>&nbsp;</th></tr>
	";
	while ($row = mysqli_fetch_array($result1))
		{
		$id = $row['id'];
		echo "
		<tr><td><a href='name.php?name=" . $id . "'>" . $row['fname'] . " " . $row['lname'] . "</a></td><td><button name='name' type='submit' formaction='name.php' formmethod='get' value='" . $id . "'>Select</button></td></tr>
		";
		}
	}

if (mysqli_num_rows($result2)==0)
	{
	
	}
else
	{
	echo "<tr><th>By Last Name</th><th>&nbsp;</th></tr>
	";
	while ($row = mysqli_fetch_array($result2))
		{
		$id = $row['id'];
		echo "
		<tr><td><a href='name.php?name=" . $id . "'>" . $row['fname'] . " " . $row['lname'] . "</a></td><td><button name='name' type='submit' formaction='name.php' formmethod='get' value='" . $id . "'>Select</button></td></tr>
		";
		}
	}

echo "</table>
</body>
</html>
";

?>