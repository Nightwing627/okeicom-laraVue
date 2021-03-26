<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $viewStr = 'to')
    {
        $this->content = $content;
        $this->viewStr = $viewStr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this
        //     ->view('emails.contact')
        //     ->subject('お問い合わせ完了【おけいcom】')
        //     ->with([
        //         'orderName' => $this->contact->name,
        //     ]);

        return $this->text('emails.'.$this->viewStr)
            ->to($this->content['to'], $this->content['to_name'])
            ->from($this->content['from'], $this->content['from_name'])
            ->subject($this->content['subject'])
            ->with([
                'content' => $this->content['body'],
                'image' => $this->content['image'],
            ]);
    }
}
