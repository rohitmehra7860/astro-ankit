 <section class="as_zodiac_sign_wrapper as_padderTop80 as_padderBottom80">
     <div class="container">
         <div class="row">
             <div class="col-lg-12 text-center">
                 <h1 class="as_heading as_heading_center">choose zodiac sign</h1>
                 <p class="as_font14 as_margin0">Find out what your zodiac sign reveals about your love, career and
                     future.</p>


                 <div class="as_zodiac_inner text-left">
                     <div class="row as_verticle_center">
                         <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                             <ul class="as_sign_ul">
                                 @foreach ($zodiacSigns->take(6) as $item)
                                     <li class="as_sign_box">
                                         <a href="{{ route('single-zodiac-sign', $item->slug) }}" aria-label="{{ $item->title }}">
                                             <span class="as_sign">
                                                 <img src="{{ asset($item->image_url) }}" alt="{{ $item->title }}" width="50" height="50" loading="lazy">
                                             </span>
                                             <div>
                                                 <h5>{!! $item->title !!}</h5>
                                             </div>
                                         </a>
                                     </li>
                                 @endforeach
                             </ul>
                         </div>
                         <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                             <div class="as_sign_img text-center">
                                 <img src="{{ asset('assets/images/zodiac.webp') }}" alt="Zodiac Wheel"
                                     class="img-responsive" width="450" height="450" loading="lazy">
                             </div>
                         </div>
                         <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                             <ul class="as_sign_ul as_sign_ul_right">

                                 @foreach ($zodiacSigns->slice(6, 6) as $item)
                                     <li class="as_sign_box">
                                         <a href="{{ route('single-zodiac-sign', $item->slug) }}" aria-label="{{ $item->title }}">
                                             <span class="as_sign">
                                                 <img src="{{ asset($item->image_url) }}" alt="{{ $item->title }}" width="50" height="50" loading="lazy">
                                             </span>
                                             <div>
                                                 <h5>{!! $item->title !!}</h5>
                                             </div>
                                         </a>
                                     </li>
                                 @endforeach
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
