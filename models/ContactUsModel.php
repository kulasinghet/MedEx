<?php

namespace app\models;

use app\core\Database;
use app\core\Logger;

class ContactUsModel extends Model
{
    public string $inquiry_id;
    public string $username;
    public string $subject;
    public string $message;

    /**
     * @return string
     */
    public function getInquiryId(): string
    {
        return $this->inquiry_id;
    }

    /**
     * @param string $inquiry_id
     */
    public function setInquiryId(string $inquiry_id): void
    {
        $this->inquiry_id = $inquiry_id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function insertInquiry(): bool
    {
        $this->setInquiryId($this->createRandomID('contact_us'));

        $db = (new Database())->getConnection();
        ;
        $sql = "INSERT INTO contact_us (contact_us.inqury_id, contact_us.username, contact_us.subject, contact_us.message) VALUES ('$this->inquiry_id', '$this->username', '$this->subject', '$this->message')";

        Logger::logDebug($sql);

        $stmt = $db->prepare($sql);

        try {

            $stmt->execute();

            if ($stmt->affected_rows == 1) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }

        } catch (\Exception $e) {
            Logger::logError($e->getMessage());
            return false;
        }
    }


}