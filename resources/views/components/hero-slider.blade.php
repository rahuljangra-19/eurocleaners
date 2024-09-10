     <!-- start of hero -->
     @if ($data['slides'])
     <section class="wpo-hero-slider">
         <div class="swiper-container">
             <div class="swiper-wrapper">
                 @foreach ($data['slides'] as $slide)
                 @php
                 $slideBackgroundImagePath = isset($slide['attributes']['image']) ? 'storage/' . $slide['attributes']['image'] : null;
                 @endphp

                 <div class="swiper-slide">
                     <div class="slide-inner slide-bg-image" data-background="{{ $slideBackgroundImagePath && File::exists(public_path($slideBackgroundImagePath)) ? asset($slideBackgroundImagePath) : '' }}">
                         <div class="gradient-overlay"></div>
                         <div class="container">
                             <div class="slide-content">
                                 <div data-swiper-parallax="300" class="slide-title">
                                     <h2>{{ $slide['attributes']['title'] }}</h2>
                                 </div>
                                 <div data-swiper-parallax="400" class="slide-text">
                                     <p>{{ $slide['attributes']['description'] }}</p>
                                 </div>
                                 <div class="clearfix"></div>
                                 <div data-swiper-parallax="500" class="slide-btns">
                                     @if(isset($languageMeta['book_online']) && $haveContactPage)
                                     <a href="{{ $haveContactPage->slug }}" class="btn theme-btn">{{ $languageMeta['book_online'] }}</a>
                                     @endif
                                 </div>
                             </div>
                         </div>
                     </div> <!-- end slide-inner -->
                 </div> <!-- end swiper-slide -->
                 @endforeach
             </div>
             <!-- end swiper-wrapper -->

             <!-- swipper controls -->
             <div class="swiper-pagination"></div>
             <div class="swiper-button-next"></div>
             <div class="swiper-button-prev"></div>
         </div>
     </section>
     @endif
     <!-- end of wpo-hero-slide-section-->
