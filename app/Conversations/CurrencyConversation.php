<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Classes\Currency;

class CurrencyConversation extends Conversation
{
    protected $firstname;

    public function askName() {
        $this->ask('Hello! What is your name?', function(Answer $answer){
            // save result
            $this->firstname = $answer->getText();
            $this->say('Nice to meet you ' . $this->firstname);
            $this->askCurrency();
        });
    }

    public function askCurrency() {
        $this->ask('What currency do you want to see the exchange rate ?', function(Answer $answer, $currency){
            // save result
            $this->bot->typesAndWaits(2);
            $choosenCurrency = trim($answer->getText());
            $results = Currency::getCurrency($choosenCurrency);
            $this->say($results);
        });
    }

    public function run() {
        // This will be called immediately
        $this->askName();
    }
}
