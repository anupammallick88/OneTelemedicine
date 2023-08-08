<?php

namespace App\Console\Commands;

use App\Models\Earning;
use App\Models\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InsertAppointment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:appointment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Appointment insert daily basis!';

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
     * @return int
     */
    public function handle()
    {
        try {
            Appointment::create([
                'doctor_id' => '1',
                'user_id' => '2',
                'fees' => 10,
                'appdate' => Carbon::now()->toDateTimeString(),
                'apptime' => '2',
                'doctorsService' => 'Neurologist',
                'comment' => 'I am sick',
                'paymentmethod' => 'stripe',
                'charge_id' => 'ch_3Kg0NfHdZxBbG9oi1YY2Xd71',
                'status' => '0',
                'slot_id' => 1,
            ]);
            Earning::create([
                'doctor_id' => '1',
                'earning' => 10,
                'user_id' => 2
            ]);
            $this->info('success');
        }catch (\Exception $e) {
            $this->info($e->getMessage());
        }

    }
}
