<!-- start of wpo-about-section -->
<section class="wpo-about-section section-padding">
    <div class="container">
        <div class="wpo-about-section-wrapper">
            <div class="row align-items-center">
                @if ($data)
                <div class="col-lg-5 col-md-12 col-12">
                    <div class="wpo-about-img">
                        @php
                        $featureImagePath = isset($data['image']) ? 'storage/' . $data['image'] : null;
                        @endphp

                        @if ($featureImagePath && File::exists(public_path($featureImagePath)))
                        <img src="{{ asset($featureImagePath) }}" alt="">

                        @endif
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <div class="wpo-about-content">
                        <div class="wpo-section-title-s2">
                            <h2>{{ $data['h2_title'] }}</h2>
                        </div>
                        <div class="wpo-about-content-inner">
                            <p>{!! $data['description'] !!}</p>
                            <div class="signeture">
                                <h4>{{ $data['name'] }}</h4>
                                <p>{{ $data['profile'] }}</p>
                                <span>
                                    @php
                                    $signImagePath = isset($data['sign_image']) ? 'storage/' . $data['sign_image'] : null;
                                    @endphp

                                    @if ($signImagePath && File::exists(public_path($signImagePath)))
                                    <img src="{{ asset($signImagePath) }}" alt="">
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- end of wpo-about-section -->
