<section class="as_contact_section as_padderTop80">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 mb-5">
                <div class="as_contact_info">
                    <h1 class="as_heading">Contact Information</h1>
                    <p class="as_font14 as_margin0">Reach out to Ankit Shastri Ji today and get expert astrological
                        guidance for all your life problems.</p>

                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-6 col-sm-6 col-xs-12">
                            <div class="as_info_box">
                                <span class="as_icon"><img src="{{ asset('assets/images/svg/call1.svg') }}"
                                        alt=""></span>
                                <div class="as_info">
                                    <h5>Call Us</h5>
                                    @foreach ($settings->contact_phones as $item)
                                        <p class="as_margin0 as_font14">
                                            <a target="_blank"
                                                href="https://wa.me/{{ $settings->whatsapp_number }}?text=Hello {{ $settings->site_name }}">
                                                {{ $item }}
                                            </a>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-6 col-sm-6 col-xs-12">
                            <div class="as_info_box">
                                <span class="as_icon"><img src="{{ asset('assets/images/svg/mail.svg') }}"
                                        alt=""></span>
                                <div class="as_info">
                                    <h5>Mail Us</h5>
                                    @foreach ($settings->contact_emails as $item)
                                        <p class="as_margin0 as_font14"><a href="mailto:{{ $item }}"
                                                aria-label="Email">{{ $item }}</a></p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="as_contact_form   {{ Route::is('contact') ? '' : 'mb-0' }}" id="contact-form">
                    <h4 class="as_subheading">Have A Question?</h4>
                    <form action="{{ route('enquiry') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" id="" class="form-control"
                                placeholder="Your full name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" name="email" id="" class="form-control"
                                placeholder="your@email.com" required>
                        </div>
                        <div class="form-group">
                            <label>Phone No.</label>
                            <input type="text" name="phone" id="" class="form-control"
                                placeholder="+91 XXXXX XXXXX" required>
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" id="" class="form-control"
                                placeholder="Briefly describe what guidance you're seeking..." required></textarea>
                        </div>
                        <button type="submit" class="as_btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
