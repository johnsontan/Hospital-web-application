<?php

namespace App\Console;

use App\Mail\AppointmentNotification;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $allUsers = Patient::join('appointments','patients.id','=','appointments.patient_id')
            ->join('users','patients.user_id','=','users.id')
            ->join('treatments','appointments.treatment_id','=','treatments.id')
            ->join('medical_staff','appointments.medical_staff_id','=','medical_staff.id')
            ->select('users.id','appointments.appDate','appointments.appTime','treatments.treatmentTitle','medical_staff.user_id')
            ->where('appointments.appDate','=',date('Y-m-d',  time() + 86400))
            ->get();

            foreach($allUsers as $u)
            {
                $user = User::where('id',$u->id)->first();
                $ms = User::join('medical_staff','users.id','=',$u->user_id)->first();
                $date = $u->appDate;
                $treatment = $u->treatmentTitle;

                $time = "";
                switch($u->appTime)
                {
                    case "0":
                        $time .= "0900 HRS to 10000 HRS";
                        break;
                    case "1":
                        $time .= "1000 HRS to 11000 HRS";
                        break;
                    case "2":
                        $time .= "1100 HRS to 12000 HRS";
                        break;
                    case "3":
                        $time .= "1300 HRS to 14000 HRS";
                        break;
                    case "4":
                        $time .= "1400 HRS to 15000 HRS";
                        break;
                    case "5":
                        $time .= "1500 HRS to 16000 HRS";
                        break;
                }
                Mail::to($user->email->send(new AppointmentNotification($date, $time, $treatment, $ms->name)));
            }



        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
