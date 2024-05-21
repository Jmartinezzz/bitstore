<?php
namespace App\Traits;

trait Bot
{
    public function sendInteraction($msg)
    {
        try {
            $botToken="1155339999:AAGBYb3Pu9dpScI5JxK-AyJLACOKmaZbD1c";
            $website="https://api.telegram.org/bot".$botToken;

            $tex=urlencode($msg);
            file_get_contents($website."/sendmessage?chat_id=768944027&text=$tex");
        } catch (\Throwable $e) {
            \Log::error($e);
        }
    }
}