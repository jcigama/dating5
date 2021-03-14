<?php

/**
 * Class DataLayer
 */
class DataLayer
{
    /**
     * @var
     */
    private $_dbh;

    /**
     * DataLayer constructor.
     * @param $dbh
     */
    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * Inserts new members into member database.
     * @param $member
     */
    function insertMember($member)
    {
        $sql = "INSERT INTO member(fName, lName, age, gender, phone, email, state, seeking, bio, interests, isMember)
                   VALUES (:fName, :lName, :age, :gender, :phone, :email, :state, :seeking, :bio, :interests, :isMember)";

        //prepare the statement
        $statement = $this->_dbh->prepare($sql);

        if($member->isMember() == true) {
            $isMember = 1;
            $interests = "";

            if ($member->getInDoorInterests() != null) {
                $interests .= $member->getInDoorInterests();
            }

            if ($member->getInDoorInterests() != null && $member->getOutDoorInterests() != null) {
                $interests .= ", " . $member->getOutDoorInterests();
            }
            else {
                $interests .= $member->getOutDoorInterests();
            }

            if ($interests == "") {
                $interests = "None";
            }

            //Bind the parameters
            $statement->bindParam(":fName", $member->getFName(), PDO::PARAM_STR);
            $statement->bindParam(":lName", $member->getLName(), PDO::PARAM_STR);
            $statement->bindParam(":age", $member->getAge(), PDO::PARAM_INT);
            $statement->bindParam(":gender", $member->getGender(), PDO::PARAM_STR);
            $statement->bindParam(":phone", $member->getPhone(), PDO::PARAM_STR);
            $statement->bindParam(":email", $member->getEmail(), PDO::PARAM_STR);
            $statement->bindParam(":state", $member->getState(), PDO::PARAM_STR);
            $statement->bindParam(":seeking", $member->getSeeking(), PDO::PARAM_STR);
            $statement->bindParam(":bio", $member->getBio(), PDO::PARAM_STR);
            $statement->bindParam(":interests", $interests, PDO::PARAM_STR);
            $statement->bindParam(":isMember", $isMember, PDO::PARAM_BOOL);
        } else {
            $isMember = 0;
            $interests = "N/A";

            //Bind the parameters
            $statement->bindParam(":fName", $member->getFName(), PDO::PARAM_STR);
            $statement->bindParam(":lName", $member->getLName(), PDO::PARAM_STR);
            $statement->bindParam(":age", $member->getAge(), PDO::PARAM_INT);
            $statement->bindParam(":gender", $member->getGender(), PDO::PARAM_STR);
            $statement->bindParam(":phone", $member->getPhone(), PDO::PARAM_STR);
            $statement->bindParam(":email", $member->getEmail(), PDO::PARAM_STR);
            $statement->bindParam(":state", $member->getState(), PDO::PARAM_STR);
            $statement->bindParam(":seeking", $member->getSeeking(), PDO::PARAM_STR);
            $statement->bindParam(":bio", $member->getBio(), PDO::PARAM_STR);
            $statement->bindParam(":interests", $interests, PDO::PARAM_STR);
            $statement->bindParam(":isMember", $isMember, PDO::PARAM_BOOL);
        }

        //execute
        $statement->execute();
    }

    /**
     * Retrieves all rows from database.
     * @return mixed
     */
    function getMembers()
    {
        $sql = "SELECT * FROM member ORDER BY userNum ASC";

        $statement = $this->_dbh->prepare($sql);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Retrieves specified row based off member ID from database.
     * @param $member_id
     * @return mixed
     */
    function getMember($member_id)
    {
        $sql = "SELECT * FROM member WHERE userNum = $member_id";

        $statement = $this->_dbh->prepare($sql);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Retrieves specified member's interest(s) by referencing member ID from database.
     * @param $member_id
     * @return mixed
     */
    function getInterests($member_id)
    {
        $sql = "SELECT interests FROM member WHERE userNum = $member_id";

        $statement = $this->_dbh->prepare($sql);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Valid indoor activities
     * @return string[]
     */
    function getIndoor()
    {
        return array("tv", "puzzles", "movies", "reading", "cooking",
            "playing cards", "board games", "video games");
    }

    /**
     * Valid outdoor activities
     * @return string[]
     */
    function getOutdoor()
    {
        return array("hiking", "biking", "swimming", "collecting",
            "walking", "climbing");
    }
}
