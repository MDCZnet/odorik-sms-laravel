<?php

namespace Odorik\Sms;

use Illuminate\Support\Facades\Http;

/**
 * Service for sending SMS via Odorik API.
 *
 * @author Martin Dittrich <https://MDCZ.net>
 */
class OdorikSmsService
{
    protected string $baseUrl;
    protected string $user;
    protected string $password;

    public function __construct()
    {
        $this->baseUrl = config('odorik.base_url');
        $this->user = config('odorik.user');
        $this->password = config('odorik.password');
    }

    public function sendSms(string $recipient, string $message, ?string $sender = null): string
    {
        $data = [
            'user' => $this->user,
            'password' => $this->password,
            'recipient' => $recipient,
            'message' => $message,
        ];
        if ($sender) {
            $data['sender'] = $sender;
        }

        $response = Http::asForm()->post($this->baseUrl . '/sms', $data);

        if (!$response->ok()) {
            throw new \Exception('Odorik API error: ' . $response->body());
        }

        return $response->body();
    }

    public function getAllowedSenders(): array
    {
        $response = Http::get($this->baseUrl . '/sms/allowed_sender', [
            'user' => $this->user,
            'password' => $this->password,
        ]);

        if (!$response->ok()) {
            throw new \Exception('Odorik API error: ' . $response->body());
        }

        return array_map('trim', explode(',', $response->body()));
    }
}