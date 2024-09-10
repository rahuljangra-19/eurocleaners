<section class="wpo-contact-pg-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col col-lg-10 offset-lg-1">
                <div class="office-info">
                    <div class="row">
                        @isset($data['address'])
                        <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="office-info-item">
                                <div class="office-info-icon">
                                    <div class="icon">
                                        <i class="fi flaticon-placeholder"></i>
                                    </div>
                                </div>
                                <div class="office-info-text">
                                    <h2>Address</h2>
                                    <p>{{ $data['address'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endisset
                        @isset($data['email'])

                        <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="office-info-item">
                                <div class="office-info-icon">
                                    <div class="icon">
                                        <i class="fi flaticon-email"></i>
                                    </div>
                                </div>
                                <div class="office-info-text">
                                    <h2>Email Us</h2>
                                    <p>{{ $data['email'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endisset
                        @isset($data['phone'])
                        <div class="col col-xl-4 col-lg-6 col-md-6 col-12">
                            <div class="office-info-item">
                                <div class="office-info-icon">
                                    <div class="icon">
                                        <i class="fi flaticon-phone-call"></i>
                                    </div>
                                </div>
                                <div class="office-info-text">
                                    <h2>Call Now</h2>
                                    <p>{{ $data['phone'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endisset
                    </div>
                </div>
                <div class="wpo-contact-title">
                    @isset($data['quest_title'])
                    <h2>{{ $data['quest_title'] }}</h2>
                    @endisset
                    @isset($data['ques_desc'])
                    <p>{!! $data['ques_desc'] !!}</p>
                    @endisset
                </div>
                <div class="wpo-contact-form-area">
                    <form method="post" action="javascript:void(0)" class="contact-validation-active" id="contact-form">
                        @csrf
                        <div>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name*" required>
                        </div>
                        <div>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email*" required>
                        </div>
                        <div>
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone*" required>
                        </div>
                        @isset($services)
                        <div>
                            <select name="subject" class="form-control" required>
                                <option disabled="disabled" selected>Select Service</option>
                                @foreach ($services as $service )
                                <option value="{{ $service->title }}">{{ $service->title }}</option>
                                @endforeach

                            </select>
                        </div>
                        @endisset
                        <div class="fullwidth">
                            <textarea class="form-control" name="message" id="message" placeholder="Message..."></textarea>
                        </div>
                        <div class="submit-area">
                            <button type="submit" id="submitBtn" class="theme-btn"><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{ $data['submit_button'] }}</button>
                            <div id="loader">
                                <i class="ti-reload"></i>
                                <p>Please wait....</p>
                            </div>
                        </div>
                        <div class="clearfix error-handling-messages">
                            <div id="success">Thank you</div>
                            <div id="error"> Error occurred while sending email. Please try again later. </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</section>
<!-- end wpo-contact-pg-section -->

<!--  start wpo-contact-map -->
<section class="wpo-contact-map-section">
    <h2 class="hidden">Contact map</h2>

    <div class="wpo-contact-map">
        {{-- <div id="map"></div> --}}
        @isset($data['google_link'])
        {!! $data['google_link'] !!}
        @else
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.3155677079694!2d76.68615107610333!3d30.70952778675283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fefdc860acaa9%3A0xeac2d4bd13c4380b!2sSivah%20Tech!5e0!3m2!1sen!2sin!4v1724664165842!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        @endisset
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    if ($("#contact-form").length) {
        $("#contact-form").validate({
            rules: {
                name: {
                    required: true
                    , minlength: 2
                , },

                email: "required",

                phone: "required",

                zip: "required",

                subject: {
                    required: true
                , }
            , },

            messages: {
                name: "Please enter your name"
                , email: "Please enter your email address"
                , phone: "Please enter your phone number"
                , subject: "Please select your contact Service"
            , },

            submitHandler: function(form) {
                $("#loader").show()
                $('#submitBtn').attr('disabled', true);
                $('#submitBtn').hide();

                $.ajax({
                    type: "POST"
                    , url: `{{ route('contact.us') }}`
                    , data: $(form).serialize()
                    , success: function() {
                        $("#loader").hide();
                        $("#success").slideDown("slow");
                        setTimeout(function() {
                            $("#success").slideUp("slow");
                            $('#submitBtn').show();
                            $('#submitBtn').attr('disabled', false);
                        }, 3000);
                        form.reset();
                    }
                    , error: function() {
                        $("#loader").hide();
                        $("#error").slideDown("slow");
                        setTimeout(function() {
                            $("#error").slideUp("slow");
                            $('#submitBtn').attr('disabled', false);
                            $('#submitBtn').show();
                        }, 3000);
                    }
                , });
                return false; // required to block normal submit since you used ajax
            }
        , });
    }

</script>

{{-- <script src="https://maps.googleapis.com/maps/api/js?key={{ $google_key }}&callback=initMap"></script>

<script>
    let map;
    async function initMap() {
        const position = {
            lat: {
                {
                    $map['latitude']
                }
            }
            , lng: {
                {
                    $map['longitude']
                }
            }
        };
        const {
            Map
        } = await google.maps.importLibrary("maps");
        const {
            AdvancedMarkerElement
        } = await google.maps.importLibrary("marker");
        map = new Map(document.getElementById("map"), {
            zoom: 10
            , center: position
            , mapId: "EMCO_WATERWORKS"
        , });
        const marker = new AdvancedMarkerElement({
            map: map
            , position: position
        , });
    }
    initMap();

</script> --}}
