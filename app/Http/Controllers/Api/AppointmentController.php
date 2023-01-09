<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function availableSlot($request)
    {
        $alphabets = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        for ($i = 1; $i <= 5; $i++) {
            foreach ($alphabets as $alphabet) {
                $slots[] = $alphabet . $i;
            }
        }
        $record = Appointment::where('vehicle_number', $request->vehicle_number)
            ->where('start_date_time', '>=', $request->start_date_time)
            ->where('end_date_time', '<=', $request->end_date_time)
            ->first();

        if ($record) {
            return false;
        }

        
        // do {
        //     $slot = $slots[rand(0, count($slots) - 1)];
        //     $code = Appointment::where('slot', $slot)
        //     ->where('start_date_time', '>=', $request->start_date_time)
        //     ->where('end_date_time', '<=', $request->end_date_time)
        //     ->first();
        // } while (!empty($code));

        foreach($slots as $slot)
        {
            $code = Appointment::where('slot', $slot)
            ->where('vehicle_number', '!=', $request->vehicle_number)
            ->where('start_date_time', '>=', $request->start_date_time)
            ->where('end_date_time', '<=', $request->end_date_time)
            ->first();

            if(!$code) {
                break;
            } else {
                continue;
            }
        }



        return $slot;
    }
    public function store(Request $request)
    {
        $appintment = new Appointment();
        $appintment->cust_name = $request->cust_name;
        $appintment->phone = $request->phone;
        $appintment->license_path = $request->license_path;
        $appintment->vehicle_number = $request->vehicle_number;
        $appintment->start_date_time = $request->start_date_time;
        $appintment->end_date_time = $request->end_date_time;
        $slot = $this->availableSlot($request);

        if ($slot) {
            $appintment->slot = $this->availableSlot($request);
        } else {
            return ['status' => 'No slot available for this time'];
        }
        $timeDiff = $request->end_date_time - $request->start_date_time;
        $parkingFee = 10;
        if ($timeDiff <=  3 * 60 * 60) { // less than 3 hours
            $parkingFee = 10;
        } elseif ($timeDiff > 12 * 60 * 60) { // over night stay
            $timePart = ceil($timeDiff / (12 * 60 * 60));
            $parkingFee += ($timePart  * 100);
        } else { // charge 5 for evey hours
            $timePart = ceil($timeDiff / (3 * 60 * 60));
            $parkingFee += ($timePart  * 5);
        }
        $appintment->parking_fee = $parkingFee;
        $appintment->save();
        return $appintment;
    }
}
