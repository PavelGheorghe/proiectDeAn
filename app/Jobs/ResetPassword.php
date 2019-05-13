<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class ResetPassword extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;


    private $email;
    private $token;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $token){
        $this->email    = $email;
        $this->token    = $token;
    }



    public function handle(Mailer $mailer){

        $mailer->send('email.restore-password', [
             'link'          => url('/').'/new-password/'.$this->token,
           
        ], function(Message $message){
            $message->to($this->email)
                    ->subject('Reset Password')
                    ->from('oneest@oneest.com');
        });

    }
}
