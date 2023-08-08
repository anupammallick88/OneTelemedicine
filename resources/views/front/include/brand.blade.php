<div class="brand-area">
    <div class="container">
        <div class="brand-slide">
            @foreach (brand_section() as $brand)
                <div class="sngle-brand"><img src="{{ asset(path_brand_image() . $brand->image) }}"
                        alt="{{ __('main.Image') }}" /></div>
            @endforeach
        </div>
    </div>
</div>
