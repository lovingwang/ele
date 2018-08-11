<?php

namespace App\Mail;
use App\Models\EventPrize;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PrizeShipped extends Mailable
{
    use Queueable, SerializesModels;



    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $prize;
    public function __construct(EventPrize $prize)
    {
//        从外面的到
           $this->prize=$prize;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from("15320239465@163.com")
            ->view('admin.mail.prize',['prize'=>$this->prize]);
    }
}
