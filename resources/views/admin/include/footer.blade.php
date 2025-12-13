<div id="kt_app_footer" class="app-footer" style="background: radial-gradient(circle, #D9811C, #ff0000);">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">{{ date('Y') }}&copy;</span>
            <!--<a href="https://aazovo.in" target="_blank" class="text-gray-800 text-hover-primary">{{ config('app.name') }}</a>-->
            <a href="javascript:void(0);" class="text-gray-800 text-hover-primary">
                Enquiry Platform</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li class="menu-item">
                <span class="text-muted fw-semibold me-1">Created & Managed By </span>
                <!-- <a href="https://anzo.co.in" target="_blank" class="text-gray-800 text-hover-primary">Anzo
                </a> -->Orbosis Global
            </li>
            {{-- <li class="menu-item">
                <a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
            </li>
            <li class="menu-item">
                <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
            </li> --}}
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div>
{{-- @push('scripts') --}}




<script>
    $(document).ready(function() {
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
                "showDuration": "800",
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
        @if (session()->has('success_message'))
            toastcall('success', "{{ session('success_message') }}");
            // {{ session()->forget('success_message') }};
        @endif




        $('#modal_show').click(function(e) {
            e.preventDefault();
            // Assuming you are using Bootstrap's modal, you can trigger it like this
            $('#kt_modal_1').modal('show');
        });

        var button = document.querySelector("#kt_block_ui_4_button");
        var target = document.querySelector("#kt_block_ui_4_target");

        var blockUI = new KTBlockUI(target);

        button.addEventListener("click", function(e) {
            e.preventDefault();

            blockUI.block();

            var formData = new FormData();
            formData.append('curr_pass', $('#curr_pass').val());
            formData.append('new_pass', $('#new_pass').val());
            formData.append('confirm_pass', $('#confirm_pass').val());

            $.ajax({
                type: "POST",
                url: "{{ route('change_password') }}",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $('#kt_modal_1').modal('hide');
                        toastcall(response.status, response.message);
                        // console.log(response.message);
                        // You can perform additional actions on success
                    } else {
                        // console.log('Failed');
                        // Handle other types of responses or display errors
                        toastcall(response.status, response.message);
                        // console.log(response.errors);
                        $('.text-danger').remove();
                        $('#curr_pass').after('<li class="mt-2 text-danger">' + response
                            .message + '</li>');
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        $('.text-danger').remove();
                        // Loop through each field and print its errors
                        $.each(errors, function(field, fieldErrors) {
                            var errorMessage = fieldErrors.join(", ");
                            $('#' + field).after('<li class="mt-2 text-danger">' +
                                errorMessage + '</li>');
                        });
                        toastcall('error', 'Can\'t Update Password');
                    } else {
                        // Handle other types of errors
                        console.log("Error: " + status + " - " + error);
                    }
                }
            });
            setTimeout(function() {
                blockUI.release();
            }, 3000);
        });





    });







</script>
{{-- @endpush --}}
