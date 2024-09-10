<div class="widget about-widget">
    <div class="img-holder">
        @php
        $widgetImage = isset($post['image']) ? 'storage/' . $post['image'] : null;
        @endphp

        @if ($widgetImage && File::exists(public_path($widgetImage)))
        <img src="{{ asset($widgetImage) }}" alt="">
        @else
        <img src="{{ asset('assets/images/blog/about-widget.jpg') }}" alt>
        @endif

    </div>
    <h4>{{ $data['name'] ?? '' }}</h4>
    <p>{{ $data['description'] ?? '' }}</p>
    <div class="social">
        <ul class="clearfix">

            @isset($data['google_link'])
            <li><a target="_blank" href="{{ $data['google_link'] }}"><i class="ti-google"></i></a></li>

            @endisset
            @isset($data['fb_link'])
            <li><a target="_blank" href="{{ $data['fb_link'] }}"><i class="ti-facebook"></i></a></li>

            @endisset
            @isset($data['pine_link'])
            <li><a target="_blank" href="{{ $data['pine_link'] }}"><i class="ti-pinterest"></i></a></li>

            @endisset

            @isset($data['insta_link'])
            <li><a target="_blank" href="{{ $data['insta_link'] }}"><i class="ti-instagram"></i></a></li>
            @endisset
            @isset($data['linkedin_link'])
            <li><a target="_blank" href="{{ $data['linkedin_link'] }}"><i class="ti-linkedin"></i></a></li>
            @endisset

            @isset($data['twitter_link'])
            <li><a target="_blank" href="{{ $data['twitter_link'] }}"><i class="ti-twitter-alt"></i></a></li>

            @endisset
        </ul>
    </div>
    <div class="aw-shape">
        <img src="{{ asset('assets/images/blog/ab.png') }}" alt="">
    </div>
</div>
