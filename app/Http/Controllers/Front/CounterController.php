<?php

namespace App\Http\Controllers\Front;

use App\Models\Front\CounterTranslation;
use Illuminate\Http\Request;
use App\Models\Front\Counter;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Mews\Purifier\Facades\Purifier;

class CounterController extends Controller
{
    public function index()
    {
        if(Counter::first()) {
            $counter = Counter::first();
            return view('front.sections.counter.index', compact('counter'));
        } else {
            return view('front.sections.counter.index');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'background_image' => 'required',
            'image' => 'required',
            'video' => 'required',
            'counter_one_icon' => 'required',
            'counter_one_count' => 'required|integer',
            'counter_one_title' => 'required',
            'counter_two_icon' => 'required',
            'counter_two_count' => 'required|integer',
            'counter_two_title' => 'required',
            'counter_three_icon' => 'required',
            'counter_three_count' => 'required|integer',
            'counter_three_title' => 'required',
            'counter_four_icon' => 'required',
            'counter_four_count' => 'required|integer',
            'counter_four_title' => 'required',
        ]);

        $counter = new Counter();

        $counter->video = Purifier::clean($request->video);
        $counter->counter_one_icon = $request->counter_one_icon;
        $counter->counter_one_count = Purifier::clean($request->counter_one_count);
        $counter->counter_one_title = Purifier::clean($request->counter_one_title);
        $counter->counter_two_icon = $request->counter_two_icon;
        $counter->counter_two_count = Purifier::clean($request->counter_two_count);
        $counter->counter_two_title = Purifier::clean($request->counter_two_title);
        $counter->counter_three_icon = $request->counter_three_icon;
        $counter->counter_three_count = Purifier::clean($request->counter_three_count);
        $counter->counter_three_title = Purifier::clean($request->counter_three_title);
        $counter->counter_four_icon = $request->counter_four_icon;
        $counter->counter_four_count = Purifier::clean($request->counter_four_count);
        $counter->counter_four_title = Purifier::clean($request->counter_four_title);

        if (!empty($request->background_image)) {
            $counter->image = fileUpload($request['background_image'], path_counter_image()); // upload file
         }
        if (!empty($request->image)) {
            $counter->image = fileUpload($request['image'], path_counter_image()); // upload file
         }

        $counter->save();
        session()->flash('success', __('Successfully created'));
        Toastr::success('success', __('Successfully created'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('counter.index');
    }


    public function update(Request $request, $id)
    {

      $counter = Counter::where('id', $id)->firstOrFail();
        $request->validate([
            'background_image' => 'mimes:jpg,png,bmp,gif',
            'image' => 'mimes:jpg,png,bmp,gif',
        ]);
        DB::beginTransaction();
        try {
            if(!empty($request->image)){
                $image = fileUpload($request['image'], COUNTER_IMG);
            }
            else{
                $image = $counter->image;
            }
            if(!empty($request->background_image)){
                $background_image = fileUpload($request['background_image'], COUNTER_IMG);
            }
            else{
                $background_image = $counter->background_image;
            }
            $update = Counter::where('id', $id)->update([
                'background_image' => $background_image,
                'image' => $image,
                'video' => is_null($request->video) ? $counter->video : $request->video,
                'counter_one_icon' => is_null($request->counter_one_icon) ? $counter->counter_one_icon : $request->counter_one_icon,
                'counter_two_icon' => is_null($request->counter_two_icon) ? $counter->counter_two_icon : $request->counter_two_icon,
                'counter_three_icon' => is_null($request->counter_three_icon) ? $counter->counter_three_icon : $request->counter_three_icon,
                'counter_four_icon' => is_null($request->counter_four_icon) ? $counter->counter_four_icon : $request->counter_four_icon,
            ]);
            if(!empty($update)) {
                foreach (allLanguages() as $lang) {
                    CounterTranslation::where('locale', $lang->prefix)->where('counter_id', $counter->id)->updateOrCreate([
                        'locale' => $lang->prefix,
                        'counter_id' => $counter->id,
                    ],[
                        'counter_one_count' => is_null($request->input('counter_one_count_'.$lang->prefix)) ? $counter->translateOrDefault($lang->prefix)->counter_one_count : $request->input('counter_one_count_'.$lang->prefix),
                        'counter_one_title' => is_null($request->input('counter_one_title_'.$lang->prefix)) ? $counter->translateOrDefault($lang->prefix)->counter_one_title : $request->input('counter_one_title_'.$lang->prefix),
                        'counter_two_count' => is_null($request->input('counter_two_count_'.$lang->prefix)) ? $counter->translateOrDefault($lang->prefix)->counter_two_count : $request->input('counter_two_count_'.$lang->prefix),
                        'counter_two_title' => is_null($request->input('counter_two_title_'.$lang->prefix)) ? $counter->translateOrDefault($lang->prefix)->counter_two_title : $request->input('counter_two_title_'.$lang->prefix),
                        'counter_three_count' => is_null($request->input('counter_three_count_'.$lang->prefix)) ? $counter->translateOrDefault($lang->prefix)->counter_three_count : $request->input('counter_three_count_'.$lang->prefix),
                        'counter_three_title' => is_null($request->input('counter_three_title_'.$lang->prefix)) ? $counter->translateOrDefault($lang->prefix)->counter_three_title : $request->input('counter_three_title_'.$lang->prefix),
                        'counter_four_count' => is_null($request->input('counter_four_count_'.$lang->prefix)) ? $counter->translateOrDefault($lang->prefix)->counter_four_count : $request->input('counter_four_count_'.$lang->prefix),
                        'counter_four_title' => is_null($request->input('counter_four_title_'.$lang->prefix)) ? $counter->translateOrDefault($lang->prefix)->counter_four_title : $request->input('counter_four_title_'.$lang->prefix),
                    ]);
                }
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', exMessage($e->getMessage()));
        }
        DB::commit();
        return redirect()->back()->with('success', __('Successfully updated!'));
    }
}
