<?php

namespace App\Notifications;

use App\Models\TravelRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TravelStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(public TravelRequest $travelRequest) {}

    public function via($notifiable)
    {
        return ['mail']; // você pode adaptar para 'database' ou outro
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Atualização no seu pedido de viagem')
            ->line("Seu pedido para {$this->travelRequest->destination} foi {$this->travelRequest->status}.");
    }
}
