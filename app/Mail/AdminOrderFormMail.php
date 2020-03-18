<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminOrderFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;
    public $url;

    public function __construct($user, $order, $url)
    {
        $this->user = $user;
        $this->order = $order;
        $this->url = $url;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order.Admin-order-form');

        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()
                    ->addTextHeader('Custom-Header', 'HeaderValue');
        });
    }
}
