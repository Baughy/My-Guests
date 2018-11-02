
<!DOCTYPE html>
<html>
<?
//server credentials
$servername = "localhost";
$username = "baughy";
$password = "Espeon1";
$dbname = "jaxcode56";
?>
<head>
<title>Guest Registration</title>




<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="css/mystyles.css">

<style>
.container-fluid {
    padding-top: 70px;
    padding-bottom: 70px;
}
</style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-lg-12">

<?

//Include php
include 'myguestcode.php'

//Update
if(isset($_POST['updateguest'])) {
  echo 'Record updated!';
}
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE MyGuests SET
firstname='{$_POST['firstname']}',
lastname='{$_POST['lastname']}',
email='{$_POST['email']}' WHERE id='{$_POST['id']}'";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);

// DELETE
if(isset($_POST['deletethis'])) {
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // sql to delete a record
  $sql = "DELETE FROM MyGuests WHERE id={$_POST['id']}";

  if (mysqli_query($conn, $sql)) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . mysqli_error($conn);
  }

  mysqli_close($conn);
}



// Add Guest
if(isset($_POST['addguest'])) {




  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  function scrub($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$firstname = scrub($_POST['firstname']);
$lastname = scrub($_POST['lastname']);
$email = scrub($_POST['email']);



  $sql = "INSERT INTO MyGuests (firstname, lastname, email)
  VALUES ('{$firstname}',
    '{$lastname}', '{$email}')";

  if (mysqli_query($conn, $sql)) {
      echo "New record created successfully <br>";
      echo 'thanks for submitting ';
    echo $_POST['firstname'];
    echo ' ';
    echo $_POST['lastname'];
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);


}
?>

<?
//Edit
if(isset($_POST['editthis'])) {
echo '<div style="background-color:yellow;">You are trying to edit
'.$_POST['id'].''.$_POST['firstname'].''.$_POST['lastname'].''.$_POST['email']."</div>";
}
?>

<h1>Please Register</h1>
<? if(isset($_POST['editthis'])) { ?>

  <form action="index.php" method="POST">
    <input type="hidden" name="id"
    value="<?=$_POST['id']?>">
    First name:<br>
    <input type="text" name="firstname"
    value="<?=$_POST['firstname']?>"><br>
    Last name:<br>
    <input type="text" name="lastname"
    value="<?=$_POST['lastname']?>"><br>
     Email:<br>
    <input type="email" name="email" placeholder="Must be a valid Email" value="<?=$_POST['email']?>"><br><br>
    <input type="submit" name="updateguest" value="Update"
    ><br>
  </form>

<? } else { ?>

  <form action="index.php" method="POST">
    First name:<br>
    <input type="text" name="firstname"><br>
    Last name:<br>
    <input type="text" name="lastname"><br>
     Email:<br>
    <input type="email" name="email" placeholder="Must be a valid Email"><br><br>
    <input type="submit" name="addguest" value="Submit">
  </form>
<? } ?>

<br>
<h1>Guest List</h1>
<br>
  <?php



  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }




  // READING the Data
$sql = "SELECT id, firstname, lastname, email FROM MyGuests";
$result = mysqli_query($conn, $sql);
?>

<table class="table table-striped table-hover">

<?
if (mysqli_num_rows($result) > 0) {
     // output data of each row

     while($row = mysqli_fetch_assoc($result)) {
?>
<tr>
<td>
  <?=$row["firstname"]?>
</td><td>
  <?=$row["lastname"]?>
</td><td>
  <?=$row["email"]?>
</td>
<td>Guest ID:

  <form action="index.php" method="POST">
    <input type="hidden" name="id" value="<?=$row['id']?>">
    <input type="submit" name="deletethis" value="Delete">
  </form>

  <form action="index.php" method="POST">
    <input type="hidden" name="firstname" value="<?=$row['firstname']?>">
    <input type="hidden" name="lastname" value="<?=$row['lastname']?>">
    <input type="hidden" name="email" value="<?=$row['email']?>">
    <input type="hidden" name="id" value="<?=$row['id']?>">
    <input type="submit" name="editthis" value="Edit">
  </form>

</td>
</tr>
<?
     }
} else {
     echo "0 results";
}
echo '</table>';
mysqli_close($conn);
?>
<!-- /Guest List -->

</div>
</div>
</div>
</body>
</html>
