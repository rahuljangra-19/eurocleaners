@inject('carbon', 'Carbon\Carbon')
<div class="blog-sidebar">
    <x-social-card />
    <div class="widget search-widget">
        {{-- <form>
            <div>
                <input type="text" class="form-control" placeholder="Search Post..">
                <button type="submit"><i class="ti-search"></i></button>
            </div>
        </form> --}}
    </div>
    <div class="widget category-widget"> 
        @isset($data['services'])

            <h3>{{ __('messages.services') }}</h3>
            <ul>
                @foreach ($data['services'] as $service)
                    <li><a href="{{ $service->slug }}">{{ $service->title }}</a></li>
                @endforeach
            </ul>
        @endisset
    </div>
    <div class="widget recent-post-widget">
        @isset($data['posts'])
            <h3>Related Posts</h3>
            <div class="posts">
                @foreach ($data['posts'] as $post)
                    <div class="post">
                        <div class="img-holder">
                            @php
                                // Check if the feature_image key exists and is not empty
                                $relatedImgPath = isset($post['feature_image'])
                                    ? 'storage/' . $post['feature_image']
                                    : null;
                            @endphp

                            @if ($relatedImgPath && File::exists(public_path($relatedImgPath)))
                                <img src="{{ asset($relatedImgPath) }}" alt="" class="img-projects">
                            @else
                                <img src="{{ asset('assets/images/recent-posts/img-1.jpg') }}" alt=""
                                    class="img-projects">
                            @endif
                        </div>
                        <div class="details">
                            <h4><a href="{{ $post->slug }}">{{ $post->title }}</a></h4>
                            <span class="date">{{ $carbon::parse($post->created_at)->format('d M, Y') }} </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset
    </div>
    <div class="widget wpo-instagram-widget">
        @isset($data['projects'])

            <div class="widget-title">
                <h3>{{ __('messages.projects') }}</h3>
            </div>
            <ul class="d-flex">
                @foreach ($data['projects'] as $project)
                    <li><a href="{{ $project->slug }}">
                            @php
                                // Check if the feature_image key exists and is not empty
                                $projectImgPath = isset($project['image']) ? 'storage/' . $project['image'] : null;
                            @endphp

                            @if ($projectImgPath && File::exists(public_path($projectImgPath)))
                                <img src="{{ asset($projectImgPath) }}" alt="" class="img-projects">
                            @else
                                <img src="{{ asset('assets/images/instragram/1.jpg') }}" alt=""
                                    class="img-projects">
                            @endif

                        </a></li>
                @endforeach
            </ul>
        @endisset
    </div>
    {{-- <div class="widget wpo-instagram-widget">
        <div class="widget-title">
            <h3>{{ __('messages.services') }}</h3>
</div>
<ul class="d-flex">
    <li><a href="project-single.html"><img src="assets/images/instragram/1.jpg" alt=""></a></li>
    <li><a href="project-single.html"><img src="assets/images/instragram/2.jpg" alt=""></a></li>
    <li><a href="project-single.html"><img src="assets/images/instragram/3.jpg" alt=""></a></li>
    <li><a href="project-single.html"><img src="assets/images/instragram/4.jpg" alt=""></a></li>
    <li><a href="project-single.html"><img src="assets/images/instragram/5.jpg" alt=""></a></li>
    <li><a href="project-single.html"><img src="assets/images/instragram/6.jpg" alt=""></a></li>
</ul>
</div> --}}
    {{-- <div class="widget tag-widget">
        <h3>Tags</h3>
        <ul>
            <li><a href="#">Kitchen</a></li>
            <li><a href="#">Gas Line</a></li>
            <li><a href="#">Window</a></li>
            <li><a href="#">Water Line</a></li>
            <li><a href="#">Construction</a></li>
            <li><a href="#">Bathroom</a></li>
            <li><a href="#">Basement</a></li>
            <li><a href="#">Remodeling</a></li>
        </ul>
    </div> --}}
    <x-contact-box />
</div>
