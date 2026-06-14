 <section class="as_blog_wrapper as_padderTop80 as_padderBottom80">
     <div class="container">
         <div class="row">
             <div class="col-lg-12 text-center">
                 <h1 class="as_heading as_heading_center">Our Latest Blog</h1>
                 <p class="as_font14 as_margin0 as_padderBottom20">Stay updated with the latest astrology blogs, zodiac
                     insights and planetary predictions by Ankit Shastri Ji.</p>

                 <div class="text-left">
                     <div class="row">
                         @foreach ($blogs as $item)
                             <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                 <div class="as_blog_box">
                                     <div class="as_blog_img">
                                         <a href="{{ route('single-blog', $item->slug) }}"><img
                                                 src="{{ asset($item->image_url) }}" alt="{{ $item->title }}"
                                                 class="img-responsive" width="370" height="240" loading="lazy" aria-label="{{ $item->title }}"></a>
                                         <span class="as_btn">{{ $item->created_at->format('F d, Y') }}</span>
                                     </div>
                                     <ul>
                                         <li>
                                             <a href="javascript:;">
                                                 <img src="{{ asset('assets/images/svg/user.svg') }}" alt="admin icon" width="16" height="16" loading="lazy">
                                                 By - {{ $settings->site_name }}
                                             </a>
                                         </li>
                                     </ul>
                                     <h4 class="as_subheading">
                                         <a href="{{ route('single-blog', $item->slug) }}" aria-label="{{ $item->title }}"> {{ $item->title }}
                                         </a>
                                     </h4>
                                     <div class="as_font14 as_margin0">
                                         {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 150) }}</div>
                                 </div>
                             </div>
                         @endforeach
                          @if (!Route::is('blogs'))
                    <a href="{{ route('blogs') }}" class="as_btn mt-4  mx-auto" aria-label="Make Appointment">View More</a>
                @endif
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
