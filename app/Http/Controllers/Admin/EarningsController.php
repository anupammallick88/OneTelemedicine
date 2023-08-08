<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EarningDataTable;
use App\DataTables\SpotPaymentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\DoctorPayment;
use App\Models\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EarningsController extends Controller
{
    public function earningList(EarningDataTable $dataTable)
    {
        $doctors = Doctor::all();
        return $dataTable->render('admin.earnings.index', compact('doctors'));
    }
    public function spotpayment(SpotPaymentDataTable $dataTable)
    {
        return $dataTable->render('admin.earnings.spotpayment');
    }

    public function doctorPayDetails($id)
    {
        $data['doctorName'] = Doctor::find($id)->user->name;
        $current_month = Carbon::now()->format('m');
        $earningDetails = Appointment::query()
            ->where('doctor_id', $id)
            ->where('is_paid', 1)
            ->whereBetween('created_at', [Carbon::now()->subMonth(12), Carbon::now()])
            ->where('paymentmethod', '!=', 'cod');

        $data['month1'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 0))->whereYear('created_at', previousYear($current_month, 0))->get();
        $data['month2'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 1))->whereYear('created_at', previousYear($current_month, 1))->get();
        $data['month3'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 2))->whereYear('created_at', previousYear($current_month, 2))->get();
        $data['month4'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 3))->whereYear('created_at', previousYear($current_month, 3))->get();
        $data['month5'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 4))->whereYear('created_at', previousYear($current_month, 4))->get();
        $data['month6'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 5))->whereYear('created_at', previousYear($current_month, 5))->get();
        $data['month7'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 6))->whereYear('created_at', previousYear($current_month, 6))->get();
        $data['month8'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 7))->whereYear('created_at', previousYear($current_month, 7))->get();
        $data['month9'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 8))->whereYear('created_at', previousYear($current_month, 8))->get();
        $data['month10'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 9))->whereYear('created_at', previousYear($current_month, 9))->get();
        $data['month11'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 10))->whereYear('created_at', previousYear($current_month, 10))->get();
        $data['month12'] = $earningDetails->whereMonth('created_at', previousMonthId($current_month, 11))->whereYear('created_at', previousYear($current_month, 11))->get();
        return view('admin.earnings.doctor_pay_details', $data);
    }

    public function addPaymentOnlineDoctor(Request $request)
    {
        $create = DoctorPayment::create([
            'doctor_id' => $request->doctor_id,
            'amount' => $request->amount,
            'note' => $request->note,
        ]);

        if (!is_null($create)) {
            return redirect()->back()->with('success', __('Doctor payment successfull'));
        }
        return redirect()->back()->with('success', __('Something went wrong'));
    }
}
