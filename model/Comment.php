<?php
/**
 * Created by PhpStorm.
 * User: gamig
 * Date: 4/18/2018
 * Time: 12:13 PM
 */

namespace model;


class Comment implements \JsonSerializable {

    public function jsonSerialize() {
        return get_object_vars($this);
    }

    private $tweetId;
    private $content;
    private $ownerId;

    /**
     * Comment constructor.
     * @param $tweetId
     * @param $date
     * @param $content
     * @param $ownerId
     */
    public function __construct($tweetId, $content, $ownerId)
    {
        $this->tweetId = $tweetId;
        $this->content = $content;
        $this->ownerId = $ownerId;
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

    /**
     * @return mixed
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * @param mixed $ownerId
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
    }




}