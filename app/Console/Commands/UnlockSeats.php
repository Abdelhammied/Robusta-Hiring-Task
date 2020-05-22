<?php

namespace App\Console\Commands;

use App\Models\Seat;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class UnlockSeats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unlock-seats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unlock Locked seats after the lock period';

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
        $seats = Seat::where([
            ['status', '=', 'reservation-in-progress'],
            ['locked_at', '<', Carbon::now()->subSeconds(60)],
        ])->get();

        foreach ($seats as $seat) {
            $seat->setStatusToFree();
        }
    }
}
