
<html>
<body>
<center>
<h1>
Create Barcode
</h1>
<form action="form1.php">
Enter barcode data <input type="" name="bar_code"><br>
<input type="submit" value="Create Barcode">
</form>
<?php
if(isset($_GET['bar_code'])){
	$bar_code=$_GET['bar_code'];
	include 'barcode128.php';
	echo bar128($bar_code);
}	
?>
</center>
</body>
</html>
