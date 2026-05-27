<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected string $token;
    protected string $url;

    public function __construct()
    {
        $this->token = config('services.fonnte.token') ?? '';
        $this->url = config('services.fonnte.url') ?? 'https://api.fonnte.com/send';
    }

    public function sendMessage(string $phone, string $message): bool
    {
        $normalizedPhone = preg_replace('/\D+/', '', $phone);

        if (empty($normalizedPhone)) {
            Log::warning('WhatsApp send failed: phone number is empty', [
                'phone' => $phone,
                'message' => $message,
            ]);

            return false;
        }

        if (empty($this->token)) {
            Log::error('WhatsApp send failed: Fonnte API token is not configured');
            return false;
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->token,
            ]);

            // Nonaktifkan SSL verify di local (development only)
            if (app()->environment('local')) {
                $http = $http->withoutVerifying();
            }

            $response = $http->post($this->url, [
                'target' => $normalizedPhone,
                'message' => $message,
                'countryCode' => '62',
            ]);

            if ($response->successful()) {
                Log::info('WhatsApp message sent successfully', [
                    'phone' => $normalizedPhone,
                    'response' => $response->json(),
                ]);
                return true;
            }

            Log::error('WhatsApp API error', [
                'phone' => $normalizedPhone,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('WhatsApp connection error', [
                'phone' => $normalizedPhone,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
