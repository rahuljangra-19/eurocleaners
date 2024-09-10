<div class="wpo-project-details-area section-padding">
    <div class="container">
        <div class="row">
            @if ($data)
            <div class="col-lg-8 col-12">
                <div class="wpo-minimal-wrap">
                    <div class="wpo-minimal-img">
                        @php
                        $sinleProjectImage = isset($data['image']) ? 'storage/' . $data['image'] : null;
                        @endphp

                        @if ($sinleProjectImage && File::exists(public_path($sinleProjectImage)))
                        <img src="{{ asset($sinleProjectImage) }}" alt="">
                        @else
                        <img src="{{ asset('assets/images/project-single/1.jpg') }}" alt="">
                        @endif
                    </div>
                    <ul>
                        @isset($data['video_link'])
                        <li class="video-holder">
                            <a href="{{ $data['video_link'] }}" class="video-btn" data-type="iframe" tabindex="0"></a>
                        </li>
                        @endisset
                    </ul>
                </div>
                <div class="wpo-project-details-list">
                    <div class="row">
                        <div class="col co-l-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="wpo-project-details-text">
                                <span>Client Name</span>
                                <h2>{{ $data['name'] ? $data['name'] : '' }}</h2>
                            </div>
                        </div>
                        <div class="col co-l-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="wpo-project-details-text-3">
                                <span>Project Value</span>
                                <h2>${{ $data['value'] ? $data['value'] : '' }}</h2>
                            </div>
                        </div>
                        <div class="col co-l-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="wpo-project-details-text">
                                <span>Date</span>
                                <h2>{{ $data['date'] ? $data['date'] : '' }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wpo-p-details-section">
                    <h5>{{ $data['h1_title'] ? $data['h1_title'] : 'Project Requirement' }}</h5>
                    <p>{!! $data['h1_description'] ? $data['h1_description'] : '' !!}</p>

                    <div class="process-wrap">
                        <h5>{{ $data['title'] ? $data['title'] : 'Our work process' }}</h5>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="process-item">
                                    <div class="process-icon">
                                        <i class="fi flaticon-lamp"></i>
                                    </div>
                                    <div class="process-text">
                                        <h3>Quality We Ensure</h3>
                                        <p>If you are going to use a passage of Lorem Ipsum, you
                                            need to be sure there isn't.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="process-item">
                                    <div class="process-icon">
                                        <i class="fi flaticon-medal"></i>
                                    </div>
                                    <div class="process-text">
                                        <h3>Experienced Workers</h3>
                                        <p>If you are going to use a passage of Lorem Ipsum, you
                                            need to be sure there isn't.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="process-item">
                                    <div class="process-icon">
                                        <i class="fi flaticon-trophy"></i>
                                    </div>
                                    <div class="process-text">
                                        <h3>Modern Equipment Use</h3>
                                        <p>If you are going to use a passage of Lorem Ipsum, you
                                            need to be sure there isn't.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p>{!! $data['details'] !!}</p>
                </div>
                <div class="wpo-faq-section">
                    <h4>{{ $data['ques_title'] ? $data['ques_title'] : 'Project Solution' }}</h4>
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
            <div class="col-lg-4 col-12">
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
            @endif
        </div>
    </div>
</div>
