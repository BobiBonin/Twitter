<?php
/**
 * Created by PhpStorm.
 * User: gamig
 * Date: 4/17/2018
 * Time: 10:36 AM
 */

namespace model;


class User implements \JsonSerializable {

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    private $email;
    private $password;
    private $username;
    private $image_url;
    private $cover_url;
    private $city;
    private $description;
    private $id;

    /**
     * User constructor.
     * @param $email
     * @param $password
     * @param $username
     * @param $image_url
     * @param $cover_url
     * @param $city
     * @param $description
     * @param $id
     */
    public function __construct($email, $password = null, $username = null, $image_url = null, $cover_url = null, $city = null, $description = null, $id = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->image_url = $image_url;
        $this->cover_url = $cover_url;
        $this->city = $city;
        $this->description = $description;
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param null $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param null $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return null
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * @param null $image_url
     */
    public function setImageUrl($image_url)
    {
        $this->image_url = $image_url;
    }

    /**
     * @return null
     */
    public function getCoverUrl()
    {
        return $this->cover_url;
    }

    /**
     * @param null $cover_url
     */
    public function setCoverUrl($cover_url)
    {
        $this->cover_url = $cover_url;
    }

    /**
     * @return null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param null $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }




}