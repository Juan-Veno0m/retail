<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Bienvenido extends Notification
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
      $nombre = $this->event['empresario']->Nombre.' '.$this->event['empresario']->ApellidoPaterno;
      return (new MailMessage)
        ->subject('Bienvenido '.$nombre.' a Yolkan')
        ->greeting('!Hola, '. $nombre .'!')
        ->line('!Gracias por unirte a Yolkan! Aqui tienes la información de tu cuenta: ')
        ->line('No.Empresario: '.$this->event['empresario']->NoEmpresario)
        ->line('Contraseña: '.$this->event['password'])
        ->line('Recuerda que tienes un cupón de descuento por $1,500 pesos, válido en tu primer compra.')
        ->action('Iniciar sesión', url('/login'));
    }
}
