<?php

namespace App\Traits;

use App\Models\Doctor;

trait JsVariables
{
    public function patientVariables()
    {
        $data = json_encode([
            'checkappointmenturl' => url("/checkappointment"),
            'filterdoctorurl' =>url("/filterdoctor"),
            'noimage' => asset('uploaded_file/files/img/no-data/no-image-50.jpg'),
            'assetimgurl' => asset('uploaded_file/files/img/user'),
            'fetchdatapagination' => url("/pagination/fetch_data?page="),
            'todaysfetchdatapagination' => url("/pagination/todays_fetch_data?page="),
            'dashboardfetchdatapagination' => url("/pagination/dashboard_fetch_data?page="),
            'searchappointmentdateurl' => url("/searchappointmentdate"),
            'searchappointmenturl' => url("/searchappointment"),
            'stripeurl' => url("/stripe"),
            'strtoken' => csrf_token(),
        ]);
        return $data;
    }

    public function redirectPatientVariables($service, $fees, $name, $dcrid)
    {
        $data = json_encode([
            'service' => $service,
            'fees' => $fees,
            'name' => $name,
            'dcrid' => $dcrid,
            'checkappointmenturl' => url("/checkappointment"),
            'filterdoctorurl' => url("/filterdoctor/doctor"),
            'noimage' => asset('uploaded_file/files/img/no-data/no-image-50.jpg'),
            'assetimgurl' => asset('uploaded_file/files/img/user'),
            'stripeurl' => url("/stripe"),
            'strtoken' => csrf_token(),
        ]);
        return $data;
    }

    public function doctorVariables()
    {
        $data = json_encode([
            'doctorfetchdatapagin' => url("/pagination/doctor_fetch_data?page="),
            'doctorsearchappointmentdateurl' => url("/doctorsearchappointmentdate"),
            'patientappointment' =>url("/patientappointment"),
            'noimage' => asset('uploaded_file/files/img/no-data/no-image-50.jpg'),
            'assetimgurl' => asset('uploaded_file/files/img/user/'),
            'doctortodaysfetchdataurl' => url("/pagination/doctor_todays_fetch_data?page="),
            'doctordashboardfetchdataurl' => url("/pagination/doctor_dashboard_fetch_data?page="),
        ]);
        return $data;
    }

    public function adminDashboardVariables($yearArraytoString, $earningArraytoString)
    {
        $data = json_encode([
            'earningYear' => $yearArraytoString,
            'earningArraytoString' => $earningArraytoString,
        ]);
        return $data;
    }

}
