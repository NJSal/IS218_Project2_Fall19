<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require('../ModelPDO/pdo.php');
require('../ModelPDO/pdomethods.php');

$name = filter_input(INPUT_POST, 'name');
$about = filter_input(INPUT_POST, 'about');
$skills = filter_input(INPUT_POST, 'skills');
$userId = filter_input(INPUT_GET,"userId");




$name = (isset($name)) ? $name : '';
$about = (isset($about)) ? $about : '';
$skills = (isset($skills)) ? $skills : '';

$namelength = strlen($name);
if($namelength < 3) {echo "<br>Error in Name Field: invalid name length: ".$name." is not at least 3 characters long<br>";}
if(empty($name)) {print "<br>Error in Name Field: you must enter your name<br>";}

$aboutlength = strlen($about);
if($aboutlength > 500) {print "<br>Error in About Field: the number of words you entered is > 500<br>"; /*exit();*/}
if(empty($about)) {print "<br>Error in About Field: you the the second field empty<br>";}

$skillset = explode(',' , $skills);
$skillselected = count($skillset);
if($skillselected < 2) {print "<br>Error in Skills Field: please write down at least two skills<br>";}


/*
$queryA = 'SELECT title, body FROM questions WHERE email = :email AND password = :password';
*/
/*
$queryA = 'SELECT body FROM questions WHERE email = :email AND password = :password'; //experimental

//$body = $queryA;

$statement = $db->prepare($queryA);
$statement->bindValue(':email', $email);
$statement->bindValue(':password', $password);

$statement->execute();
//$values= $statement->fetchAll();

$statement->closeCursor();
*/
$owneridvalue = filter_input(INPUT_POST, '');


$query = 'SELECT ownermail FROM questions WHERE title = :title name AND body = :body ';
$statement = $db->prepare($query);
$statement->bindValue(':title', $name);
$statement->bindValue(':body', $about);
$statement->execute();
/*
 *
$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$birthday = filter_input(INPUT_POST, 'birthday');
$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
 *
 *
 *
 *
 *
echo "First Name: $firstname <br>";
echo "Last Name: $lastname <br>";
echo "Email: $email<br>";
*/
$questions= $statement->fetchAll();



//$questions= $statement->fetch();


//$questionsvalue = $questions['body'];


$email = $questions['owneremail'];






$title = $name;
$body = $about;

$query = 'INSERT INTO questions
          (ownerid, skills, body, title)
          VALUES
          (:ownerid, :skills, :body, :title)';

$statement = $db->prepare($query);
$statement->bindValue(':ownerid', $email);
$statement->bindValue(':skills', $skills);
$statement->bindValue(':body', $body);
$statement->bindValue(':title', $title);
$statement->execute();
//$questions= $statement->fetch();


/*
$questions = questions['body'];                     *******most likely NOT needed
$owneridvalue = questions['ownerid'];
*/

$statement->closeCursor();


/*
if(count($values)>0){

header("Location: displayquestion.php?fname=$firstname&lastname=$lastname&email=$email");       //made everything work
}
*/
header("Location: ../LoginForm/displayquestion.php?ownerid=$owneridvalue");


?>
<!DOCTYPE html>
<html>
<head>
    <title> Question Form </title>
    <link rel = "stylesheet" type = "text/css" href = "form.css">
</head>

<body>
<main>
    <h1> Question Form </h1>

    <label> Question 1. Name:</label>
    <span><?php echo htmlspecialchars($name);?></span>
    <br>

    <label> Question 2. About You:</label>
    <span><?php echo htmlspecialchars($about);?></span>
    <br>

    <label> Skills (comma separated):</label>
    <span><?php echo htmlspecialchars($skills);?></span>
    <br>

    <input type="hidden" name="userId" value="<php echo $userId; ?>">

</main>
</body>
</html>
