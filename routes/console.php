<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('pembayaran:reminder', function () {
    $service = new App\Services\PaymentReminderService();
    $result = $service->sendDueReminders();

    $this->info(sprintf(
        'Pengingat terkirim: %d berhasil, %d gagal, %d dilewati.',
        $result['sent'],
        $result['failed'],
        $result['skipped']
    ));
})->purpose('Send overdue payment reminders via WhatsApp (Fonnte API)');

// Jadwalkan kirim reminder otomatis setiap hari jam 08.00 pagi
Schedule::command('pembayaran:reminder')->dailyAt('08:00');
