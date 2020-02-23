<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderFormMail extends Mailable
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
        return $this->markdown('emails.order.order-form');
    }
}
