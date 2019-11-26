<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require('../ModelPDO/pdo.php');
require('../ModelPDO/pdomethods.php');


//include("registrationform.html");

$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$birthday = filter_input(INPUT_POST, 'birthday');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');

$firstname= (isset($firstname)) ? $firstname : '';
$lastname = (isset($lastname)) ? $lastname : '';
$birthday = (isset($birthday)) ? $birthday : '';
$email = (isset($email)) ? $email : '';
$password = (isset($password)) ? $password : '';


/*
$s = "SELECT count(*) FROM 'accountsIS218' WHERE email = '$email' and password = '$password'";
$count = $db->prepare($s);
$count -> execute();
$num_rows = $count ->fetchColumn();
print "'$num_rows'";

echo "number of rows found with credentials: $num_rows<br>";
if($num_rows > 0) {print "the user already exists"; die();}
*/


//*************************************************************************the following code works: but try to work with PDO
/*
$sqli = mysqli_connect($hostname, $username, $password);
$project = "dfs23";
mysqli_select_db($sqli,$project);

$s = "select * from accountsIS218 where email = '$email' and password = '$password'";
(($t = mysqli_query($sqli, $s)) or die(mysqli_error($sqli)));

$num = mysqli_num_rows($t);

if($num > 0){echo"number of rows is greater than 0"; die();}
*/
//***************************************************************************************************************************





$query = 'INSERT INTO accountsIS218 (email, fname, lname, birthday, password)
          VALUES (:email, :fname, :lname, :birthday, :password)';

//Create PDO statement
$statement = $db->prepare($query);

//Bind form values to SQL
$statement->bindValue(':email', $email);
$statement->bindValue(':fname', $firstname);
$statement->bindValue(':lname', $lastname);
$statement->bindValue(':birthday', $birthday);
$statement->bindValue(':password', $password);

//Execute the SQL Query
$statement->execute();

//Close the datab
$statement->closeCursor();

if(empty($firstname)){
    print "<br>Error in Firstname Field: you must enter your firstname<br>";
}

if(empty($lastname)){
    print "<br>Error in Lastname Field: you must enter your lastname<br>";
}

if(empty($birthday)){
    print "<br>Error in Birthday Field: you must enter your birthday<br>";
}

if(empty($email)){
    print "<br>Error in Firstname Field: you must enter your email<br>";
}

$j = strpos($email, '@');
if($j == false){print "<br>Error in Email Field: no @ characters found<br>";}

if(empty($password)){
    print "<br>Error in Firstname Field: you must enter your firstname<br>";
}

$passlen = strlen($password);
if ($passlen < 8) {
    echo "<br>Error in Password Field: invalid password length: " . $password . " is not at least 8 characters long<br>";
}

?>

<?php


$firstname = filter_input(INPUT_POST, 'fname');
$lastname = filter_input(INPUT_POST, 'lname');
$birthday = filter_input(INPUT_POST, 'birthday');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');




header("Location: ../LoginForm/displayquestion.php?fname=$firstname&lname=$lastname&birthday=$birthday&email=$email&password=$password");




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Question Form </title>
    <link rel = "stylesheet" type = "text/css" href = "../form.css">
</head>

<body>
<main>
    <h1> Question Form Answers </h1>

    <label> First Name: </label>
    <span> <?php echo htmlspecialchars($firstname); ?></span>
    <br>

    <label> Last Name: </label>
    <span> <?php echo htmlspecialchars($lastname); ?></span>
    <br>

    <label> Birthday: </label>
    <span> <?php echo htmlspecialchars($birthday); ?></span>
    <br>

    <label> Email: </label>
    <span> <?php echo htmlspecialchars($email); ?></span>
    <br>

    <label> Password: </label>
    <span> <?php echo htmlspecialchars($password); ?></span>
    <br>


</main>
</body>
</html>
