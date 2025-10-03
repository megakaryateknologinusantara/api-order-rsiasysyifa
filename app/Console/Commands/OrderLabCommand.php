<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class OrderLabCommand extends Command
{
    protected $signature = 'orderlab:run';
    protected $description = 'Ambil order lab dari endpoint internal';

    public function handle()
    {
        do {
            $result = app(\App\Http\Controllers\OrderLabController::class)->OrderLab();
            $data = $result->getData();

            $this->info('OrderLab dipanggil, hasil: ' . json_encode($data));

        } while (!empty((array) $data)); // loop selama masih ada data
    }
}
