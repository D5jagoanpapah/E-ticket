<?php

namespace App\Notifications;

use App\Models\Pemesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Contracts\Queue\ShouldQueue;


class PemesananUpdated extends Notification
{
    use Queueable;

    protected $pemesanan;

    public function __construct($pemesanan)
    {
        $this->pemesanan = $pemesanan;
    }

    public function via($notifiable)
    {
        return ['database']; // Gunakan saluran database
    }

    public function toDatabase($notifiable)
    {
        return [
            'pemesanan_id' => $this->pemesanan->id,
            'status' => $this->pemesanan->status_pemesanan,
            'created_at' => now(),
        ];
    }
}

