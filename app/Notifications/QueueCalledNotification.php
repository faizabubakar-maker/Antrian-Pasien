<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class QueueCalledNotification extends Notification
{
    use Queueable;

    public $antrian;

    public function __construct($antrian)
    {
        $this->antrian = $antrian;
    }

    // Kita gunakan database notification
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Nomor antrian Anda ({$this->antrian->nomor_antrian}) untuk dokter {$this->antrian->dokter->name} dipanggil!",
            'dokter' => $this->antrian->dokter->name,
            'tanggal_kunjungan' => $this->antrian->tanggal_kunjungan,
            'antrian_id' => $this->antrian->id,
        ];
    }
}