<?php

abstract class User
{
    private int $userId;
    private string $email;
    private string $fName;
    private string $lName;
    private string $district;
    private string $city;
    private int $userTypeId;

    private $profilePic;
    private int $rating;
    protected DBConn $dbCon;

    public function __contruct(string $userId, DBConn $db){
        $this->userId = $userId;
        $this->dbCon = $db;
        $qry = $this->dbCon->getPDO()->prepare("SELECT * FROM `User` WHERE id=:uid");
        $qry->execute(array(':uid'=>$userId));
        $row = $qry->fetch(PDO::FETCH_ASSOC);
        $this->email=$row['email'];
        $this->fName=$row['first_name'];
        $this->lName=$row['last_name'];
        $this->district=$row['district'];
        $this->city=$row['city'];
        $this->rating=$row['rating'];
        $this->userTypeId = $row['usertype_id'];
//        $this->profilePic=$row['profile_picture'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $qry = $this->dbCon->getPDO()->prepare("UPDATE `User` SET email:=phld WHERE id=:uid");
        $qry->execute(array(
            ':phld'=>$email,
            ':uid'=>$this->userId));
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFName(): string
    {
        return $this->fName;
    }

    /**
     * @param string $fName
     */
    public function setFName(string $fName): void
    {
        $qry = $this->dbCon->getPDO()->prepare("UPDATE `User` SET first_name:=phld WHERE id=:uid");
        $qry->execute(array(
            ':phld'=>$fName,
            ':uid'=>$this->userId));
        $this->fName = $fName;
    }

    /**
     * @return string
     */
    public function getLName(): string
    {
        return $this->lName;
    }

    /**
     * @param string $lName
     */
    public function setLName(string $lName): void
    {
        $qry = $this->dbCon->getPDO()->prepare("UPDATE `User` SET last_name:=phld WHERE id=:uid");
        $qry->execute(array(
            ':phld'=>$lName,
            ':uid'=>$this->userId));
        $this->lName = $lName;
    }

    /**
     * @return string
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @param string $district
     */
    public function setDistrict(string $district): void
    {
        $qry = $this->dbCon->getPDO()->prepare("UPDATE `User` SET district:=phld WHERE id=:uid");
        $qry->execute(array(
            ':phld'=>$district,
            ':uid'=>$this->userId));
        $this->district = $district;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $qry = $this->dbCon->getPDO()->prepare("UPDATE `User` SET city:=phld WHERE id=:uid");
        $qry->execute(array(
            ':phld'=>$city,
            ':uid'=>$this->userId));
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getUserTypeId(): int
    {
        return $this->userTypeId;
    }

    /**
     * @return mixed
     */
    public function getProfilePic()
    {
//        return $this->profilePic;
    }

    /**
     * @param mixed $profilePic
     */
    public function setProfilePic($profilePic): void
    {
//        $this->profilePic = $profilePic;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $qry = $this->dbCon->getPDO()->prepare("UPDATE `User` SET rating:=phld WHERE id=:uid");
        $qry->execute(array(
            ':phld'=>$rating,
            ':uid'=>$this->userId));
        $this->rating = $rating;
    }


}