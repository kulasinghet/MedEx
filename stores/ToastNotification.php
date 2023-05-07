<?php

namespace app\stores;
class ToastNotification
{
    private string $subject;
    private string $message;
    private string $type;

    public function __construct(string $subject, string $message, string $type)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->type = $type;
    }

    public function render(): string
    {
        return '<g28-toast subject="' . $this->subject . '" message="' . $this->message . '" status="' . $this->type . '"></g28-toast>';
    }
}