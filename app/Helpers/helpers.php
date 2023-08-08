<?php

use Carbon\Carbon;
use App\Models\Admin\Page;
use App\Models\Front\Brand;
use App\Models\Front\Social;
use App\Models\Admin\Gallery;
use App\Models\Admin\Menu;
use App\Models\Admin\MenuItem;
use App\Models\Front\SectionTitle;
use App\Models\Models\Appointment;
use App\User;
use Illuminate\Support\HtmlString;
use Intervention\Image\Facades\Image;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorPayment;

if (!function_exists('fileUpload')) {
    function fileUpload($new_file, $path, $old_file_name = null, $imgheight = null, $imgwidth = null)
    {

        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }


        $file_name = time() . $new_file->getClientOriginalName();
        $destinationPath = $path;

        if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_name)) {
            unlink($path . $old_file_name);
        }

        # resize image

        # resize image and upload
        if ($imgheight || $imgwidth) {

            $imageResize = Image::make($new_file)
                ->resize($imgwidth, $imgheight)
                ->save($destinationPath . $file_name);
        } else {

            #original image upload
            $new_file->move($destinationPath, $file_name);
        }

        return $file_name;
    }
}

function uploadFile($new_file, $path, $old_file_name = null, $width = null, $height = null)
{
    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0777, true);
    }
    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . substr($old_file_name, strrpos($old_file_name, '/') + 1))) {

        unlink($path . '/' . substr($old_file_name, strrpos($old_file_name, '/') + 1));
    }

    $input['imagename'] = uniqid() . time() . '.' . $new_file->getClientOriginalExtension();
    $imgPath = public_path($path . $input['imagename']);

    $makeImg = Image::make($new_file);
    if ($width != null && $height != null && is_int($width) && is_int($height)) {
        $makeImg->resize($width, $height);
        $makeImg->fit($width, $height);
    }

    if ($makeImg->save($imgPath)) {
        return $input['imagename'];
    }
    return false;
}

if (!function_exists('removeImage')) {
    function removeImage($path, $old_file_name)
    {
        if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_name)) {

            unlink($path . $old_file_name);
        }

        return true;
    }
}

if (!function_exists('setEnvValue')) {
    function setEnvValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                $envValue = '"' . trim($envValue) . '"';
                $str .= "\n";
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }
}

function allsetting($array = null)
{
    try {
        if (!isset($array[0])) {
            $allsettings = Setting::get();
            if ($allsettings) {
                $output = [];
                foreach ($allsettings as $setting) {
                    $output[$setting->slug] = $setting->translateOrDefault(session()->has('locale') ? session()->get('locale') : 'en')->value;
                }
                return $output;
            }
            return false;
        } elseif (is_array($array)) {
            $allsettings = Setting::whereIn('slug', $array)->get();
            if ($allsettings) {
                $output = [];
                foreach ($allsettings as $setting) {
                    $output[$setting->slug] = $setting->translateOrDefault(session()->has('locale') ? session()->get('locale') : 'en')->value;
                }
                return $output;
            }
            return false;
        } else {
            $allsettings = Setting::where(['slug' => $array])->first();
            if ($allsettings) {
                $output = $allsettings->translateOrDefault(session()->has('locale') ? session()->get('locale') : 'en')->value;
                return $output;
            }
            return false;
        }
    } catch (\Exception $e) {
        return false;
    }
}


//*************************************Image Path**************************
if (!function_exists('path_user_image')) {
    function path_user_image()
    {
        return 'uploaded_file/files/img/user/';
    }
}
if (!function_exists('path_bank')) {
    function path_bank()
    {
        return 'uploaded_file/files/file/bank/';
    }
}

if (!function_exists('path_site_logo_image')) {
    function path_site_logo_image()
    {
        return 'uploaded_file/files/img/site/';
    }
}

if (!function_exists('path_site_favicon_image')) {
    function path_site_favicon_image()
    {
        return 'uploaded_file/files/img/favicon/';
    }
}
if (!function_exists('path_page_banner')) {
    function path_page_banner()
    {
        return 'uploaded_file/files/img/banner/';
    }
}

if (!function_exists('path_site_while_logo_image')) {
    function path_site_while_logo_image()
    {
        return 'uploaded_file/files/img/whitelogo/';
    }
}

if (!function_exists('path_news_image')) {
    function path_news_image()
    {
        return 'uploaded_file/files/img/news/';
    }
}

