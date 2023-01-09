<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

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

        foreach ($slots as $slot) {
            $code = Appointment::where('slot', $slot)
                ->where('vehicle_number', '!=', $request->vehicle_number)
                ->where('start_date_time', '>=', $request->start_date_time)
                ->where('end_date_time', '<=', $request->end_date_time)
                ->first();

            if (!$code) {
                break;
            } else {
                continue;
            }
        }



        return $slot;
    }
    public function store(Request $request)
    {
        $appointment = new Appointment();
        $appointment->cust_name = $request->cust_name;
        $appointment->phone = $request->phone;
        $appointment->license_path = $request->license_path;
        $appointment->vehicle_number = $request->vehicle_number;
        $appointment->start_date_time = $request->start_date_time;
        $appointment->end_date_time = $request->end_date_time;
        $slot = $this->availableSlot($request);

        if ($slot) {
            $appointment->slot = $this->availableSlot($request);
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
        $appointment->parking_fee = $parkingFee;
        $appointment->save();
        return $appointment;
    }

    public function checkout(Request $request)
    {
        $appointment = Appointment::find($request->id);

        $timeDiff = time() - strtotime($appointment->start_date_time);

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
        $appointment->end_date_time = time();
        $appointment->parking_fee = $parkingFee;
        $appointment->save();
        return $appointment;
    }

    public function totalList()
    {
        $totals = DB::table('appointments')
            ->selectRaw('sum(parking_fee) as total')
            ->get();
        
        return $totals;
    }

    public function upcoming()
    {
        $upcoming = Appointment::where('start_date_time' ,'>=', time())->get();
        
        return $upcoming;
    }
}
