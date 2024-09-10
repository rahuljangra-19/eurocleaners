        <!-- start of wpo-features-section -->
        <section class="wpo-features-section-s2">
            <div class="container">
                <div class="wpo-features-wrap">
                    <div class="row align-items-center justify-content-between">
                        @if ($data)
                        <div class="col col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="wpo-features-item">
                                <div class="wpo-features-icon">
                                    @php
                                    $calender_image = isset($data['calender_image']) ? 'storage/' . $data['calender_image'] : null;
                                    @endphp
                                    @if ($calender_image && File::exists(public_path($calender_image)))
                                    <img src="{{ asset($calender_image) }}" alt="">
                                    @endif
                                </div>
                                <div class="wpo-features-text">
                                    <h4>{{ $data['calender_title'] }}</h4>
                                </div>
                            </div>
                            <div class="angle"><img src="{{ asset('assets/images/icon/6.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col col-lg-4 col-md-4 col-sm-4 col-6">
                            <div class="wpo-features-item active">
                                <div class="wpo-features-icon">
                                    @php
                                    $delivery_image = isset($data['delivery_image']) ? 'storage/' . $data['delivery_image'] : null;
                                    @endphp
                                    @if ($delivery_image && File::exists(public_path($delivery_image)))
                                    <img src="{{ asset($delivery_image) }}" alt="">
                                    @endif
                                </div>
                                <div class="wpo-features-text">
                                    <h4>{{ $data['delivery_title'] }}</h4>
                                </div>
                            </div>
                            <div class="angle"><img src="{{ asset('assets/images/icon/6.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="wpo-features-item">
                                <div class="wpo-features-icon">
                                    @php
                                    $problem_image = isset($data['problem_image']) ? 'storage/' . $data['problem_image'] : null;
                                    @endphp
                                    @if ($problem_image && File::exists(public_path($problem_image)))
                                    <img src="{{ asset($problem_image) }}" alt="">
                                    @endif
                                </div>
                                <div class="wpo-features-text">
                                    <h4>{{ $data['problem_title'] }}</h4>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- end of wpo-features-section -->
