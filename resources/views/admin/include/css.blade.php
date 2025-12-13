        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="{{ asset('admin/assets1/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('admin/assets1/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
            type="text/css" />
        <!--end::Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('admin/assets1/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets1/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.0/countUp.min.js"
            integrity="sha512-E0zfDwA1CopT4gzJmj9tMpd7O6pTpuybTK58eY1GwqptdasUohyImuualLt/S5XvM8CDnbaTNP/7MU3bQ5NmQg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

        <style type="text/css">
            div.dataTables_wrapper div.dataTables_filter {
                text-align: left !important;
            }

            label.error {
                color: #ff0000 !important;
            }

            .fs_40 {
                font-size: 40px !important;
            }

            .radio-group {
                display: flex;
                /* Ensures the radio buttons are side by side */
                gap: 10px;
                /* Adds space between the radio buttons */
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .radio-label {
                border: 2px solid #ddd;
                padding: 10px 10px;
                border-radius: 5px;
                display: flex;
                align-items: center;
                cursor: pointer;
                WIDTH: 50%;
            }

            input[type="radio"]:checked {
                accent-color: #cd5e20;
                /* Change color to red when checked */
            }


            input[type="radio"] {
                height: 17px;
                width: 17px;
                margin: 0px;
                margin-right: 6px;
            }
        </style>
        <link href="{{ asset('admin/assets1/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('admin/assets1/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
            type="text/css" />
        <script src="{{ asset('admin/assets1/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
        {{-- <script src="{{ asset('admin/assets1/js/components') }}"></script> --}}
