<?php

namespace App\Listeners;

use App\Models\Doctor;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DoctorServiceListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.~
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        if ($event->user->role == 'doctor') {
            $doctor = Doctor::create([
                'user_id' => $event->user->id
            ]);
        }
    }
}
