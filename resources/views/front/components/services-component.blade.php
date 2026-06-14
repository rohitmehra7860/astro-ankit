 <section class="as_blog_wrapper as_padderTop80 as_padderBottom80">
     <div class="container">
         <div class="row">
             <div class="col-lg-12 text-center">
                 <h1 class="as_heading as_heading_center">Our Services</h1>
                 <p class="as_font14 as_margin0 as_padderBottom20">Discover powerful astrology services by Ankit Shastri
                     Ji <br> Accurate solutions for every problem in love, business, career, family and health.</p>
                 <div class="text-left">
                     <div class="row">
                         @foreach ($services as $item)
                             <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                 <div class="as_blog_box">
                                     <div class="as_blog_img mb-0">
                                         <a href="{{ route('single-service', $item->slug) }}" aria-label="{{ $item->title }}">
                                             <img src="{{ asset($item->image_url) }}" alt="{{ $item->title }}"
                                                 class="img-responsive" width="370" height="240" loading="lazy">
                                         </a>
                                     </div>
                                     <h4 class="as_subheading">
                                         <a href="{{ route('single-service', $item->slug) }}" aria-label="{{ $item->title }}">
                                             {{ $item->title }}
                                         </a>
                                     </h4>
                                     <div class="as_font14 as_margin0 mb-2">
                                         {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}
                                     </div>
                                     <a href="{{ route('single-service', $item->slug) }}" class="as_link" aria-label="{{ $item->title }}">
                                         read more
                                     </a>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                     @if (!Route::is('services'))
                    <a href="{{ route('services') }}" class="as_btn mt-4 mx-auto" aria-label="Make Appointment">View More</a>
                @endif
                 </div>
             </div>
         </div>
     </div>
 </section>
