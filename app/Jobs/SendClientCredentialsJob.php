<?php

namespace App\Jobs;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use App;

class SendClientCredentialsJob extends Job implements ShouldQueue

{
    use InteractsWithQueue, SerializesModels;

    private $user;
    private $password;
    private $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $password, $email) {
        $this->user 	= $user;
        $this->password = $password;
        $this->email  = $email;
        App::setLocale('it');
    }

    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer) {

        $mailer->send('email.userInfo', [
            'user' 	        => $this->user,
            'password' 	    => $this->password,
            'customMessage' => config('assurances.customMessage'),
            'email'         => $this->email,
        ], function(Message $message){
            $app = config('assurances.name');
           
            $message->to($this->email)->subject($app. " : password")
            ->from(config("assurances.contcat_info.contact_us_email"));
        });
    }
}
