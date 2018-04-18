<?php
/**
 * Created by PhpStorm.
 * User: gamig
 * Date: 4/18/2018
 * Time: 11:10 AM
 */

namespace model;


class Tweet implements \JsonSerializable
{

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    private $tweetId;
    private $userId;
    private $date;
    private $content;

    /**
     * Tweet constructor.
     * @param $tweetId
     * @param $userId
     * @param $date
     * @param $content
     */
    public function __construct($tweetId = null, $userId, $date = null, $content)
    {
        $this->tweetId = $tweetId;
        $this->userId = $userId;
        $this->date = $date;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getTweetId()
    {
        return $this->tweetId;
    }

    /**
     * @param mixed $tweetId
     */
    public function setTweetId($tweetId)
    {
        $this->tweetId = $tweetId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


}