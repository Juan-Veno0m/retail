<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Contacto extends Notification
{
    use Queueable;
    protected $event;
    public function __construct($event)
    {
        $this->event = $event;
    }
    public function via($notifiable)
    {
        return ['mail'];
    }
    public function toMail($notifiable)
    {
      return (new MailMessage)
        ->subject('Contacto para departamento de: '.$this->event['asunto'])
        ->line('Nombre: '.$this->event['nombre'])
        ->line('Correo: '.$this->event['correo'])
        ->line('Teléfono: '.$this->event['telefono'])
        ->line('Mensaje: '.$this->event['mensaje'])
        ->line('== Formulario de Contacto ==');
    }
}