if (!function_exists('path_slider_image')) {
    function path_slider_image()
    {
        return 'uploaded_file/files/img/slider/';
    }
}

if (!function_exists('path_about_image')) {
    function path_about_image()
    {
        return 'uploaded_file/files/img/about/';
    }
}

if (!function_exists('path_counter_image')) {
    function path_counter_image()
    {
        return 'uploaded_file/files/img/counter/';
    }
}

if (!function_exists('path_service_image')) {
    function path_service_image()
    {
        return 'uploaded_file/files/img/service/';
    }
}

if (!function_exists('path_gallery_image')) {
    function path_gallery_image()
    {
        return 'uploaded_file/files/img/gallery/';
    }
}

if (!function_exists('path_testimonial_image')) {
    function path_testimonial_image()
    {
        return 'uploaded_file/files/img/testimonial/';
    }
}

if (!function_exists('path_brand_image')) {
    function path_brand_image()
    {
        return 'uploaded_file/files/img/brand/';
    }
}

if (!function_exists('path_contact_image')) {
    function path_contact_image()
    {
        return 'uploaded_file/files/img/contact/';
    }
}

if (!function_exists('path_noimage_image')) {
    function path_noimage_image()
    {
        return 'uploaded_file/files/img/no-data/';
    }
}

//************************************* Section Title **************************
if (!function_exists('section_title')) {
    function section_title($name)
    {
        if (SectionTitle::where('name', $name)->first()) {
            return SectionTitle::where('name', $name)->first();
        } else {
            return null;
        }
    }
}


//************************************* Brand section **************************
if (!function_exists('brand_section')) {
    function brand_section()
    {
        return Brand::all();
    }
}


//************************************* Menus items **************************
if (!function_exists('header_menu')) {
    function header_menu()
    {
        return MenuItem::where('position', 1)->get();
    }
}

if (!function_exists('quick_links_menu')) {
    function quick_links_menu()
    {
        return MenuItem::where('position', 2)->get();
    }
}

if (!function_exists('support_help_menu')) {
    function support_help_menu()
    {
        return MenuItem::where('position', 3)->get();
    }
}
if (!function_exists('menu_title')) {
    function menu_title($id)
    {
        return Menu::find($id)->label;
    }
}

//***************************menu************************************* */


//************************************* Footer Gallery **************************]
if (!function_exists('footer_gallery')) {
    function footer_gallery()
    {
        return Gallery::take(4)->get();
    }
}



//************************************* Page Info (SEO) **************************
if (!function_exists('page_info')) {
    function page_info($url)
    {
        $page_info = Page::where('url', $url)->first();
        if ($page_info) {
            return $page_info;
        } else {
            return null;
        }
    }
}

//************************************* Theme Socials **************************
if (!function_exists('Theme_socials')) {
    function Theme_socials()
    {
        return Social::all();
    }
}

if (!function_exists('past_appointment_count')) {
    function past_appointment_count()
    {
        return Appointment::where('user_id', auth()->user()->id)->where('appdate', '<', Carbon::now()->format('Y-m-d'))->orderBy('id', 'DESC')->count();
    }
}

if (!function_exists('patient_ongoing_count')) {
    function patient_ongoing_count()
    {
        return Appointment::where('appdate', Carbon::now()->format('Y-m-d'))->where('user_id', auth()->user()->id)->where('status', 1)->count();
    }
}

if (!function_exists('view_html')) {
    function view_html($text)
    {
        return new HtmlString($text);
    }
}

if (!function_exists('resetPasswordToken')) {
    function resetPasswordToken()
    {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $number = substr(str_shuffle($permitted_chars), 0, 8);

        if (passwordTokenExists($number)) {
            return resetPasswordToken();
        }

        return $number;
    }
}

if (!function_exists('passwordTokenExists')) {
    function passwordTokenExists($number)
    {
        return User::where('reset_password', $number)->exists();
    }
}

if (!function_exists('allLanguages')) {
    function allLanguages()
    {
        return Language::get();
    }
}

if (!function_exists('exMessage')) {
    function exMessage($e)
    {
        if (env('APP_ENV')  == 'production') {
            return __('Something went wrong');
        } else {
            return $e;
        }
    }
}

