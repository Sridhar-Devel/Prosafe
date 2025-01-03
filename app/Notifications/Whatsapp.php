<?php

namespace App\Notifications;

use Illuminate\Support\Facades\Http;

class Whatsapp
{
    private $access_token;

    private $from;

    protected $recipient;

    protected $template;

    protected $lang;

    protected $data;

    private function __construct()
    {
        $this->access_token = env('WHATSAPP_ACCESS_TOKEN');
        $this->from = env('WHATSAPP_PHONE_NUMBER_ID');
    }

    public static function make()
    {
        return new static;
    }

    public function template(string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function lang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }

    public function data($data): self
    {
        $this->data = $data;

        return $this;
    }

    public function to(string $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }

    public function send(): array
    {
        $payload = [
            'messaging_product' => 'whatsapp',
            'to' => $this->recipient,
            'type' => 'template',
            'template' => [
                'name' => $this->template,
                'language' => [
                    'code' => $this->lang,
                ],
                'components' => $this->data,
            ],
        ];

        $url = 'https://graph.facebook.com/v17.0/'.$this->from.'/messages';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->access_token,
            'Content-Type' => 'application/json',
        ])->post($url, $payload);

        return $response->json();
    }
}
