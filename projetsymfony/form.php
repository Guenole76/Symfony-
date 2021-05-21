<?php
if(isset($_POST['submit'])){
$hostname='localhost';
$username='root';
$password='';
 
try {
$dbh = new PDO("mysql:host=$hostname;dbname=form",$username,$password);
 
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
$sql = "INSERT INTO formu (nom, prenom, email, date, friteoupate, sauce, typedepate)
VALUES ('".$_POST['nom']."','".$_POST['prenom']."','".$_POST['email']."','".$_POST['date']."','".$_POST['frite']."','".$_POST['sauce']."','".$_POST['choixpate']."')";
if ($dbh->query($sql)) {
echo "<script type= 'text/javascript'>alert('New Record Inserted Successfully');</script>";
}
else{
echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
}
print_r($dbh->errorInfo());

$dbh = null;
}
catch(PDOException $e)
{
echo $e->getMessage();
}
 
}

?>