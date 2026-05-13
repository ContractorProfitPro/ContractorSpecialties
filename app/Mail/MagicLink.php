<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\HtmlString;

class MagicLink extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Contractor Specialties Login Link',
        );
    }

    public function content(): Content
    {
        $url = url('/verify-magic-link/' . $this->token);
        
        // A clean, simple HTML email utilizing your brand colors
        return new Content(
            htmlString: new HtmlString("
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;'>
                    <h2 style='color: #021d48;'>Contractor Specialties</h2>
                    <p style='color: #4A4E55; font-size: 16px;'>Click the button below to instantly log in to your dashboard. No password required.</p>
                    <a href='{$url}' style='display: inline-block; padding: 12px 24px; background-color: #F15A29; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 15px;'>Log In Now</a>
                    <p style='color: #9ca3af; font-size: 12px; margin-top: 30px;'>If you didn't request this link, you can safely ignore this email.</p>
                </div>
            ")
        );
    }
}