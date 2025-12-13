@extends('admin.layout.master')

@section('title', 'Permission')

@section('css')
@endsection

@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-10 mb-0">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-body fw-bold fs-3 flex-column justify-content-center my-0">
                        Permissions</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="route('home')" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Permission List</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->

                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    {{-- <div class="card-toolbar">
                    <a class="btn btn-sm fw-bold btn-secondary" href="{{ url('admin/export-category-count') }}"
                        title="Export">Export</a>
                </div> --}}
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    @canany(['permission add'])
                        <button class="btn btn-sm fw-bold btn-primary btn_method" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_new_target">Add
                            Permission</button>
                    @endcanany
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    {{-- <div class="card-header border-0">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Category wise counting</h2>
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <a class="btn btn-sm fw-bold btn-secondary" href="{{ url('admin/export-category-count') }}"
                            title="Export">Export</a>
                    </div>
                    <!--end::Card toolbar-->
                </div> --}}
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Table-->
                        <table id="data-table" class="table table-rounded table-striped border gy-7 gs-7">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-center text-white fw-bold fs-7 text-uppercase gs-0" style="background: radial-gradient(circle, #D9811C, #ff0000);">


                                    <th class="min-w-150px">Name</th>

                                    <th class="min-w-100px">Actions</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-semibold text-gray-600">
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    <!--begin::Add Modal-->

    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Permission</h5>
                    <div class="btn btn-sm btn-icon btn-active-color-primary close" data-bs-dismiss="modal">
                        <i class="ki-solid ki-cross fs-1"></i>
                    </div>
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="create_permission_form" class="form" action="#">
                        <!--begin::Heading-->
                        @method('POST')
                        <input type="hidden" name="id" id="id">
                        <div class="mb-13 text-center">
                            <!--begin::Title-->

                            <!--end::Title-->
                            <!--begin::Description-->
                            {{-- <div class="text-muted fw-semibold fs-5">Create
                            <a href="#" class="fw-bold link-primary">Prmission</a>.
                        </div> --}}
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Name</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter Permission Name" name="name" id="name" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Display Name</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter Permission Name" name="display_name" id="display_name" />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Display Category</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter Permission Name" name="display_category" id="display_category" />
                        </div>
                        <!--end::Input group-->

                        <div class="text-end">
                            <button type="reset" data-bs-dismiss="modal" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>


    <!--end::Add Modal-->
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
                    url: "{{ route('permission.index') }}",
                    // "data": function(d) {
                    //     d['status'] = $('#status').val();
                    //     d['category_id'] = $('#category_id').val();
                    //     d['sub_category_id'] = $('#sub_category_id').val();
                    //     d['brand_id'] = $('#brand_id').val();
                    // }
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },




                ],
                // order: [[1, "DESC"]]
            });

            oTable1.on('draw', function() {
                KTMenu.createInstances();
            });


            $("#create_permission_form").submit(function(e) {
                e.preventDefault();

                const id = $('#id').val();

                $('.error_msg_image').html('');
                $('.error_msg_title').html('');

                const formData = new FormData(this);
                formData.append('name', $('input[name="name"]').val());




                let url;

                if (id !== '') {
                    formData.append('_method', 'PUT');
                    url = "{{ route('permission.update', ':id') }}".replace(':id', id);
                } else {
                    formData.append('_method', 'POST');

                    url = "{{ route('permission.store') }}";
                }
                $.ajax({
                    type: 'POST', // Always use POST method
                    url: url,
                    //url: "{{ isset($data) ? route('permission.update', $data->id) : route('permission.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    beforeSend: function() {
                        $('#kt_modal_new_target_submit').prop('disabled', true);
                    },
                    success: function(response) {
                        console.log(response);

                        if (response.status === 'success') {
                            toastcall('success', response.message);
                            $('.close').click();
                            // Reload the DataTable
                            $("#create_permission_form")[0].reset();
                            oTable1.draw();

                            // Hide the modal explicitly
                            //    $('#kt_modal_create_campaign').modal('hide');
                            $('#kt_modal_new_target_submit').prop('disabled', false);
                        } else {
                            toastcall('error', response.message);
                            $('#kt_modal_new_target_submit').prop('disabled', false);
                        }
                    },

                    error: function(xhr, status, error) {
                        console.log(xhr.responseJSON.errors);
                        $('#kt_modal_new_target_submit').prop('disabled', false);
                        if (xhr.status == 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, fieldErrors) {
                                var errorMessage = fieldErrors.join(", ");
                                if (field === 'name') {
                                    // $('.error_msg_name').html(
                                    //     '<span><li class="mt-2 text-danger">' +
                                    //     errorMessage + '</li></span>');
                                    toastcall('error', errorMessage);
                                }
                            });
                        } else {
                            // console.log("Error: " + status + " - " + error);
                            toastcall("Error: " + status + " - " + error);
                        }
                    }
                });
            });


        });
        $(document).on('click', '.btn_method', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var display_name = $(this).data('display_name');
            var display_category = $(this).data('display_category')
            $('#id').val(id);
            $('#name').val(name);
            $('#display_name').val(display_name);
            $('#display_category').val(display_category);
        });

        function delete_permission(object) {
            var id = $(object).data("id");

            if (confirm('Are you sure?')) {
                $.ajax({
                    url: "{{ route('permission.destroy', ':id') }}".replace(':id', id),
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
