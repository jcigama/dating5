<?php

class DataLayer
{
    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    function insertMember()
    {
        $sql = "INSERT INTO budget(fName, lName, age, gender, phone, email, state, seeking, bio, interests)
                   VALUES (:fName, :lName, :age, :gender, :phone, :email, :state, :seeking, :bio, :interests)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Bind the parameters
        $statement->bindParam(":fName", $member->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":lName", $member->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":age", $member->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":gender", $member->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":phone", $member->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":email", $member->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":state", $member->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":seeking", $member->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":bio", $member->getUserName(), PDO::PARAM_STR);
        $statement->bindParam(":interests", $member->getUserName(), PDO::PARAM_STR);


        //execute
        $statement->execute();
    }

//    function getMembers()
//    {
//
//    }
//
//    function getMember(member_id)
//    {
//
//    }
//
//    function getInterests(member_id)
//    {
//
//    }

    function getIndoor()
    {
        return array("tv", "puzzles", "movies", "reading", "cooking",
            "playing cards", "board games", "video games");
    }

    function getOutdoor()
    {
        return array("hiking", "biking", "swimming", "collecting",
            "walking", "climbing");
    }
}
