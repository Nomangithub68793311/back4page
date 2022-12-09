<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\PasswordMail;
use Illuminate\Support\Facades\Mail;


class PasswordRestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     public $email;
     public $code;
    public function __construct($email,$code)
    {
        $this->email=$email;  
        $this->code=$code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            Mail::to($this->email)->send(new PasswordMail($this->code));
            return "sent";
        }
        catch(Exception $e){
            return "not sent";
    
        }
    }
}
