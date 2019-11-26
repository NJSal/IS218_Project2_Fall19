<?php
function get_questions($userid,$email)
{

    global $db;
    $query = 'SELECT * FROM questions WHERE ownerid = :id AND owneremail = :email'; //experimental


    $statement = $db->prepare($query);
    $statement->bindValue(':id', $userid);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $accountquestion = $statement->fetchAll();
    $statement->closeCursor();

    return $accountquestion;



}
?>