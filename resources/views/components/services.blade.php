<!-- start wpo-service-section -->
<section class="wpo-service-section section-padding">
    <div class="container">
        @if ($data)

            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5">
                    <div class="wpo-section-title">
                        <h2>{{ $data['title'] }}</h2>
                        <p>{!! $data['description'] !!}</p>
                    </div>
                </div>
            </div>
            <div class="row"> 
                @if ($data['items'])

                    @forelse ($data['items'] as $service)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="wpo-service-item">
                                <div class="wpo-service-img">
                                    @php
                                    $service_image = isset($service->image) ? 'storage/' . $service->image : null;
                                    @endphp
                                    @if ($service_image && File::exists(public_path($service_image)))
                                    <img src="{{ asset($service_image) }}" alt="" class="img-service">
                                    @endif
                                </div>

                                <div class="wpo-service-text">
                                    <h2><a href="{{ $service->slug }}">{{ $service->title }}</a></h2>
                                    <p>{{ $service->description }}.</p>
                                    <a href="{{ $service->slug }}">READ MORE <i class="fa fa-angle-double-right"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No Service Found</p>
                    @endforelse
                @endif

            </div>
        @endif
    </div>
</section>
<!-- end of wpo-service-section -->
