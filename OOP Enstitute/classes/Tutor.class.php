<?php
require_once "Session.class.php";
require_once "User.class.php";

class Tutor extends User
{
    private String $description;
    private bool $notAvailable;
    private int $tutorId;

    public function __contruct(string $userId, DBConn $db)
    {
        parent::__contruct($userId, $db);
        $qry = $this->dbCon->getPDO()->prepare("SELECT Tutor.description, Tutor.id, Tutor.availability_flag FROM `User` JOIN tutor ON `User`.id = Tutor.user_id WHERE `User`.id=:uid");
        $qry->execute(array(':uid'=>$userId));
        $row = $qry->fetch(PDO::FETCH_ASSOC);
        $this->description=$row['description'];
        $this->tutorId=$row['id'];
        $this->notAvailable=$row['availability_flag'];
    }

    /**
     * @return String
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription(string $description): void
    {

        $qry = $this->dbCon->getPDO()->prepare("UPDATE `Tutor` SET description:=phld WHERE id=:tid");
        $qry->execute(array(
            ':phld'=>$description,
            ':uid'=>$this->tutorId));
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isNotAvailable(): bool
    {
        return $this->notAvailable;
    }

    /**
     * @param bool $notAvailable
     */
    public function setNotAvailable(bool $notAvailable): void
    {
        if ($notAvailable){
            $val = 1;
        } else {
            $val = 0;
        }
        $qry = $this->dbCon->getPDO()->prepare("UPDATE `Tutor` SET availability_flag:=phld WHERE id=:tid");
        $qry->execute(array(
            ':phld'=>$val,
            ':uid'=>$this->tutorId));
        $this->notAvailable = $notAvailable;
    }

    /**
     * @return int
     */
    public function getTutorId(): int
    {
        return $this->tutorId;
    }



}