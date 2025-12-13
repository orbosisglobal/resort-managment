@extends('front.layout.app')
@section('block')
    <div class="hero-wrapper hero-1" id="hero">
        <div class="container">
            <div class="hero-style1">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="hero-style7 text-center">
                            <h1 class="hero-title wow img-custom-anim-top animated ">Your one-stop destination for all
                                branding needs.
                            </h1>
                            <p class="hero-text wow img-custom-anim-top animated ">Welcome to the Total Brand Studio, We
                                offer a comprehensive range of
                                services, from design to printing, including custom-printed products.</p>
                            <div class="btn-group fade_right justify-content-center">

                                <button type="button" class="btn-new wow img-custom-anim-right animated"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <span class="link-effect">
                                        <span class="effect-1">Request a call back</span>
                                        <span class="effect-1">Request a call back</span>
                                    </span>
                                </button>
                            </div>
                        </div>

                    </div>
                    {{-- <div class="col-lg-6 offset-lg-6">
                        <p class="hero-text wow img-custom-anim-right animated" data-wow-duration="1.5s"
                            data-wow-delay="0.1s">Welcome to the Total Brand Studio, We offer a comprehensive range of
                            services, from design to printing, including custom-printed products.</p>
                        <div class="btn-group fade_right">

                            <button type="button" class="btn wow img-custom-anim-right animated" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <span class="link-effect">
                                    <span class="effect-1">Request a call back</span>
                                    <span class="effect-1">Request a call back</span>
                                </span>
                            </button>
                        </div>
                    </div> --}}
                </div>
                {{-- <div class="hero-year-tag wow img-custom-anim-left animated">
                    <img src="{{ asset('assets/img/icon/worldwide.svg') }}" alt="img">
                    <h6>Agency of this year worldwide</h6>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="about-area-1 space bg-theme">
        <div class="about-img-1-1 shape-mockup img-custom-anim-left wow animated" data-left="0" data-top="-100px"
            data-bottom="140px" data-wow-duration="1.5s" data-wow-delay="0.1s">
            <img src="{{ asset('assets/img/banner.webp') }}" alt="img">
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-end">
                <div class="col-lg-6">
                    <div class="overflow-hidden">
                        <div class="about-content-wrap ">
                            <div class="title-area mb-0 ">
                                <h2 class="sec-title text-white">Welcome to Total Brand Studio</h2>
                                <p class="sec-text mt-35 text-white">Your one-stop destination for all your branding needs.
                                    We are a
                                    full-service branding agency committed to helping businesses create a strong and
                                    impactful brand identity. Our services range from crafting unique and eye catching brand
                                    stories, designing visually appealing logos, to printing high-quality promotional
                                    materials.</p>
                                <p class="sec-text mt-30 text-white">We totally rock at giving your brand a makeover. We've
                                    got you
                                    covered with our all-in-one solutions that will definitely make your brand the star of
                                    the show in the marketplace.</p>
                                <div class="btn-wrap mt-50">
                                    <a href="{{ route('about') }}" class="link-btn link-btn1">
                                        <span class="link-effect">
                                            <span class="effect-1 text-white">ABOUT US</span>
                                            <span class="effect-1 text-white">ABOUT US</span>
                                        </span>
                                        <img src="{{ asset('assets/img/icon/arrow-left-top1.svg') }}" alt="icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="faq-area-1 space overflow-hidden">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="title-area text-center ">
                        <h2 class="sec-title">TBS's services</h2>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="accordion-area accordion" id="faqAccordion">
                        @foreach ($services as $index => $service)
                            <div class="accordion-card {{ $index == 0 ? 'active' : '' }}">
                                <div class="accordion-header" id="collapse-item-{{ $index }}">
                                    <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-{{ $index }}"
                                        aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                        aria-controls="collapse-{{ $index }}"> <span
                                            class="faq-number">{{ $index + 1 }}</span> {{ $service->title }}</button>
                                </div>
                                <div id="collapse-{{ $index }}"
                                    class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                    aria-labelledby="collapse-item-{{ $index }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p class="faq-text">{{ $service->sub_title }}
                                        </p>
                                        <a href="{{ route('service.details', ['id' => $service->slug]) }}"
                                            class="link-btn pt-3 text-service-show">
                                            <span class="link-effect">
                                                <span class="effect-1">Show Details</span>
                                                <span class="effect-1">Show Details</span>
                                            </span>
                                            <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="blog-area space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-7 col-xl-6 col-lg-8">
                    <div class="title-area text-center">
                        <h2 class="sec-title">Printable & Customize Products</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-40 justify-content-center">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6">
                        <div class="blog-card">
                            <div class="blog-img">
                                <a href="{{ route('product.details', ['id' => $product->slug]) }}">
                                    <img src="{{ Storage::url(config('filesystems.path.url.product_images') . $product->image) }}"
                                        alt="blog image" style="width:100%;height:318px">
                                </a>
                            </div>
                            <div class="blog-content">
                                {{-- <div class="post-meta-item blog-meta">
                                    <a href="{{ route('product.details', ['id' => $product->id]) }}">March 26, 2024</a>

                                </div> --}}
                                <h4 class="blog-title"><a
                                        href="{{ route('product.details', ['id' => $product->slug]) }}">{{ $product->name }}</a>
                                </h4>
                                <a href="{{ route('product.details', ['id' => $product->slug]) }}" class="link-btn">
                                    <span class="link-effect">
                                        <span class="effect-1">Show</span>
                                        <span class="effect-1">Show</span>
                                    </span>
                                    <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request a call back</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="mobile_form" method="POST">
                    @csrf

                    @method('POST')

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <input type="text" name="name1" id="name1" placeholder="Enter Name"
                                    class="form-control style-border" maxlength="10">
                                <span class="error_msg_name1"></span>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <input type="number" name="mobile" id="mobile" placeholder="Enter Phone No."
                                    class="form-control style-border" maxlength="10">
                                <span class="error_msg_mobile"></span>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn style3 text-secondary" data-bs-dismiss="modal"><span
                                class="link-effect">
                                <span class="effect-1">Close</span>
                                <span class="effect-1">Close</span>
                            </span></button>
                        <button type="submit" class="btn "> <span class="link-effect">
                                <span class="effect-1">Request</span>
                                <span class="effect-1">Request</span>
                            </span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="contact-area-1 space bg-theme">
        <div class="contact-map shape-mockup wow img-custom-anim-left animated" data-wow-duration="1.5s"
            data-wow-delay="0.2s" data-left="0" data-top="-100px" data-bottom="140px">
            {!! $settings11->map !!}
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-end">
                <div class="col-lg-6">
                    <div class="contact-form-wrap">
                        <div class="title-area mb-30">
                            <h2 class="sec-title text-white">Have Any Project on Your Mind?</h2>
                            <p class="text-white">Great! We're excited to hear from you and let's start something</p>
                        </div>
                        <form method="POST" class="contact-form" id="contact_form">
                            @csrf

                            @method('POST')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border contact11" name="name"
                                            id="name" placeholder="Full name*">
                                        <span class="error_msg_name"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control style-border contact11" name="mobile1"
                                            id="mobile1" placeholder="Phone no.*">
                                        <span class="error_msg_mobile1"></span>
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="How Can We Help You*" id="message"
                                            class="form-control style-border contact11"></textarea>
                                        <span class="error_msg_message"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {!! NoCaptcha::display() !!}
                                        <span class="error_msg_captcha"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="form-btn col-12">
                                <button type="submit" class="btn mt-20">
                                    <span class="link-effect">
                                        <span class="effect-1">SEND MESSAGE</span>
                                        <span class="effect-1">SEND MESSAGE</span>
                                    </span>
                                </button>
                            </div>
                            <p class="mt-20 text-white">Note : Safety of your information is our top priority. We guarantee
                                100%
                                security of the data
                                we receive and assure you we won't divulge the information you provided above to anyone.
                                Your email address won't be used to send spam.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="blog-area-3 space">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xxl-4 col-xl-5 position-relative">
                    <div class="sec_title_static">
                        <div class="sec_title_wrap">
                            <div class="title-area">
                                <h2 class="sec-title">Read Our Articles and News</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-xl-7">
                    <div class="blog-grid-static-wrap">
                        @foreach ($blogs as $blog)
                            <div class="blog-grid-static">
                                <div class="blog-grid">
                                    <div class="blog-img">
                                        <a href="{{ route('blog.details', ['id' => $blog->slug]) }}">
                                            <img src="{{ Storage::url(config('filesystems.path.url.blog_images') . $blog->image) }}"
                                                alt="blog image" style="width:302px;height:290px">
                                        </a>
                                    </div>
                                    <div class="blog-content">
                                        <div class="post-meta-item blog-meta">
                                            <a
                                                href="{{ route('blog.details', ['id' => $blog->slug]) }}">{{ $blog->created_at->format('d M Y') }}</a>
                                            <a
                                                href="{{ route('blog.details', ['id' => $blog->slug]) }}">{{ $blog->author }}</a>
                                        </div>
                                        <h4 class="blog-title"><a
                                                href="{{ route('blog.details', ['id' => $blog->slug]) }}">{{ $blog->title }}</a>
                                        </h4>
                                        <p>{{ $blog->sub_title }}</p>
                                        <a href="{{ route('blog.details', ['id' => $blog->slug]) }}" class="link-btn">
                                            <span class="link-effect">
                                                <span class="effect-1">READ MORE</span>
                                                <span class="effect-1">READ MORE</span>
                                            </span>
                                            <img src="{{ asset('assets/img/icon/arrow-left-top.svg') }}" alt="icon">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container-fluid p-0 overflow-hidden">
        <div class="slider__marquee clearfix marquee-wrap">
            <div class="marquee_mode marquee__group">
                @foreach (explode(',', $settings11->marquee_text) as $item)
                    <h6 class="item m-item"><a href="#"><i class="fas fa-star-of-life"></i>
                            {{ $item }}</a></h6>
                @endforeach


            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10" id="message1">

                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn style3 text-secondary" data-bs-dismiss="modal"><span
                            class="link-effect">
                            <span class="effect-1">Close</span>
                            <span class="effect-1">Close</span>
                        </span></button>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {





            $("#mobile_form").submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                formData.append('mobile', $('input[name="mobile"]').val());
                formData.append('name1', $('input[name="name1"]').val());
                formData.append('_method', $('input[name="_method"]').val());

                $.ajax({
                    type: 'POST', // Always use POST method
                    url: "{{ route('request.call.back') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            if (response.status == 'success') {

                                $('#message1').html(response.message);
                                $('#exampleModal').modal('hide');
                                $('#exampleModal1').modal('show');
                                $('#name1').val('');
                                $('#mobile').val('');
                            } else {
                                $('#exampleModal').modal('hide');
                                $('#exampleModal1').modal('show');
                                $('#mobile').val('');
                                $('#name1').val('');
                                $('#message1').html(response.message);
                            }



                        }
                    },
                    error: function(xhr, status, error) {
                        $('.error_msg_mobile').html('');
                        $('.error_msg_name1').html('');

                        console.log(xhr.responseJSON.errors);
                        if (xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, fieldErrors) {
                                var errorMessage = fieldErrors.join(", ");
                                if (field === 'mobile') {
                                    $('.error_msg_mobile').html(
                                        '<span><li class="mt-2 text-danger">' +
                                        errorMessage + '</li></span>');
                                } else if (field === 'name1') {
                                    $('.error_msg_name1').html(
                                        '<span><li class="mt-2 text-danger">' +
                                        errorMessage + '</li></span>');
                                }
                            });
                        } else {
                            console.log("Error: " + status + " - " + error);
                        }
                    }
                });
            });




            $("#contact_form").submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                formData.append('name', $('input[name="name"]').val());
                formData.append('mobile', $('input[name="mobile1"]').val());
                formData.append('product_id', 0);
                formData.append('inquiry_from', 'Home Page');
                formData.append('message', document.getElementById('message').value);
                formData.append('_method', $('input[name="_method"]').val());

                $.ajax({
                    type: 'POST', // Always use POST method
                    url: "{{ route('inquiry.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response.status === 'success') {
                            if (response.status == 'success') {

                                $('#message1').html(response.message);

                                $('#exampleModal1').modal('show');
                                $('#name').val('');
                                $('#email').val('');
                                $('#mobile1').val('');
                                $('#website').val('');
                                $('#message').val('');
                                $('.error_msg_name').html('');
                                $('.error_msg_email').html('');
                                $('.error_msg_mobile1').html('');
                                $('.error_msg_mobile').html('');
                                $('.error_msg_message').html('');
                                $('.error_msg_captcha').html('');
                                grecaptcha.reset();

                            } else {
                                $('#message1').html(response.message);
                                $('#exampleModal1').modal('show');
                                $('#name').val('');
                                $('#email').val('');
                                $('#mobile1').val('');
                                $('#website').val('');
                                $('#message').val('');
                                $('.error_msg_name').html('');
                                $('.error_msg_email').html('');
                                $('.error_msg_mobile1').html('');
                                $('.error_msg_mobile').html('');
                                $('.error_msg_message').html('');

                                $('.error_msg_captcha').html('');
                                grecaptcha.reset();
                            }



                        }
                    },
                    error: function(xhr, status, error) {
                        grecaptcha.reset();
                        $('.error_msg_mobile1').html('');
                        $('.error_msg_name').html('');
                        $('.error_msg_captcha').html('');
                        $('.error_msg_message').html('');
                        if (xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, fieldErrors) {
                                var errorMessage = fieldErrors.join(", ");
                                if (field === 'name') {
                                    $('.error_msg_name').html(
                                        '<span><li class="mt-2 text-white">' +
                                        errorMessage + '</li></span>');
                                } else if (field === 'mobile') {
                                    $('.error_msg_mobile1').html(
                                        '<span><li class="mt-2 text-white">' +
                                        errorMessage + '</li></span>');
                                } else if (field === 'email') {
                                    $('.error_msg_email').html(
                                        '<span><li class="mt-2 text-white">' +
                                        errorMessage + '</li></span>');
                                } else if (field === 'website') {
                                    $('.error_msg_website').html(
                                        '<span><li class="mt-2 text-white">' +
                                        errorMessage + '</li></span>');
                                } else if (field === 'message') {
                                    $('.error_msg_message').html(
                                        '<span><li class="mt-2 text-white">' +
                                        errorMessage + '</li></span>');
                                } else if (field === 'g-recaptcha-response') {
                                    $('.error_msg_captcha').html(
                                        '<span><li class="mt-2 text-white">' +
                                        errorMessage + '</li></span>');
                                }

                            });
                        } else {
                            console.log("Error: " + status + " - " + error);
                        }
                    }
                });
            });
        });
    </script>
@endsection
