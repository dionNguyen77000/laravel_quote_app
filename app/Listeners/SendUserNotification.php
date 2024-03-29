<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuoteCreated  $event
     * @return void
     */
    public function handle(QuoteCreated $event)
    {
        $author = $event->author_name;
        $email = $event->author_email;

        Mail::send('email.user_notification', ['name' => $author], function($message) use($email, $author){
            $message->from('anhduc.nguyen77000@gmail.com', 'Admin');
            $message->to($email, $author);
            $message -> subject('Thank you for your quote');
        });
    }
}