if (!function_exists('hasMeeting')) {
    function hasMeeting($appointment_id)
    {
        $meeting_count = Meeting::where('appointment_id', $appointment_id)->count();
        if ($meeting_count != 0) {
            return 1;
        }
        return 0;
    }
}

if (!function_exists('redirectDashboard')) {
    function redirectDashboard($tab = 'dashboard')
    {
        if (Auth::user()->role == 'doctor') {
            return route('doctor.dashboard', ['tab' => $tab]);
        } elseif (Auth::user()->role == 'patient') {
            return route('patient.dashboard', ['tab' => $tab]);
        } elseif (Auth::user()->role == 'stuff') {
            return route('stuff.dashboard', ['tab' => $tab]);
        }
    }
}

if (!function_exists('fetchEarningByDoctor')) {
    function fetchEarningByDoctor($doctor_id)
    {
        return Appointment::where('doctor_id', $doctor_id)->where('paymentmethod', '!=', 'cod')->sum('fees');
    }
}

if (!function_exists('fetchOnlineEarningByDoctor')) {
    function fetchOnlineEarningByDoctor($doctor_id)
    {
        return Appointment::where('doctor_id', $doctor_id)->where('paymentmethod', '!=', 'cod')->sum('fees');
    }
}

if (!function_exists('countOnlineEarningByDoctor')) {
    function countOnlineEarningByDoctor($doctor_id)
    {
        return Appointment::where('doctor_id', $doctor_id)->where('paymentmethod', '!=', 'cod')->count();
    }
}

if (!function_exists('fetchOfflineEarningByDoctor')) {
    function fetchOfflineEarningByDoctor($doctor_id)
    {
        return Appointment::where('doctor_id', $doctor_id)->where('paymentmethod', 'cod')->sum('fees');
    }
}

if (!function_exists('countOfflineEarningByDoctor')) {
    function countOfflineEarningByDoctor($doctor_id)
    {
        return Appointment::where('doctor_id', $doctor_id)->where('paymentmethod', 'cod')->count();
    }
}

if (!function_exists('countCancelAppointmentByDoctor')) {
    function countCancelAppointmentByDoctor($doctor_id)
    {
        return Appointment::where('doctor_id', $doctor_id)->where('status', 3)->count();
    }
}

if (!function_exists('offlinePaymentDoctorMontly')) {
    function offlinePaymentDoctorMontly($doctor_id)
    {
        $current_month = Carbon::now()->format('m');
        return Appointment::where('doctor_id', $doctor_id)->where('status', 3)->whereMonth('appdate', $current_month)->sum('fees');
    }
}
if (!function_exists('admintopay')) {
    function admintopay($id)
    {
        return DoctorPayment::where('doctor_id',$id)->sum('amount');

    }
}

if (!function_exists('viewDoctorPayment')) {
    function viewDoctorPayment($doctor_id)
    {
        return DoctorPayment::where('doctor_id', $doctor_id)->get();
    }
}

if (!function_exists('previousMonthId')) {
    function previousMonthId($current_month_id, $sub_month)
    {
        $subtract_month = $current_month_id - $sub_month;
        if ($subtract_month == 0) {
            return  12;
        }
        if ($subtract_month < 0) {
            return  12 + $subtract_month;
        }
        return $subtract_month;
    }
}

if (!function_exists('previousYear')) {
    function previousYear($current_month_id, $sub_month)
    {
        $subtract_month = $current_month_id - $sub_month;
        if ($subtract_month == 0) {
            return  Carbon::now()->format('Y') - 1;
        }
        if ($subtract_month < 0) {
            return  Carbon::now()->format('Y') - 1;
        }
        return  Carbon::now()->format('Y');
    }
}

if (!function_exists('previousMonthName')) {
    function previousMonthName($month_number)
    {
        if ($month_number == 1) {
            return 'January';
        } elseif ($month_number == 2) {
            return 'February';
        } elseif ($month_number == 3) {
            return 'March';
        } elseif ($month_number == 4) {
            return 'April';
        } elseif ($month_number == 5) {
            return 'May';
        } elseif ($month_number == 6) {
            return 'June';
        } elseif ($month_number == 7) {
            return 'July';
        } elseif ($month_number == 8) {
            return 'August';
        } elseif ($month_number == 9) {
            return 'September';
        } elseif ($month_number == 10) {
            return 'October';
        } elseif ($month_number == 11) {
            return 'November';
        } elseif ($month_number == 12) {
            return 'December';
        }
    }
}
