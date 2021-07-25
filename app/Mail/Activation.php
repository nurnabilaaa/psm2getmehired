<?php

namespace App\Mail;

use App\Libs\App;
use App\Models\SYSSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Activation extends Mailable
{

    use Queueable, SerializesModels;
    use App;

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
        $mailFromEmail = $this->getDbConfig('email_from') == null ? 'a.fattah@ymail.com' : $this->getDbConfig('email_from');
        $mailFromName  = $this->getDbConfig('email_name') == null ? 'Smart Clinic' : $this->getDbConfig('email_name');

        return $this->from($mailFromEmail, $mailFromName)
                    ->subject('[Smart Clinic MPK] Aktifkan akaun anda')
                    ->view('email.user_activation')
                    ->with([
                               'name' => $this->data['name'],
                               'username' => $this->data['username'],
                               'password' => $this->data['password'],
                               'url' => $this->data['url'],
                               'expired' => $this->data['expired'],
                           ]);
    }
}
