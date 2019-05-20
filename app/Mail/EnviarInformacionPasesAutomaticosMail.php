<?php

namespace ExamenEducacionMedia\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarInformacionPasesAutomaticosMail extends Mailable
{
    use Queueable, SerializesModels;
    private $totalAspirantes;
    private $generados;
    /**
     * @var array
     */
    private $planteles;

    /**
     * Create a new message instance.
     *
     * @param $totalAspirantes
     * @param $generados
     * @param array $planteles
     */
    public function __construct($totalAspirantes, $generados, $planteles = [])
    {
        //
        $this->totalAspirantes = $totalAspirantes;
        $this->generados       = $generados;
        $this->planteles       = $planteles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $planteles = collect($this->planteles)->unique();

        return $this->view('emails.info_pases_automaticos', [
            'totalAspirantes' => $this->totalAspirantes,
            'generados'       => $this->generados,
            'planteles'       => $planteles,
        ]);
    }
}
