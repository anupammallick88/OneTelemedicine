<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    public function index()
    {
        $all_languages = Language::get();
        return view('admin.language.index', compact('all_languages'));
    }

    public function store(Request $request)
    {
        $language = Language::firstOrCreate(['prefix' => $request->prefix], [
            'name' => $request->name,
            'direction' => $request->direction,
        ]);

        if (File::exists(base_path() . '/resources/lang/' . $language->prefix)) {
            session()->flash('error', __('Language Already Exists'));
            Toastr::error('error', __('Language Already Exists'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('language.index');
        } else {
            File::makeDirectory(base_path() . '/resources/lang/' . $language->prefix);
            $base_path = base_path() . '/resources/lang/en/main.php';
            $destination_path = base_path() . '/resources/lang/' . $language->prefix . '/main.php';
            File::copy($base_path, $destination_path);
        }

        if (!is_null($language)) {
            session()->flash('success', __('Successfully Added'));
            Toastr::success('success', __('Successfully Added'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('language.index');
        }
        return redirect()->back()->with('error', __('Something went wrong!'));
    }

    public function edit($id)
    {
        $lang = Language::findOrFail(decrypt($id));
        return view('admin.language.edit', compact('lang'));
    }


    public function update(Request $request, $id)
    {
        try {
            $language = Language::findOrFail(decrypt($id));
            $prefix = $language->prefix;
            $language->name = $request->name;
            $language->prefix = $request->prefix;
            $language->direction = $request->direction;
            $language->save();
            if (File::exists(base_path() . '/resources/lang/' . $prefix)) {
                if ($prefix != $language->prefix) {
                    File::deleteDirectory(base_path() . '/resources/lang/' . $prefix); //delete path

                    File::makeDirectory(base_path() . '/resources/lang/' . $language->prefix);
                    $base_path = base_path() . '/resources/lang/en/main.php';
                    $destination_path = base_path() . '/resources/lang/' . $language->prefix . '/main.php';
                    File::copy($base_path, $destination_path);
                }
            } else {
                File::makeDirectory(base_path() . '/resources/lang/' . $language->prefix);
                $base_path = base_path() . '/resources/lang/en/main.php';
                $destination_path = base_path() . '/resources/lang/' . $language->prefix . '/main.php';
                File::copy($base_path, $destination_path);
            }
            session()->flash('success', __('Successfully Updated'));
            Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('language.index');
        } catch (Exception $e) {
            session()->flash('error', __('Something Went Wrong'));
            Toastr::error('error', __('Something Went Wrong'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('language.index');
        }
    }

    public function delete($id)
    {
        try {
            $language = Language::findOrFail(decrypt($id));
            if (File::exists(base_path() . '/resources/lang/' . $language->prefix)) {
                File::deleteDirectory(base_path() . '/resources/lang/' . $language->prefix); //delete path
            }
            $language->delete();
            session()->flash('success', __('Successfully Deleted'));
            Toastr::success('success', __('Successfully Deleted'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('language.index');
        } catch (Exception  $e) {
            session()->flash('error', __('Something Went Wrong'));
            Toastr::error('error', __('Something Went Wrong'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('language.index');
        }
    }

    // translate
    public function translate($id)
    {
        $language = Language::findOrFail(decrypt($id));
        $files = glob(base_path('resources/lang/' . $language->prefix . '/*.php'));
        $data = [];
        foreach ($files as $file) {
            $name  = basename($file, '.php');
            $data[$name] = require $file;
        }
        $data = $data['main'] ?? $data;
        return view('admin.language.translate', ['language' => $language, 'data' => $data]);
    }

    public function translate_update(Request $request, $id)
    {
        $language =  Language::findOrFail(decrypt($id));
        $inputs = Arr::except($request->all(), ['_token']);
        if ($inputs) {
            $elements = '';
            foreach ($inputs as $key => $value) {
                // $value = preg_replace('/[^A-Za-z0-9\-]/', ' ', $value);
                // $key = preg_replace('/[^A-Za-z0-9\-]/', ' ', $key);
                $elements .= "'" . $key . "' => '" . $value . "',\n";
            }
            $setArray = "<?php  return [" . $elements . "];";
            file_put_contents(base_path("resources/lang/" . $language->prefix . "/main.php"), $setArray);
            session()->flash('success', __('Successfully Updated'));
            Toastr::success('success', __('Successfully Updated'), ["positionClass" => "toast-top-right"]);
            return redirect()->route('language.index');
        }
        session()->flash('error', __('Something Went Wrong'));
        Toastr::success('error', __('Something Went Wrong'), ["positionClass" => "toast-top-right"]);
        return redirect()->route('language.index');
    }
}
