<?php

namespace App\Console\Commands;

use App\Models\Bus;
use App\Models\CrossOver;
use App\Models\Seat;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Console\Command;

class SeedApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed App Factories And Seeders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->confirm('Fresh DB And Seed Stations ?...')) {
            $this->call('migrate:fresh');
            $this->call('db:seed');
        }

        $this->factoriesHandler('Buses', Bus::class);
        $this->factoriesHandler('Users', User::class);
        $this->factoriesHandler('Trips', Trip::class);
        $this->factoriesHandler('CrossOvers', CrossOver::class);
        // $this->factoriesHandler('Seats', Seat::class);
    }


    private function factoriesHandler($resource, $model)
    {
        $count = (int) $this->ask("$resource Count ?", 15);

        factory(
            $model,
            $count
        )->create();
    }
}
