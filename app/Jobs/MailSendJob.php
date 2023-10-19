<?php

namespace App\Jobs;

use App\Mail\EmailShipped;
use App\Models\Email;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $request;
    public function __construct($user, $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Config::set('mail.mailers.smtp', [
            'transport' => 'smtp',
            'host' => $this->user['user_mailer']['mail_host'],
            'port' => $this->user['user_mailer']['mail_port'],
            'encryption' => $this->user['user_mailer']['mail_encryption'],
            'username' => $this->user['user_mailer']['mail_username'],
            'password' => $this->user['user_mailer']['mail_password'],
            'timeout' => null,
        ]);
        
        foreach ($this->request['to_email'] as $email_id) {

            try{
                $email = Email::find($email_id);
            Mail::to($email->email)->queue(new EmailShipped($email, $this->request['subject_email'], $this->request['email_text'], $this->user['user_mailer']['mail_username'], $this->user['name']));
            } catch(Exception $e) {
                Log::error('Не удалось отправить электронное письмо. Ошибка: ' . $e->getMessage());
            }


        }

        Config::set('mail.mailers.smtp', [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST'),
            'port' => env('MAIL_PORT'),
            'encryption' => env('MAIL_ENCRYPTION'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
        ]);
        Config::set('mail.from', [
            'address' => env('MAIL_USERNAME'),
        ]);
    }
}
