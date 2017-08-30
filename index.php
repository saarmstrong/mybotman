<?php 

require 'vendor/autoload.php';

use Mpociot\BotMan\BotManFactory;
use React\EventLoop\Factory;

class ExampleConversation extends Mpociot\BotMan\Conversation
{
    protected $firstname;
    
    protected $email;

    public function askFirstname()
    {
        $this->ask('Howdy! What is your first name?', function($answer) {
            // Save result
            $this->firstname = $answer->getText();

            $this->say('Nice to meet you '.$this->firstname);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('What is your email?', function($answer) {
            // Save result
            $this->email = $answer->getText();

            $this->say('Thanks! Heres your info: \n\n' . $this->firstname . '<' . $this->email . '>');
        });
    }

    public function run()
    {
        // This will be called immediately
        $this->askFirstname();
    }
}

$slackToken = getenv('ENV_SLACK_TOKEN');

/*
if(empty($slackToken)) {
    $slackToken = 'xoxb-233018990546-Su4ECTxM9y9Y5tjyau5h9krZ';
}
*/

$loop = Factory::create();
$botman = BotManFactory::createForRTM([
    'slack_token' => $slackToken
], $loop);

$botman->hears('hello botman', function($bot) {
    $bot->startConversation(new ExampleConversation(), SlackDriver::class);
});

$loop->run();
