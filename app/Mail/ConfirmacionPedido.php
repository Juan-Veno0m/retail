<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmacionPedido extends Notification
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
      $url = url('/Cuenta/MisPedidos/'.$this->event['OrdenID']);
      return (new MailMessage)
        ->subject('Pedido No.'.$this->event['OrdenID'].' realizado en Yolkan')
        ->line('Recibimos tu pedido y estamos trabajando en ello, puedes consultar los detalles..')
        ->action('Detalles del pedido', $url)
        ->line('Cualquier duda quedamos a tus ordenes.');
    }
}
