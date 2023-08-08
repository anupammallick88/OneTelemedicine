<?php

namespace App\Http\Controllers\Front;

use App\Models\Doctor;
use App\Models\Admin\Faq;
use App\Models\Admin\News;
use PhpParser\Comment\Doc;
use App\Models\Front\About;
use App\Models\Front\Brand;
use App\Models\Front\Notice;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\Admin\Comment;
use App\Models\Admin\Gallery;
use App\Models\Front\Counter;
use App\Models\Front\Service;
use App\Models\Admin\Category;
use App\Models\DoctorCategory;
use App\Models\Front\Testimonial;
use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Front\GallerySection;

class FrontController extends Controller
{
    public function index()
    {
        if (file_exists(storage_path('installed'))) {
            $sliders = Slider::where('status', 1)->get();

            if (Notice::where('status', 1)->first()) {
                $notice = Notice::where('status', 1)->first();
            } else {
                $notice = null;
            }

            if (About::first()) {
                $about_section = About::first();
            } else {
                $about_section = null;
            }

            if (Counter::first()) {
                $counter_section = Counter::first();
            } else {
                $counter_section = null;
            }

            $testimonials = Testimonial::where('status', 1)->get();

            $services = Service::where('status', 1)->take(6)->get();

            $all_news = News::with('user')->where('status', 1)->orderBy('created_at', 'DESC')->take(3)->get();

            $galleries = Gallery::with('service')->take(6)->get();
            $gallery_section_bg = GallerySection::first();

            $doctors = Doctor::orderBy('created_at', 'DESC')->take(8)->get();

            return view('front.index', compact('doctors', 'galleries', 'gallery_section_bg', 'sliders', 'notice', 'about_section', 'counter_section', 'services', 'testimonials', 'all_news'));
        } else {
            return redirect()->to('/install');
        }
    }


    public function about()
    {
        if (About::first()) {
            $about_section = About::first();
        } else {
            $about_section = null;
        }

        $testimonials = Testimonial::where('status', 1)->get();
        $doctors = Doctor::orderBy('created_at', 'DESC')->take(8)->get();

        return view('front.about', compact('doctors', 'about_section', 'testimonials'));
    }

    public function service()
    {
        $galleries = Gallery::with('service')->get();
        $services = Service::where('status', 1)->get();
        $gallery_section_bg = GallerySection::first();
        $doctors = Doctor::orderBy('created_at', 'DESC')->take(8)->get();

        return view('front.service', compact('doctors', 'services', 'gallery_section_bg', 'galleries'));
    }


    public function news()
    {
        $testimonials = Testimonial::where('status', 1)->get();
        $all_news = News::with('user')->where('status', 1)->orderBy('created_at', 'DESC')->paginate(6);
        $doctors = Doctor::orderBy('created_at', 'DESC')->take(8)->get();

        return view('front.news', compact('testimonials', 'all_news', 'doctors'));
    }

    public function category($slug)
    {
        $category = Category::whereTranslation('slug', $slug)->firstOrFail();

        if ($category) {
            $category_name = $category->translateOrDefault(session()->get('locale'))->name;
        } else {
            $category_name = $category->translateOrDefault(session()->get('locale'))->name;
        }
        $doctors = Doctor::orderBy('created_at', 'DESC')->take(8)->get();
        $testimonials = Testimonial::where('status', 1)->get();
        $all_news = News::with('user')->where('status', 1)->where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate(6);

        return view('front.category', compact('doctors', 'testimonials', 'all_news', 'category_name'));
    }

    public function tag($tag)
    {
        $category_name = $tag;
        $doctors = Doctor::orderBy('created_at', 'DESC')->take(8)->get();
        $testimonials = Testimonial::where('status', 1)->get();
        $all_news = News::with('user')->where('status', 1)->where('tags', 'LIKE', "%{$tag}%")->orderBy('created_at', 'DESC')->paginate(6);
        return view('front.category', compact('doctors', 'testimonials', 'all_news', 'category_name'));
    }

    public function single_news($slug)
    {
        $newsId = News::whereTranslation('slug', $slug)->first();
        $comments = Comment::with('reply', 'user')->where('p_id', $newsId->id)->where('status', 1)->get();
        $recent_news = News::with('user')->where('status', 1)->orderBy('created_at', 'DESC')->take(4)->get();
        $news = News::with('user')->whereTranslation('slug', $slug)->firstOrFail();
        $previous_news = News::where('id', '<', $news->id)->orderBy('id', 'DESC')->first();
        $next_news = News::where('id', '>', $news->id)->orderBy('id')->first();
        $categories = Category::all();
        return view('front.single_news', compact('newsId', 'categories', 'news', 'previous_news', 'next_news', 'comments', 'recent_news'));
    }

    public function single_service($slug)
    {
        $service = Service::whereTranslation('slug', $slug)->firstOrFail();
        $previous_service = Service::where('id', '<', $service->id)->orderBy('id', 'DESC')->first();
        $next_service = Service::where('id', '>', $service->id)->orderBy('id')->first();
        $all_service = Service::get();
        $doctors = Doctor::orderBy('created_at', 'DESC')->take(8)->get();

        return view('front.single_service', compact('doctors', 'service', 'previous_service', 'next_service', 'all_service'));
    }


    public function galleries()
    {
        $galleries = Gallery::with('service')->get();
        $testimonials = Testimonial::where('status', 1)->get();
        $doctors = Doctor::orderBy('created_at', 'DESC')->take(8)->get();

        return view('front.gallery', compact('doctors', 'galleries', 'testimonials'));
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function faq()
    {
        return view('front.faq');
    }


    public function doctor()
    {
        $testimonials = Testimonial::where('status', 1)->get();
        $all_news = News::with('user')->where('status', 1)->orderBy('created_at', 'DESC')->take(3)->get();
        $doctor_category = DoctorCategory::with('doctor')->get();
        return view('front.doctor', compact('testimonials', 'all_news', 'doctor_category'));
    }

    public function doctorprofile(Doctor $doctor)
    {
        $testimonials = Testimonial::where('status', 1)->get();
        $all_news = News::with('user')->where('status', 1)->orderBy('created_at', 'DESC')->take(3)->get();
        $doctor_category = DoctorCategory::with('doctor')->get();
        // dd($all_news);
        return view('front.doctorprofile', compact('doctor', 'testimonials', 'all_news', 'doctor_category'));
    }

    public function page_details($slug)
    {
        $page = Page::query()->where('url', $slug)->first();
        return view('front.page_details', compact('page'));
    }
}
