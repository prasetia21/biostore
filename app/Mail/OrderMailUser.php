<?php

namespace App\Mail;

use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMailUser extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $order = $this->data;
        $orderItem = OrderItem::where('order_ninja_id', $order['order_ninja_id'])->get();
        
        return $this->from('projek.dev@gmail.com')->view('mail.order_mail_user',compact('order', 'orderItem'))->subject('Pemesanan dari Biovarnish Store');
    }
}
