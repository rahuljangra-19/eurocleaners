 <!-- start wpo-blog-pg-section -->
 @inject('carbon', 'Carbon\Carbon')
 <section class="wpo-blog-pg-section section-padding">
     <div class="container">
         <div class="row">
             <div class="col col-lg-8">
                 <div class="wpo-blog-content">
                     @isset($data['items'])
                     @foreach ($data['items'] as $post )

                     <div class="post format-standard-image">
                         <div class="entry-media">

                            @php
                            $blogsFeatureImg = isset($post['feature_image']) ? 'storage/' . $post['feature_image'] : null;
                            @endphp
        
                            @if ($blogsFeatureImg && File::exists(public_path($blogsFeatureImg)))
                            <img src="{{ asset($blogsFeatureImg) }}" alt="">
                            @endif
                         </div>
                         <div class="entry-meta">
                             <ul>
                                 {{-- <li><i class="fi flaticon-user"></i> By <a href="#">{{ $post->author['name'] }}</a> </li> --}}
                                 {{-- <li><i class="fi flaticon-comment-white-oval-bubble"></i> Comments 35 </li> --}}
                                 <li><i class="fi flaticon-calendar"></i>{{ $carbon->parse($post->created_at)->format('d M , Y') }}</li>
                             </ul>
                         </div>
                         <div class="entry-details">
                             <h3><a href="{{ $post->slug }}">{{ $post['title'] ?? '' }}</a></h3>
                             @isset($post['descriptions'])
                             <p>{!! $post['descriptions']  !!}.</p>
                             @endisset
                             <a href="{{ $post->slug }}" class="read-more">READ MORE...</a>
                         </div>
                     </div>
                     @endforeach
                     @endisset

                     <div class="pagination-wrapper pagination-wrapper-left">
                         {{ $data['items']->links() }}
                         {{-- <ul class="pg-pagination">

                             <li>
                                 <a href="#" aria-label="Previous">
                                     <i class="fi ti-angle-left"></i>
                                 </a>
                             </li>
                             <li class="active"><a href="#">1</a></li>
                             <li><a href="#">2</a></li>
                             <li><a href="#">3</a></li>
                             <li>
                                 <a href="#" aria-label="Next">
                                     <i class="fi ti-angle-right"></i>
                                 </a>
                             </li>
                         </ul> --}}
                     </div>
                 </div>
             </div>
             <div class="col col-lg-4">
                 <x-blog-right-bar />
             </div> 
         </div>
     </div> <!-- end container -->
 </section>
 <!-- end wpo-blog-pg-section -->
