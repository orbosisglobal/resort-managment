@extends('admin.layout.master')

@section('title', 'View Employee')

@section('css')
@endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-10 mb-0">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-body fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ $user->name }}</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"> <a href="{{ route('user.index') }}"
                                class="text-muted text-hover-primary">Employee</a></li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Employee Details</li>
                    </ul>
                </div>
                <div>
                    @can('user edit')
                        <a href="{{ route('user.edit', ['user' => $user->id]) }}"
                            class="btn btn-sm btn-primary align-self-center">Edit Employee</a>
                    @endcan
                    <a href="" class="btn btn-sm btn-primary align-self-center" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_target">Add Documents</a>
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_general">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_advanced">Documents</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-10 gap-lg-10">
                                <!--begin::Order summary-->
                                <div class="d-flex flex-column flex-xl-row gap-10 gap-lg-10">
                                    <!--begin::Order details-->

                                    <div class="card card-flush py-4 flex-row-fluid">
                                        <!--begin::Card header-->


                                        <div class="card-body p-9">

                                            <!--begin::Row-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Name</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->name }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Email</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->email }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>

                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">phone</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->phone }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>

                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Address</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{!! $user->address !!}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">City</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->city->name }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">State</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->state->name }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>

                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Pincode</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->pincode }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Roles</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">
                                                        {{ $user->roles->pluck('name')->implode(', ') }}
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Department</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $user->department->name }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>

                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">DOB</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $user->d_o_b ? $user->d_o_b->format('d-m-Y') : ' ' }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>

                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Anniversary Date</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $user->anniversary_date ? $user->anniversary_date->format('d-m-Y') : '' }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>

                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Date of Joining</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $user->join_date ? $user->join_date->format('d-m-Y') : '' }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            @if ($user->last_login_date)
                                                <div class="row mb-7">
                                                    <!--begin::Label-->
                                                    <label class="col-lg-4 fw-semibold text-muted">Last Login Date</label>
                                                    <!--end::Label-->
                                                    <!--begin::Col-->
                                                    <div class="col-lg-8">
                                                        <span
                                                            class="fw-bold fs-6 text-gray-800">{{ $user->last_login_date ? $user->last_login_date->format('d-m-Y') : '' }}</span>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                            @endif

                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->

                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Order details-->
                                </div>
                                <!--end::Order summary-->
                                <!--begin::Orders-->

                                <!--end::Orders-->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                            <div class="d-flex flex-column gap-10 gap-lg-10">
                                <div class="d-flex flex-column flex-xl-row gap-10 gap-lg-10">
                                    <div class="card card-flush py-4 flex-row-fluid">

                                        <div class="card-body p-9">
                                            <div class="row mb-7" style="padding-bottom: 17px;border-bottom: 1px solid;">
                                                <div class="col-lg-5">Document Name</div>
                                                <div class="col-lg-5">Document </div>
                                                <div class="col-lg-2">Actions</div>
                                            </div>
                                            @foreach ($user->employeeDocuments as $document)
                                                <div class="row mb-7">
                                                    <div class="col-lg-5"> <label class=" fw-semibold text-muted">
                                                            {{ $document->document_name }}</label></div>
                                                    <div class="col-lg-5">
                                                        @if (Str::endsWith($document->image_url, ['.jpg', '.jpeg', '.png', '.gif']))
                                                            <!-- Show image if it's an image file -->
                                                            <span class="fw-bold fs-6 text-gray-800">
                                                                <img src="{{ $document->image_url }}"
                                                                    alt="Document Image"
                                                                    style="height: 100px;width:100px">
                                                            </span>
                                                        @elseif (Str::endsWith($document->image_url, '.pdf'))
                                                            <!-- Show link if it's a PDF file -->
                                                            <span class="fw-bold fs-6 text-gray-800">
                                                                <a href="{{ $document->image_url }}" target="_blank">View
                                                                    PDF</a>
                                                            </span>
                                                        @else
                                                            <span class="fw-bold fs-6 text-gray-800">File format not
                                                                supported</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-2 d-flex align-items-center">
                                                        <a href="javascript:void(0)" data-id="{{ $document->id }}"
                                                            id="edit_documnet"
                                                            data-document_name="{{ $document->document_name }}"
                                                            class="edit_documnet btn btn-sm btn-icon btn-light btn-active-light-primary btn_method"><i
                                                                class="ki-solid ki-pencil"></i>
                                                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="javascript:void(0)" data-id="{{ $document->id }}"
                                                            id="delete_document"
                                                            class="delete_document btn btn-sm btn-icon btn-light btn-active-light-primary btn_method"><i
                                                                class="ki-solid ki-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Documents</h5>

                    <div class="btn btn-sm btn-icon btn-active-color-primary close" data-bs-dismiss="modal">
                        <i class="ki-solid ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-5 pb-15">
                    <form id="document_upload_form" class="form" method="POST">
                        @method('POST')


                        <div class="d-flex flex-column mb-8 fv-row">
                            <div id="itemsContainer">
                                <div class="row">

                                    <div class="col-md-5 mb-5">

                                        <input type="text" name="document_name[]"
                                            class="form-control item-description" placeholder="Document Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="file" name="image[]" class="form-control price"
                                            placeholder="Price">
                                    </div>

                                    <div class="col-md-2 d-flex">
                                        <button type="button" class="btn btn-primary"
                                            style="height: 34px;width: 34px !important;padding: 2px 11px;"
                                            id="addButton"><i class="fa fa-add"></i></button>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="text-end">
                            <button type="reset" data-bs-dismiss="modal" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="kt_modal_new_target_edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Document</h5>

                    <div class="btn btn-sm btn-icon btn-active-color-primary close" data-bs-dismiss="modal">
                        <i class="ki-solid ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-5 pb-15">
                    <form id="document_upload_edit" class="form" method="POST">
                        @method('POST')

                        <input type="hidden" name="id" id="id">
                        <div class="d-flex flex-column mb-8 fv-row">
                            <div id="itemsContainer">
                                <div class="row">

                                    <div class="col-md-5 mb-5">

                                        <input type="text" name="document_name1" id="document_name1"
                                            class="form-control item-description" placeholder="Document Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="file" name="image1" class="form-control price"
                                            placeholder="Price">
                                    </div>


                                </div>

                            </div>

                        </div>
                        <div class="text-end">
                            <button type="reset" data-bs-dismiss="modal" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        let itemId = 0;

        function addItem() {
            const itemsContainer = document.getElementById('itemsContainer');

            const itemDiv = document.createElement('div');
            itemDiv.classList.add('row');

            itemDiv.innerHTML = `
        <div class="col-md-5 mb-5">
            <input type="text" name="document_name[]" class="form-control item-description" placeholder="Document"  >
        </div>
        <div class="col-md-5">
            <input type="file" name="image[]" class="form-control price" placeholder="Price"   >
        </div>
        <div class="col-md-2 d-flex">
            <button type="button" class="btn btn-danger remove-item" style="
    padding: 7px 11px;!; height: 35px; width: 35px;">
                <i class="fa fa-trash" style="font-size: 15px;"></i>
            </button>
        </div>
    `;

            itemsContainer.appendChild(itemDiv);
            itemId++;

            // Attach the remove event only to the new button added
            const removeButton = itemDiv.querySelector('.remove-item');
            removeButton.addEventListener('click', removeItem);
        }

        function removeItem(event) {
            const itemDiv = event.target.closest('.row');
            if (itemDiv) {
                itemDiv.remove();

            }
        }

        document.getElementById('addButton').addEventListener('click', addItem);

        $("#document_upload_form").submit(function(e) {
            e.preventDefault();

            const id = {{ $user->id }};

            $('.error_msg_image').html('');
            $('.error_msg_title').html('');

            const formData = new FormData(this);




            let url;

            url = "{{ route('upload.document', ':user') }}".replace(':user', id);

            $.ajax({
                type: 'POST', // Always use POST method
                url: url,
                //url: "{{ isset($data) ? route('state.update', $data->id) : route('state.store') }}",
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
                        window.location.reload();


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







        $("#document_upload_edit").submit(function(e) {
            e.preventDefault();

            const id = {{ $user->id }};

            $('.error_msg_image').html('');
            $('.error_msg_title').html('');

            const formData = new FormData(this);




            let url;

            url = "{{ route('edit.document', ':user') }}".replace(':user', id);

            $.ajax({
                type: 'POST', // Always use POST method
                url: url,
                //url: "{{ isset($data) ? route('state.update', $data->id) : route('state.store') }}",
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
                        window.location.reload();


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



        $('.delete_document').on('click', function(e) {
            e.preventDefault(); // Correctly prevent the default action
            var id = $(this).data('id');

            if (confirm('Are you sure?')) {
                $.ajax({
                    url: "{{ route('destroy.document') }}", // Ensure this is the correct route
                    dataType: "json",
                    type: "DELETE",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastcall('success', response.message);
                            window.location.reload(); // Corrected typo
                        } else {
                            toastcall('error', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + xhr.status + " - " + xhr
                            .statusText); // Log errors if any
                    }
                });
            }
        });




        $('.edit_documnet').on('click', function(e) {
            var id = $(this).data('id');
            var document_name = $(this).data('document_name');
            $id = $('#id').val(id);
            $id = $('#document_name1').val(document_name);
            $('#kt_modal_new_target_edit').modal('show');

        });




        // $("#document_edit_form").submit(function(e) {
        //     e.preventDefault();

        //     const id = {{ $user->id }};

        //     $('.error_msg_image').html('');
        //     $('.error_msg_title').html('');

        //     const formData = new FormData(this);




        //     let url;

        //     url = "{{ route('edit.document', ':user') }}".replace(':user', id);

        //     $.ajax({
        //         type: 'POST', // Always use POST method
        //         url: url,
        //         //url: "{{ isset($data) ? route('state.update', $data->id) : route('state.store') }}",
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },

        //         beforeSend: function() {
        //             $('#kt_modal_new_target_submit').prop('disabled', true);
        //         },
        //         success: function(response) {
        //             console.log(response);

        //             if (response.status === 'success') {
        //                 toastcall('success', response.message);
        //                 $('.close').click();
        //                 // Reload the DataTable
        //                 window.location.reload();


        //                 // Hide the modal explicitly
        //                 //    $('#kt_modal_create_campaign').modal('hide');
        //                 $('#kt_modal_new_target_submit').prop('disabled', false);
        //             } else {
        //                 toastcall('error', response.message);
        //                 $('#kt_modal_new_target_submit').prop('disabled', false);
        //             }
        //         },

        //         error: function(xhr, status, error) {
        //             console.log(xhr.responseJSON.errors);
        //             $('#kt_modal_new_target_submit').prop('disabled', false);
        //             if (xhr.status == 422) {
        //                 var errors = xhr.responseJSON.errors;
        //                 $.each(errors, function(field, fieldErrors) {
        //                     var errorMessage = fieldErrors.join(", ");
        //                     if (field === 'name') {
        //                         // $('.error_msg_name').html(
        //                         //     '<span><li class="mt-2 text-danger">' +
        //                         //     errorMessage + '</li></span>');
        //                         toastcall('error', errorMessage);
        //                     }
        //                 });
        //             } else {
        //                 // console.log("Error: " + status + " - " + error);
        //                 toastcall("Error: " + status + " - " + error);
        //             }
        //         }
        //     });
        // });
    </script>
@endpush
