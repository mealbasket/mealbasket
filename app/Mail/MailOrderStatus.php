<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;

class MailOrderStatus extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->order->status_id == 4)
            return $this->subject('Your payment has been received')->markdown('emails.orders.payment')->with('order', $this->order);
        if($this->order->status_id == 5)
            return $this->subject('Your order has been shipped')->markdown('emails.orders.shipped')->with('order', $this->order);
        if($this->order->status_id == 6)
            return $this->subject('Your order has been delivered')->markdown('emails.orders.delivered')->with('order', $this->order);

    }
}
