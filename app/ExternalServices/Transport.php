<?php

namespace App\ExternalServices;

interface Transport
{
    public function get(): array;
}
