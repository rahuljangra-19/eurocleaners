<footer class="wpo-site-footer">
    @if ($data)
    <div class="wpo-upper-footer">
        <div class="container">
            <div class="row">
                @if ($data)
                <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget about-widget">
                        @isset($languageMeta['about'])
                        <div class="widget-title">
                            <h3>{{ $languageMeta['about'] }}</h3>
                        </div>

                        @if ($data['about_us'])
                        <p>{{ $data['about_us'] }}</p>
                        @endif
                        <ul>
                            @if ($data['facebook'])
                            <li>
                                <a href="{{ $data['facebook'] }}">
                                    <i class="ti-facebook"></i>
                                </a>
                            </li>
                            @endif
                            @if ($data['twitter'])
                            <li>
                                <a href="{{ $data['twitter'] }}">
                                    <i class="ti-twitter-alt"></i>
                                </a>
                            </li>
                            @endif
                            @if ($data['insta'])
                            <li>
                                <a href="{{ $data['insta'] }}">
                                    <i class="ti-instagram"></i>
                                </a>
                            </li>
                            @endif
                            @if ($data['google'])
                            <li>
                                <a href="{{ $data['google'] }}">
                                    <i class="ti-google"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                        @endisset
                    </div>
                </div>
                <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget wpo-service-link-widget">
                        @isset($languageMeta['contact'])
                        <div class="widget-title">
                            <h3>{{ $languageMeta['contact'] }}</h3>
                        </div>

                        <div class="contact-ft">
                            <ul>
                                @if ($data['address'])
                                <li><i class="fi flaticon-location"></i>{{ $data['address'] }}</li>
                                @endif
                                @if ($data['phone'])
                                <li><i class="fi flaticon-phone-call"></i>{{ $data['phone'] }}</li>
                                @endif
                                @if ($data['contact_email'])
                                <li><i class="fi flaticon-send"></i>{{ $data['contact_email'] }}</li>
                                @endif
                            </ul>
                        </div>
                        @endisset
                    </div>
                </div>
                @endif
                <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget link-widget">
                        @isset($languageMeta['services'])
                        @if ($services)
                        <div class="widget-title">
                            <h3>{{ $languageMeta['services'] }}</h3>
                        </div>
                        @endif

                        <ul>
                            @forelse ($services as $service)
                            <li><a href="{{ URL($service->slug) }}">{{ $service->title }}</a></li>
                            @empty
                            @endforelse

                        </ul>
                        @endisset
                    </div>
                </div>

                <div class="col col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="widget instagram">
                        @isset($languageMeta['projects'])
                            @if ($projects)
                            <div class="widget-title">
                                <h3>{{ $languageMeta['projects'] }}</h3>
                            </div>
                            @endif

                            <ul class="d-flex">
                                @forelse ($projects as $project)
                                <li><a href="{{ URL($project->slug) }}">
                                        @php
                                        $projectFooterimage = isset($project->image) ? 'storage/' . $project->image : null;
                                        @endphp
                                        @if ($projectFooterimage && File::exists(public_path($projectFooterimage)))
                                        <img src="{{ asset($projectFooterimage) }}" class="img-projects" alt="">
                                        @endif
                                    </a></li>
                                @empty
                                @endforelse
                            </ul>
                        @endisset
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </div>
    @endif
    <div class="wpo-lower-footer">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <p class="copyright"> Copyright &copy; 2021 All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
