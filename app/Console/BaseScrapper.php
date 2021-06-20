<?php

namespace App\Console;

use Goutte\Client;
use Illuminate\Console\Command as BaseCommand;
use Symfony\Component\HttpClient\HttpClient;

class BaseScrapper extends BaseCommand
{

    /**
     * client request
     *
     * @var Symfony\Component\HttpClient\HttpClient
     */
    protected $cli;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->cli = new Client(HttpClient::create(['timeout' => 60]));
    }
}
