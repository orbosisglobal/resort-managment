<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>Enquiry Platform</title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Enquiry Platform admin portal." />
    <meta property="og:url" content="https://127.0.0.1:8000/" />
    <meta property="og:site_name" content="Enquiry Platform " />
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('admin/assets1/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets1/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <style>
        .logo-img {
            width: 120px; /* Mobile default */
        }

        @media (min-width: 990px) {
            .logo-img {
                width: 200px; /* Desktop view */
            }
        }
        .full-height-center {
            min-height: 100vh; /* full screen height */
            display: flex;
            align-items: center; /* vertical center */
            justify-content: center; /* horizontal center if needed */
        }
    </style>
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-position-center bgi-no-repeat bgi-size-cover">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url({{ asset('admin/assets1/media/auth/bg6.jpg') }});
            }

            [data-bs-theme="dark"] body {
                background-image: url({{ asset('admin/assets1/media/auth/bg6.jpg') }});
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row full-height-center">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 mt-5">
                <div class="d-flex flex-row flex-lg-column align-items-center align-items-lg-start">
                    <!-- Logo 1 -->
                    <a href="." class="mb-0 mb-lg-3 me-3 me-lg-0 text-center">
                        <img alt="Logo" class="logo-img" src="{{ asset('admin/assets1/media/logos/orbosis.png') }}" />
                    </a>

                    <!-- Logo 2 -->

                </div>
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-center w-lg-50">
                <!--begin::Card-->
                <div class="card rounded-3 w-md-550px mt-5 mb-5">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-column p-10 p-lg-20 ">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column-fluid">
                            <!--begin::Form-->
                            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                                action="{{ route('login') }}" autocomplete="off">

                                @csrf
                                <input id="UserTimezone" type="hidden" class="form-control" name="timezone"
                                    value="">
                                <!--begin::Heading-->
                                <div class="text-center mb-8">
                                    <!--begin::Title-->
                                    <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                                    <!--end::Title-->
                                    <!--begin::Subtitle-->
                                    <div class="text-gray-500 fw-semibold fs-6">Enquiry Platform</div>
                                    <!--end::Subtitle=-->
                                </div>
                                <!--begin::Heading-->

                                <!--begin::Input group=-->
                                <div class="fv-row mb-6">
                                    <!--begin::Email-->
                                    <input type="text" placeholder="Enter Username" name="email" autocomplete="off"
                                        class="form-control bg-transparent {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        required />

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    <!--end::Email-->
                                </div>
                                <!--end::Input group=-->
                                <div class="position-relative mb-3" data-kt-password-meter="true">
                                    <!--begin::Password-->
                                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                                        class="form-control bg-transparent {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        required />
                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>

                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>

                                    <!--end::Password-->
                                </div>
                                 @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                <!--end::Input group=-->
                                @if ($errors->has('user-auth-failed'))
                                    <span class="invalid-feedback d-block mb-3" role="alert">
                                        <strong>{{ $errors->first('user-auth-failed') }}</strong>
                                    </span>
                                @endif
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Submit button-->
                                <div class="d-grid mb-5">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label">Sign In</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->
                                        <span class="indicator-progress" style="display: none;">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Submit button-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <script>
        $(document).ready(function() {
            $('#kt_sign_in_form').submit(function(e) {
                // Prevent the default form submission
                e.preventDefault();

                // Reference to the button
                var submitButton = $('#kt_sign_in_submit');

                // Toggle the visibility of the indicator label and spinner
                $('.indicator-label, .indicator-progress').toggle();

                // Disable the button
                submitButton.prop('disabled', true);

                // Perform your asynchronous operations if needed
                // For example, you can make an AJAX call here

                // Once your operations are done, trigger the form submission
                this.submit();
            });

            function toastcall(type, msg) {
                var type = type;
                var msg = msg;
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toastr-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                if (type == 'success') {
                    toastr.success(msg, 'Success');
                } else if (type == 'info') {
                    toastr.info(msg, 'Infor');
                } else if (type == 'warning') {
                    toastr.warning(msg, 'Warning');
                } else if (type == 'error') {
                    toastr.error(msg, 'Error');
                }
            }

            // Check if the 'success' session variable is set
            @if (session()->has('error_message'))
                toastcall('error', "{{ session('error_message') }}");
                {{ session()->forget('error_message') }}
            @endif

        });
    </script>
    @include('admin/include.js')
</body>
<!--end::Body-->

</html>
