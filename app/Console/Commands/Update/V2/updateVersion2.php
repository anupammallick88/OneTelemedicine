<?php

namespace App\Console\Commands\Update\V2;

use App\Models\Admin\Category;
use App\Models\Admin\CategoryTranslation;
use App\Models\Admin\Faq;
use App\Models\Admin\FaqTranslation;
use App\Models\Admin\MenuItem;
use App\Models\Admin\MenuItemTranslation;
use App\Models\Admin\News;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use App\Models\Front\About;
use App\Models\Front\AboutTranslation;
use App\Models\Front\Counter;
use App\Models\Front\CounterTranslation;
use App\Models\Admin\NewsTranslation;
use App\Models\Front\Notice;
use App\Models\Front\NoticeTranslation;
use App\Models\Front\SectionTitle;
use App\Models\Front\SectionTitleTranslation;
use App\Models\Front\Service;
use App\Models\Front\ServiceTranslation;
use App\Models\Slider;
use App\Models\SliderTranslation;
use App\Models\Language;
use App\Models\Models\Admin\Site;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class updateVersion2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:version:2.0';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update application version of Zaitors';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            $lang_count = Language::count();
            if($lang_count == 0) {
                Language::create([
                    'prefix' => 'en',
                    'name' => 'English',
                    'direction' => 'ltr',
                ]);
            }
            $allsettings = allsetting();
            $site_stting = Site::first();
            if(!isset($allsettings['title'])) {
                Setting::create(['slug' => 'title', 'value' => $site_stting->title]);
            }
            if(!isset($allsettings['footer_copyright'])) {
                Setting::create(['slug' => 'footer_copyright', 'value' => $site_stting->footer_copyright]);
            }
            if(!isset($allsettings['contact_image'])) {
                Setting::create(['slug' => 'contact_image', 'value' => $site_stting->contact_image]);
            }
            if(!isset($allsettings['site_logo'])) {
                Setting::create(['slug' => 'site_logo', 'value' => $site_stting->image1]);
            }
            if(!isset($allsettings['favicon'])) {
                Setting::create(['slug' => 'favicon', 'value' => $site_stting->image2]);
            }
            if(!isset($allsettings['white_logo'])) {
                Setting::create(['slug' => 'white_logo', 'value' => $site_stting->image3]);
            }
            if(!isset($allsettings['address'])) {
                Setting::create(['slug' => 'address', 'value' => $site_stting->address]);
            }
            if(!isset($allsettings['helpline_1'])) {
                Setting::create(['slug' => 'helpline_1', 'value' => $site_stting->helpline1]);
            }
            if(!isset($allsettings['helpline_2'])) {
                Setting::create(['slug' => 'helpline_2', 'value' => $site_stting->helpline2]);
            }
            if(!isset($allsettings['helpline_email_1'])) {
                Setting::create(['slug' => 'helpline_email_1', 'value' => $site_stting->helpline_email1]);
            }
            if(!isset($allsettings['helpline_email_2'])) {
                Setting::create(['slug' => 'helpline_email_2', 'value' => $site_stting->helpline_email2]);
            }
            if(!isset($allsettings['preloader'])) {
                Setting::create(['slug' => 'preloader', 'value' => 'preloader.png']);
            }
            $sliders_count = SliderTranslation::count();
            if($sliders_count == 0) {
                $sliders = Slider::get();
                foreach($sliders as $slider) {
                    SliderTranslation::create([
                        'locale' => 'en',
                        'slider_id' => $slider->id,
                        'small_heading' => $slider->small_heading,
                        'big_heading' => $slider->big_heading,
                        'description' => $slider->description,
                    ]);
                }
            }
            $notice_translation_count = NoticeTranslation::count();
            if($notice_translation_count == 0) {
                $notice = Notice::first();
                NoticeTranslation::create([
                    'locale' => 'en',
                    'notice_id' => $notice->id,
                    'title' => $notice->title,
                    'button_text' => $notice->button_text,
                    'description' => $notice->description,
                ]);
            }
            $about_translation_count = AboutTranslation::count();
            if($about_translation_count == 0) {
                $about = About::first();
                AboutTranslation::create([
                    'locale' => 'en',
                    'about_id' => $about->id,
                    'title' => $about->title,
                    'description' => $about->description,
                    'icon_one_title' => $about->icon_one_title,
                    'icon_one_description' => $about->icon_one_description,
                    'icon_two_title' => $about->icon_two_title,
                    'icon_two_description' => $about->icon_two_description,
                    'icon_three_title' => $about->icon_three_title,
                    'icon_three_description' => $about->icon_three_description
                ]);
            }
            $counter_translation_count = CounterTranslation::count();
            if($counter_translation_count == 0) {
                $counter = Counter::first();
                CounterTranslation::create([
                    'locale' => 'en',
                    'counter_id' => $counter->id,
                    'counter_one_count' => $counter->counter_one_count,
                    'counter_one_title' => $counter->counter_one_title,
                    'counter_two_count' => $counter->counter_two_count,
                    'counter_two_title' => $counter->counter_two_title,
                    'counter_three_count' => $counter->counter_three_count,
                    'counter_three_title' => $counter->counter_three_title,
                    'counter_four_count' => $counter->counter_four_count,
                    'counter_four_title' => $counter->counter_four_title
                ]);
            }
            $section_titles_count = SectionTitleTranslation::count();
            if($section_titles_count == 0) {
                $section_titles = SectionTitle::get();
                foreach ($section_titles as $st) {
                    SectionTitleTranslation::create([
                        'locale' => 'en',
                        'section_title_id' => $st->id,
                        'title' => $st->title,
                        'description' => $st->description,
                    ]);
                }
            }
            $news_count = NewsTranslation::count();
            if($news_count == 0) {
                $news = News::get();
                foreach($news as $nw) {
                    NewsTranslation::create([
                        'locale' => 'en',
                        'news_id' => $nw->id,
                        'title' => $nw->title,
                        'description' => $nw->description,
                        'details' => $nw->details
                    ]);
                }
            }
            $page_count = PageTranslation::count();
            if($page_count == 0) {
                $pages = Page::get();
                foreach($pages as $page) {
                    PageTranslation::create([
                        'locale' => 'en',
                        'page_id' => $page->id,
                        'label' => $page->label,
                    ]);
                }
            }
            $menu_count = MenuItemTranslation::count();
            if($menu_count == 0) {
                $menu_items = MenuItem::get();
                foreach($menu_items as $mi) {
                    MenuItemTranslation::create([
                        'locale' => 'en',
                        'menu_item_id' => $mi->id,
                        'label' => $mi->label,
                    ]);
                }
            }
            $faq_count = FaqTranslation::count();
            if($faq_count == 0) {
                $faqs = Faq::get();
                foreach($faqs as $faq) {
                    FaqTranslation::create([
                        'locale' => 'en',
                        'faq_id' => $faq->id,
                        'question' => $faq->question,
                        'answer' => $faq->answer,
                    ]);
                }
            }
            $cat_count = CategoryTranslation::count();
            if($cat_count == 0) {
                $categories = Category::get();
                foreach($categories as $category) {
                    CategoryTranslation::create([
                        'locale' => 'en',
                        'category_id' => $category->id,
                        'name' => $category->name,
                    ]);
                }
            }
            $service_count = ServiceTranslation::count();
            if($service_count == 0) {
                $services = Service::get();
                foreach($services as $service) {
                    ServiceTranslation::create([
                        'locale' => 'en',
                        'service_id' => $service->id,
                        'title' => $service->title,
                        'description' => $service->description,
                        'details' => $service->details,
                    ]);
                }
            }
            DB::commit();
            $message = 'Successfully migrated to Zaitors v2.0';
        }catch(\Exception $e) {
            DB::rollBack();
            $message = 'Something went wrong due update the application. Make sure your internet is stable. Try again later!';
        }
        $this->info($message);
    }
}
