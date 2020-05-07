<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;

class OnboardingConversation extends Conversation
{
    protected $firstname;
    protected $email;

    public function askFirstName() {
        $this->ask('Hello! What is your firstname?', function(Answer $answer){
            // save result
            $this->firstname = $answer->getText();
            $this->say('Nice to meet you ' . $this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail() {
        $this->ask('One more thing - what is your email?', function(Answer $answer){
            // save result
            $this->email = $answer->getText();
            $this->say('Great - that is all we need, ' . $this->firstname);
        });
    }

    public function run() {
        // This will be called immediately
        $this->askFirstName();
    }
}
