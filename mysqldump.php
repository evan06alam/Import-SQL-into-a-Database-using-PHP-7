<html>
<head>
<title>MySQL DB Dump Progress</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style>
progress#myProgress {
	margin-right:10px;
}
</style>
</head>
<body>
<div class="container">
<?php 
$target_dir = "db/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
	//unlink($target_file);
	//echo 'Replaced old file with new one. ';
	$target_file=$target_dir . basename('1'.$_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
}
// Allow certain file formats
if($imageFileType != "sql") {
    echo "<p class='text-danger'>Sorry, only SQL files are allowed.</p>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<p class='text-danger'>Sorry, your file was not uploaded.</p>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p class='text-success'>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</p>";
    } else {
        echo "<p class='text-danger'>Sorry, there was an error uploading your file.</p>";
    }
}
?>

<?php
if($uploadOk==1 && $_POST['dbName']!='' && $_POST['dbUser']!='' && $target_file!=''){
$dumpFileLocaiton=$target_file;
$dbHostname='localhost';
$dbDatabaseName=$_POST['dbName'];
$dbUserName=$_POST['dbUser'];
$dbPassword=$_POST['dbPassword'];
echo '<progress id="myProgress" value="0" max="100">0%</progress>';
echo '<span id="progresspercent">0%</span> Executed Successfully.';
echo '</center>';
set_time_limit(0);
$conn =new mysqli($dbHostname, $dbUserName, $dbPassword , $dbDatabaseName);

$query = '';
$sqlScript = file($dumpFileLocaiton);
$totalLine=count($sqlScript);
$lineNo=1;
	foreach ($sqlScript as $line)	{
		$startWith = substr(trim($line), 0 ,2);
		$endWith = substr(trim($line), -1 ,1);
		
		if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
			continue;
		}
			
		$query = $query . $line;
		if ($endWith == ';') {
			mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query at line no '.$lineNo.' <b>' . $query. '</b></div>');
			$query= '';	
						
		}	
		$lineNo++;
		$percentcomplete=(100*$lineNo)/$totalLine;
		echo '<script language="javascript">
		document.getElementById("myProgress").value = "'.$percentcomplete.'";
		document.getElementById("myProgress").innerHTML = "'.$percentcomplete.'%";   
		document.getElementById("progresspercent").innerHTML = "'.round($percentcomplete).'%"; 	
		</script>';	
	}
	echo '<a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i>Back</a>';
}
echo '<script language="javascript">
		document.getElementById("myProgress").value = "100";
		document.getElementById("myProgress").innerHTML = "100%";   
		document.getElementById("progresspercent").innerHTML = "100%"; 	
		</script>';	
echo '<div class="success-response sql-import-response"><p>SQL file imported successfully</p></div>';
echo '<a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i>Back</a>';
?>
</div>
</body>
</html>
