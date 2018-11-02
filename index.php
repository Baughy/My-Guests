<!DOCTYPE html>
<html>
<head>
<title>Guest Registration</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<link rel="stylesheet" href="css/mystyles.css">
<meta name="description" content="This is a registration form for guests">
<meta name="keywords" content="RSVP, Register, Event">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container-fluid">
  <div class="navbar-header">
    <a class="navbar-brand" href="#">My Guests Admin</a>
  </div>
<ul class="navbar-nav">
  <li class="active"><a href="index.php">Home</a></li>
</ul>
</div>
</nav>
<br><br><br><br>
<div class="container">
<div class="row">
<div class="col-lg-12">

  <?

//Include php
include 'code.php';

//UPDATE
if(isset($_POST['updateguest'])) {
updateguest($servername, $username, $password, $dbname);
}

//DELETE
if(isset($_POST['deletethis'])) {
deleteguest($servername, $username, $password, $dbname);
}

//INSERT
if(isset($_POST['addguest'])) {
addguest($servername, $username, $password, $dbname);
}

//FORM
if(isset($_POST['editthis'])) {
echo $updateform;
} else {
echo $registrationform;
}

//LISTGUESTS
listguests($servername,$username, $password, $dbname);

?>


</div><!-- /column-->
</div><!-- /row-->
</div><!-- /container-->
</body>
</html>
