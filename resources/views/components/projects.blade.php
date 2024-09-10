 <!-- start wpo-projects -->
 @if ($data)
     <section class="wpo-projects section-padding">
         <div class="container">
             <div class="row align-items-center justify-content-center">
                 <div class="col-lg-6">
                     <div class="wpo-section-title">
                         <h2>{{ $data['title'] }}</h2>
                         <p>{!! $data['description'] !!}</p>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col col-xs-12 sortable-gallery">
                     <div class="gallery-filters projects-menu">
                         <ul>
                             <li><a data-filter="*" href="#" class="current">All Project</a></li>
                             @forelse ($category as $cat)
                                 <li><a data-filter=".{{ str_replace(' ', '_', $cat->name) }}"
                                         href="#">{{ $cat->name }}</a></li>
                             @empty
                             @endforelse

                         </ul>
                     </div>
                     <div class="projects-grids gallery-container clearfix">
                         @foreach ($data['items'] as $project)
                             @php
                                 $category = implode(
                                     ' ',
                                     array_map(function ($cat) {
                                         return str_replace(' ', '_', $cat);
                                     }, $project->category),
                                 );
                             @endphp
                             <div class="grid  {{ $category }}">
                                 <div class="project-inner">
                                     <div class="img-holder">
                                         @if (!empty($project->image))
                                             @if (File::exists(public_path('storage/' . $project->image)))
                                                 <img src="{{ asset('storage/' . $project->image) }}" alt="">
                                             @endif
                                         @endif
                                     </div>
                                     <div class="hover-content">
                                         <div class="details">
                                             <h3><a href="{{ $project->slug }}">{{ $project->description }}</a>
                                             </h3>
                                             <p class="cat">{{ $project->title }}</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- end wpo-projects -->
 @endif
