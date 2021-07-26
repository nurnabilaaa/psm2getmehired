<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LostPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailFromEmail = env('MAIL_FROM_ADDRESS');
        $mailFromName = env('MAIL_FROM_NAME');

        return $this->from($mailFromEmail, $mailFromName)
            ->subject('[Getme Hired] Reset Your Password')
            ->view('email.lost_password')
            ->with([
                'name' => $this->data['name'],
                'url' => $this->data['url'],
            ]);
    }
}
