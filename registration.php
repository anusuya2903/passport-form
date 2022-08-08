<?php
	$name = $_POST['name'];
	$dob = $_POST['dob'];
	$email = $_POST['email'];
	$phnno = $_POST['phnno'];
	$adcno = $_POST['adcno'];
	$rtnno = $_POST['rtnno'];
	$gender = $_POST['gender'];
  
  if (!empty($name) || !empty($dob) || !empty($email) || !empty($phnno) || !empty($adcno) || !empty($rtnno) || !empty($gender) )
{

$host = "localhost";
$dbusername = "id17937056_passportdb";
$dbpassword = "Anupassport-3";
$dbname = "id17937056_passport";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From registration Where email = ? Limit 1";
  $INSERT = "INSERT Into registration (name , dob , email , phnno, adcno , rtnno ,gender )values(?,?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssiiis", $name ,$dob ,$email ,$phnno, $adcno ,$rtnno ,$gender);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>