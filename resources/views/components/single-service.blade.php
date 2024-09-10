<div class="wpo-project-details-area wpo-service-details section-padding">
    <div class="container">
        <div class="row">
            @if ($data)
            <div class="col-lg-4 order-lg-1 order-md-2">
                <div class="blog-sidebar">
                    <div class="widget search-widget">
                        {{-- <form>
                            <div>
                                <input type="text" class="form-control" placeholder="Search Post..">
                                <button type="submit"><i class="ti-search"></i></button>
                            </div>
                        </form> --}}
                    </div>
                    <div class="widget category-widget">
                        <h3>Services</h3>
                        <ul>
                            @forelse ($services as $service)
                            <li><a href="{{ URL($service->slug) }}">{{ $service->title }}</a></li>
                            @empty
                            <li> No service</li>
                            @endforelse

                        </ul>
                    </div>
                    <x-contact-box />
                </div>
            </div>
            <div class="col-lg-8 order-lg-2 order-md-1">
                <div class="wpo-minimals-wrap">
                    <div class="minimals-img">
                        @php
                        $singleServiceImage = isset($data['image']) ? 'storage/' . $data['image'] : null;
                        @endphp

                        @if ($singleServiceImage && File::exists(public_path($singleServiceImage)))
                        <img src="{{ asset($singleServiceImage) }}" alt="">
                        @else
                        <img src="{{ asset('assets/images/service-single/1.jpg') }}" alt="">
                        @endif

                    </div>
                </div>
                <div class="wpo-p-details-section">
                    <h4>{{ $data['title'] ? $data['title'] : 'Home Construction' }}</h4>

                    <p>{!! $data['details'] !!}</p>

                </div>
                <div class="wpo-faq-section">
                    <h4>{{ $data['ques_title'] ? $data['ques_title'] : 'Frequently Ask Questions' }}</h4>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="accordion" id="accordionExample">
                                @forelse ($data['questions'] as $key => $item)
                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="headingOne{{ $key }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="true" aria-controls="collapseOne{{ $key }}">
                                            {{ $item['attributes']['question'] }}
                                        </button>
                                    </h3>
                                    <div id="collapseOne{{ $key }}" class="accordion-collapse collapse show" aria-labelledby="headingOne{{ $key }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p> {{ $item['attributes']['answer'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div> <!-- end wpo-faq-section -->
            </div>
            @endif
        </div>
    </div>
</div>
