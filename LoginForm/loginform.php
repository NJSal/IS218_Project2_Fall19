<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('../ModelPDO/pdo.php');
require('../ModelPDO/pdomethods.php');

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$email = (isset($email)) ? $email : '';

$password = (isset($password)) ? $password : '';

$j = strpos($email, '@');
if($j == false){print "<br> no @ characters found<br>";}
if(empty($email)) {print "<br>Error in Email Field: you must enter your email<br>";}


$plen = strlen($password);
if($plen < 8) {echo "<br>Error in Password Field: invalid password length: ".$password." is not at least 8 characters long<br>";}
if(empty($password)) {print "<br>Error in Password Field: you must enter your password<br>";}


$query = 'SELECT id, fname, lname FROM accountsIS218 WHERE email = :email AND password = :password'; //experimental

$statement = $db->prepare($query);
$statement->bindValue(':email', $email);
$statement->bindValue(':password', $password);
$statement->execute();
$accountsIS218 = $statement->fetch();
$statement->closeCursor();

$idvalue = $accountsIS218['id'];
$fnamevalue = $accountsIS218['fname'];
$lnamevalue = $accountsIS218['lname'];
//$statement->closeCursor();


if(count($accountsIS218)>0){

    header("Location: displayquestion.php?email=$email&id=$idvalue&fname=$fnamevalue&lname=$lnamevalue");
}

if(count($accountsIS218) == 0 OR (($email == NULL) AND ($password == NULL))){
    header("Location: ../Registrationform/registrationform.html");
}


?>


<!DOCTYPE html>
<html lang = "en">

<label>First Name: </label>
<span><?php echo htmlspecialchars($firstname); ?></span>
<br>

<label>Last Name: </label>
<span><?php echo htmlspecialchars($lastname); ?></span>
<br>


<label>Email: </label>
<span><?php echo htmlspecialchars($email); ?></span>
<br>
<label>Password: </label>
<span><?php echo htmlspecialchars($password); ?></span>
<br>

</html>
