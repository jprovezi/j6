<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class contatoSite extends Mailable
{
    use Queueable, SerializesModels;
    private $emailEnviar;
    private $requestForm;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailEnviar, $requestForm)
    {
        $this->emailEnviar = $emailEnviar;
        $this->requestForm = $requestForm;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dados = $this->requestForm;
        $this->subject('Email de teste');
        $this->to($this->emailEnviar, $this->requestForm);
        return $this->view('templates.inovex.email', [
            'email' => $this->emailEnviar,
            'dados' => $dados,
        ]);
    }
}