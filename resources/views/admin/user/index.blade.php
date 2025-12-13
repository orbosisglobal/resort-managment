@extends('admin.layout.master')

@section('title', ' Employee')

@section('css')
@endsection

@section('content')

    <div class="d-flex flex-column flex-column-fluid">

        <div id="kt_app_toolbar" class="app-toolbar pt-10 mb-0">

            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">

                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

                    <h1 class="page-heading d-flex text-body fw-bold fs-3 flex-column justify-content-center my-0">
                        Employees</h1>

                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                        <li class="breadcrumb-item text-muted">
                            <a href="route('home')" class="text-muted text-hover-primary">Home</a>
                        </li>

                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>

                        <li class="breadcrumb-item text-muted">Employee List</li>

                    </ul>

                </div>


                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="#"
                        class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                        <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        Filter
                    </a>

                    <div class="menu menu-sub menu-sub-dropdown w-400px w-md-400px" data-kt-menu="true"
                        id="kt_menu_63de8ae2479d6">

                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">Filter Options</div>
                        </div>

                        <div class="separator border-gray-200"></div>

                        <form action="" method="POST" class="cat-filter-form" id="cat-filter-form">
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Status:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid status" data-kt-select2="true"
                                            data-dropdown-parent="#kt_menu_63de8ae2479d6" data-allow-clear="false"
                                            name="status" id="status">
                                            <option value="">Select Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Blocked">Blocked</option>
                                            <option value="Terminate">Terminate</option>

                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->

                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Role</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid" data-kt-select2="true"
                                            data-dropdown-parent="#kt_menu_63de8ae2479d6" data-allow-clear="false"
                                            name="role_id" id="role_id">
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->

                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset" data-bs-dismiss="modal"
                                        class="btn btn-sm btn-light btn-active-light-primary me-2 filter-btn"
                                        data-kt-menu-dismiss="true">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-primary filter-btn"
                                        data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                        </form>

                    </div>
                    @canany(['user add'])
                        <a href="{{ route('user.create') }}" class="btn btn-sm fw-bold btn-primary">Add
                            Employee</a>
                    @endcanany

                </div>

            </div>

        </div>

        <div class="app-content flex-column-fluid">

            <div class="app-container container-fluid">

                <div class="card">

                    <div class="card-body ">

                        <table id="data-table" class="table table-rounded table-striped border gy-7 gs-7">

                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-center text-white fw-bold fs-7 text-uppercase gs-0" style="background: radial-gradient(circle, #D9811C, #ff0000);">
                                    <th>Actions</th>
                                    <th>Status</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>

                                    <th>Role</th>




                                </tr>
                                <!--end::Table row-->
                            </thead>

                            <tbody class="fw-semibold text-gray-600">
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>


@endsection

@push('scripts')
    <script>
        // $('.dateRangePicker').daterangepicker({
        //     autoUpdateInput: false,
        //     locale: {
        //         cancelLabel: 'Clear'
        //     },
        //     maxDate: moment()
        // });

        // $('.dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
        //     $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        // });

        // $('.dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
        //     $(this).val('');
        //     $(this).data('daterangepicker').setStartDate(moment());
        //     $(this).data('daterangepicker').setEndDate(moment());
        // });
        var oTable1;

        $(document).ready(function() {
            if (document.getElementById('data-table')) {
                                var domLayout = "";
        if (window.innerWidth < 890) {

            // Mobile layout
            domLayout =
                "<'row'<'col-sm-2'<'#custom-search-container'f>><'col-sm-7'><'col-sm-3 d-flex justify-content-end'<'#status-search'>>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row my-2'<'col'<'row'<'col-md-2'l><'col-md-10'>>>" +
                "<'col d-flex justify-content-end text-right'p>" +
                "<'col-md-8'<'row'<'col-md-8'i>>>>";
        } else {
            // Desktop layout
            domLayout =
                "<'row'<'col-sm-2'<'#custom-search-container'f>><'col-sm-7'><'col-sm-3 d-flex justify-content-end'<'#status-search'>>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row my-2'<'col-md-4'<'row'<'col-md-3'l><'col-md-9'>>>" +
                "<'col-md-8'<'row'<'col-md-8 pt-2'i><'col-sm-4 d-flex justify-content-end text-right'p>>>>";
        }



                oTable1 = $('#data-table').DataTable({
            dom: domLayout,

                    processing: true,
                    serverSide: true,
                    pageLength: 10,
                    iDisplayLength: 10,
                    responsive: false,
                    aaSorting: [],
                    scrollX: true,
                    scrollY: true,
                    searching: true,
                    searchDelay: 500,
                    initComplete: function() {
                        // Custom search input HTML
                        const searchInput = `
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-solid ki-magnifier fs-3 position-absolute ms-4"></i>
                            <input type="text" id="custom-search" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search " />
                        </div>
                    `;




                        // Append custom search input and status selection to the DataTable
                        $('#custom-search-container').html(searchInput);

                        $('.paging_simple_numbers').removeClass('dt-paging');
                        // Implement search functionality
                        const table = this.api();

                        // Custom search input
                        $('#custom-search').on('keyup change', function() {
                            table.search($(this).val()).draw();
                        });

                        // Status filter functionality

                    },
                    "ajax": {
                        "url": "{{ route('user.index') }}",
                        "data": function(d) {
                            d['status'] = $('#status').val();
                            d['role_id'] = $('#role_id').val();
                            d['department_id'] = $('#department_id').val();
                        }
                    },

                    columns: [{
                            data: 'action',
                            name: 'action',
                            orderable: false
                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'role',
                            name: 'role'
                        },




                    ],

                });

            }

            $('.filter-btn').on('click', function(e) {
                e.preventDefault();
                var formType = $(this).attr('type');
                if (formType == 'reset') {
                    $("#status").val(null).trigger("change");
                    $("#category_id").val(null).trigger("change");
                    $("#sub_category_id").val(null).trigger("change");
                    $("#brand_id").val(null).trigger("change");
                    $(this).closest('form')[0].reset();
                }
                oTable1.draw();
            });
        });

        oTable1.on('draw', function() {
            KTMenu.createInstances();
        });


        function delete_service(object) {
            var id = $(object).data("id");

            if (confirm('Are you sure?')) {
                $.ajax({
                    url: "{{ route('user.destroy', ':id') }}".replace(':id', id),
                    "dataType": "json",
                    "type": "DELETE",
                    "data": {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response.status);
                        if (response.status == 'success') {
                            oTable1.draw();

                            toastcall('success', response.message);
                        } else {
                            toastcall('error', response.message);
                        }
                    }
                });
            }
        }
    </script>
@endpush
