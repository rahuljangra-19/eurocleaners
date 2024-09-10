<!-- start wpo-page-title -->
@if ($data)
    <section class="wpo-page-title" style="background:url({{ asset(isset($data['image'])?'storage/'.$data['image']:'') }}) no-repeat center top/cover">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{ $data['title'] }}</h2>
                        <ol class="wpo-breadcumb-wrap">
                            {{-- <li><a href="#">Home</a></li> --}}
                            <li>{{ $data['description'] }}</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->
@endif
