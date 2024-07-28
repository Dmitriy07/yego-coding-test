<?php

namespace App\ExternalServices\Yego;

use App\Dto\TransportDto;
use App\ExternalServices\Transport;
use Illuminate\Support\Facades\Http;

class YegoApi implements Transport
{

    private string $token;
    private string $url;

    public function __construct()
    {
        $this->token = config('api.yego.token');
        $this->url = config('api.yego.url');
    }

    public function get(): array
    {
        $response = Http::withToken($this->token)->get($this->url);

        return $this->convertResponseToArrayWithTransportDto($response->object());
    }

    private function convertResponseToArrayWithTransportDto($responseObject): array
    {
        $arrayWithDtos = [];
        foreach ($responseObject as $item) {
            $arrayWithDtos[] = TransportDto::create(
                id: $item->id,
                name: $item->name,
                latitude: $item->lat,
                longitude: $item->lng,
                battery: $item->battery,
                type: $item->type
            );
        }

        return $arrayWithDtos;
    }
}
