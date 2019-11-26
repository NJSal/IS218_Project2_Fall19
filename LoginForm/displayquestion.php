<?php
require('../ModelPDO/pdo.php');
require('../ModelPDO/pdomethods.php');

$firstname = filter_input(INPUT_GET, 'fname');
$lastname = filter_input(INPUT_GET, 'lname');
$email = filter_input(INPUT_GET, 'email');
$userId = filter_input(INPUT_GET, 'id');

$firstname= (isset($firstname)) ? $firstname : '';
$lastname = (isset($lastname)) ? $lastname : '';
$email = (isset($email)) ? $email : '';
$userId = filter_input(INPUT_GET, 'id');


echo "First Name: $firstname <br>";
echo "Last Name: $lastname <br>";
echo "Email: $email<br>";

/*
$idselect = filter_input(INPUT_GET, 'ownerid');
*/

/*
$query = 'SELECT body FROM questions WHERE email = :email AND $ownerid = :ownerid';     //****MOST LIKELY NOT NEEDED****
$statement = $db->prepare($query);
$statement->bindValue(':email', $email);
$statement->bindValue(':ownerid', $ownerid);
$statement->execute();
*/
/*
echo "First Name: $firstname <br>";
echo "Last Name: $lastname <br>";
echo "Email: $email<br>";

$values= $statement->fetchAll();


$owneridvalue = $values['ownerid'];
*/


//$statement->closeCursor();
/*
$query = 'SELECT title, body from questions WHERE email = :email and password = :password';
$statement = $db->prepare($query);
$statement->bindValue(':email', $email);
$statement->bindValue(':password', $password);
$statement->execute();
$values= $statement->fetchAll();
$statement->closeCursor();
*/
//header("Location: ../QuestionForm/questionform.html?ownerid=$owneridvalue");

?>
<!DOCTYPE html>
<html>

<?php
//echo get_username($userId);
$questions = get_questions($userId, $email);
?>


<table class="table">
    <tr>
        <th scope = "col">Email</th>
        <th scope = "col">Id</th>
        <th scope = "col">Title</th>
        <th scope = "col">Body</th>
        <th scope = "col">Skills</th>

    </tr>
    <?php foreach ($questions as $question) : ?>
        <tr scope = "row">
            <td><?php echo $question['owneremail']; ?></td>
            <td><?php echo $question['ownerid']; ?></td>
            <td><?php echo $question['title']; ?></td>
            <td><?php echo $question['body']; ?></td>
            <td><?php echo $question['skills']; ?></td>

        </tr>
    <?php endforeach; ?>
</table>



<a href = "../QuestionForm/questionform.php?" user=<?php echo $userId; ?>><button>Add Question</button></a>


</html>

