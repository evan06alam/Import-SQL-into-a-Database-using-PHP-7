<html>
<head>
<title>MySQL DB Dump</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="row">		
				<h3>Provide Database Import Details with File:</h3>
				<div class="col-md-6 well">
				<form action="mysqldump.php" method="post" enctype="multipart/form-data">
					<div class="input-group">
					<label>Database Name: <input type="text" name="dbName" class="form-control" placeholder="Database Name"></label>
					</div>
					<div class="input-group">
					<label>Database User Name: <input type="text" name="dbUser" class="form-control" placeholder="Database User Name"></label>
					</div>
					<div class="input-group">
					<label>Database Password: <input type="text" name="dbPassword" class="form-control" placeholder="Database Password"></label>
					</div>
					<div class="input-group">
					<label>Database Dump SQL File: <input type="file" name="fileToUpload" class="form-control" id="fileToUpload"></label>
					</div>
					<div class="input-group">
					<input type="submit" class="btn btn-success" style="margin:3px;" value="Upload SQL and Import" name="submit">
					<input type="reset" class="btn btn-info" style="margin:3px;" value="Reset Now">
					</div>
				</form>
				</div>
		</div>
	</div>
</body>
</html>
