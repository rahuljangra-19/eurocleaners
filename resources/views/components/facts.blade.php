   <!-- start wpo-fun-fact-section -->

   <section class="wpo-fun-fact-section-s2 section-padding">
       <div class="container">
           <div class="row align-items-center">
               <div class="col col-lg-12">
                   @if ($data)
                   <div class="wpo-fun-fact-grids clearfix">
                       @foreach ($data['facts'] as $fact)
                       <div class="grid">
                           <div class="icon">
                               @php
                               $fact_image = isset($fact['attributes']['image']) ? 'storage/' . $fact['attributes']['image'] : null;
                               @endphp
                               @if ($fact_image && File::exists(public_path($fact_image)))
                               <img src="{{ asset($fact_image) }}" alt="">
                               @endif

                           </div>
                           <div class="info">
                               <h3><span class="odometer" data-count="{{ $fact['attributes']['count'] }}">00</span>
                               </h3>
                               <p>{{ $fact['attributes']['description'] }}</p>
                           </div>
                       </div>
                       @endforeach
                   </div>
                   @endif
               </div>
           </div>
       </div> <!-- end container -->
   </section>
   <!-- end wpo-fun-fact-section -->
