<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfPath;
    public $reportNumber;

    public function __construct($pdfPath, $reportNumber)
    {
        $this->pdfPath = $pdfPath;
        $this->reportNumber = $reportNumber;
    }

    public function build()
    {
        return $this->subject('Servisný protokol č. ' . $this->reportNumber)
            ->view('emails.reportMail')
            ->attach($this->pdfPath, [
                'as' => 'report_' . $this->reportNumber . '.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
