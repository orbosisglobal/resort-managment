@extends('admin.layout.master')

@section('title', isset($data) ? 'Edit ' . 'Employee' : 'Create ' . 'Employee')

@section('css')
@endsection

@section('content')

    <div class="d-flex flex-column flex-column-xxl">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-10 mb-0">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-gray-900 fw-bold fs-3 m-0">
                            {{ isset($data) ? 'Edit' : 'Add' }} Employee</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Employee</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">{{ isset($data) ? 'Edit' : 'Add' }} Employee</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->

                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-xxl">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Form-->
                <form id="{{ isset($data) ? 'edit' : 'create' }}_user_form" class=" d-flex flex-column flex-lg-row"
                    method="POST" enctype="multipart/form-data" autocomplete="off">
                    <!--begin::Aside column-->
                    @csrf
                    @if (isset($data))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif

                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                        <div class="tab-pane fade show active" id="add_user" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>General</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 row">
                                        <!--begin::Input group-->
                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class="required  form-label">Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="name" class="form-control mb-2"
                                                placeholder="Enter name" value="{{ old('name', $data->name ?? '') }}"
                                                id="name" required />
                                            <!--end::Input-->
                                            <span class="error_msg_name"></span>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->

                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class="required form-label">Username</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="username" id="username" class="form-control mb-2"
                                                placeholder="Enter username" value="{{ old('username', $data->username ?? '') }}"
                                                required />
                                            <!--end::Input-->
                                            <span class="error_msg_username"></span>

                                        </div>
                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class="form-label {{ isset($data) ? '' : 'required' }}">Password</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" name="password" id="password" class="form-control mb-2"
                                                placeholder="Enter password {{isset($data) ? ' (If want to change)' : '' }}" value=""
                                                {{ isset($data) ? '' : 'required' }}   autocomplete="new-password" autocorrect="off" autocapitalize="off"/>
                                            <!--end::Input-->
                                            <span class="error_msg_password"></span>

                                        </div>
                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class=" form-label">Email</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" id="email" class="form-control mb-2"
                                                placeholder="Enter Email" value="{{ old('email', $data->email ?? '') }}"
                                                 />
                                            <!--end::Input-->
                                            <span class="error_msg_email"></span>

                                        </div>
                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class="required form-label">Phone Number</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="phone" id="phone" class="form-control mb-2"
                                                placeholder="Enter Phone Number"
                                                value="{{ old('phone', $data->phone ?? '') }}" required />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            {{-- <div class="text-muted fs-7">A company name is   and
                                                recommended to be unique.</div> --}}
                                            <!--end::Description-->
                                            <span class="error_msg_phone"></span>

                                        </div>

                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class=" required form-label">Address</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea name="address" id="address" class="form-control mb-2" placeholder="Enter Address" required>{{ old('address', $data->address ?? '') }}</textarea>
                                            <!--end::Input-->
                                            <span class="error_msg_address"></span>

                                        </div>
                                        <div class="col-md-3 mb-10 " style="display: none">
                                            <!--begin::Label-->
                                            <label class="required  form-label">State</label>

                                            <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                                id="state_id" name="state_id" data-placeholder="Select an option" required>
                                                <option></option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}"
                                                        {{ old('state_id', $data->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="error_msg_state_id"></span>

                                        </div>

                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class="required  form-label">City</label>
                                            <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                                id="city_id" name="city_id" data-placeholder="Select an option" required>
                                                <option></option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ old('city_id', $data->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}({{ $city->state->name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="error_msg_city_id"></span>

                                        </div>

                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class="required  form-label">Pincode</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" name="pincode" id="pincode"
                                                class="form-control mb-2" placeholder="Enter Pincode"
                                                value="{{ old('pincode', $data->pincode ?? '') }}" required />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            {{-- <div class="text-muted fs-7">A company name is   and
                                                recommended to be unique.</div> --}}
                                            <!--end::Description-->
                                            <span class="error_msg_pincode"></span>

                                        </div>




                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class="required  form-label">Roles</label>

                                            <select class="form-select mb-2" data-control="select2"
                                                data-hide-search="true" id="role" name="role[]"
                                                data-placeholder="Select an option" multiple required>
                                                <option>Select Option</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}"
                                                        {{ isset($data) ? (in_array($role, $userRoles) ? 'selected' : '') : '' }}>
                                                        {{ $role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="error_msg_role"></span>

                                        </div>

                                        <div class="col-md-3 mb-10 ">
                                            <!--begin::Label-->
                                            <label class="required  form-label">Status</label>

                                            <select class="form-select mb-2" data-control="select2"
                                                data-hide-search="true" id="status" name="status"
                                                data-placeholder="Select an option" required>
                                                <option></option>
                                                <option value="Active"
                                                    {{ isset($data) ? ($data->status == 'Active' ? 'selected' : '') : 'selected' }}>
                                                    Active</option>
                                                <option value="Blocked"
                                                    {{ isset($data) ? ($data->status == 'Blocked' ? 'selected' : '') : '' }}>
                                                    Blocked</option>
                                                <option value="Terminate"
                                                    {{ isset($data) ? ($data->status == 'Terminate' ? 'selected' : '') : '' }}>
                                                    Terminate</option>

                                            </select>
                                            <span class="error_msg_status"></span>

                                        </div>







                                        <div class="col-md-3 mb-10">
                                            <label for="" class="form-label">Profile picture</label>
                                            <input type="file" class="form-control" placeholder="Pick a date" id="profilepic"
                                                name="profilepic" />
                                            <span class="error_msg_profilepic"></span>
                                        </div>

                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                @if (!isset($data))
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Upload Documents</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0 row">
                                            <div class="container">
                                                <div id="itemsContainer">


                                                </div>
                                                <span class="error_msg_image"></span>
                                                <button type="button" id="addButton" class="btn btn-primary my-2">Add
                                                    Document</button>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!--end::Tab pane-->


                        <!--end::Tab content-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{ route('user.index') }}" id="cancel" class="btn btn-light me-5">Cancel</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->


@endsection
@push('scripts')
    <script>
        var isEdit12 = {{ isset($data) ? 'true' : 'false' }};
        if (!isEdit12) {
            let itemId

            function addItem() {
                const itemsContainer = document.getElementById('itemsContainer');

                const itemDiv = document.createElement('div');
                itemDiv.classList.add('row');

                itemDiv.innerHTML = `
            <div class="col-md-5 mb-5">
                <input type="text" name="document_name[]" class="form-control item-description" placeholder="Document Name"  required >
            </div>
            <div class="col-md-5">
                <input type="file" name="image[]" class="form-control price" placeholder="Price"   required >
            </div>

            <div class="col-md-2 d-flex">
                <button type="button" class="btn btn-danger remove-item" style="
    padding: 7px 11px;!; height: 35px; width: 35px;"> <i class="fa fa-trash" style="font-size: 15px;"></i></button>
            </div>

        `;

                itemsContainer.appendChild(itemDiv);
                itemId++;


                const removeButtons = document.querySelectorAll('.remove-item');
                removeButtons.forEach(button => {
                    button.addEventListener('click', removeItem);
                });
            }

            function removeItem(event) {
                const itemDiv = event.target.closest('.row');
                if (itemDiv) {
                    itemDiv.remove();

                }
            }

            document.getElementById('addButton').addEventListener('click', addItem);

        }

        $(document).ready(function() {
       


            $('#state_id').select2({
                dropdownParent: $('#{{ isset($data) ? 'edit' : 'create' }}_user_form')
            });
            $('#city_id').select2({
                dropdownParent: $('#{{ isset($data) ? 'edit' : 'create' }}_user_form')
            });

            $('#role').select2({
                dropdownParent: $('#{{ isset($data) ? 'edit' : 'create' }}_user_form')
            });

            $(document).on('change', '#city_id', function() {
                var id = $(this).val();
                console.log(id);

                $.ajax({
                    url: "{{ route('get.state') }}", // Ensure this is the correct route
                    dataType: "json",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#state_id').val(response.message).trigger('change');
                        } else {
                            toastcall('error', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Error: " + xhr.status + " - " + xhr
                            .statusText); // Log errors if any
                    }
                });
            });

            var isEdit = @json(isset($data));
            var existingImageUrl = isEdit ?
                "{{ asset('storage/uploads/users/' . ($data->image ?? '')) }}" :
                null;


            if (isEdit) {
                $('#image').css("background-image", "url('" + existingImageUrl + "')");
            }
            var url =
                "{{ isset($data) ? route('user.update', ['user' => $data->id]) : route('user.store') }}"
            console.log(url)
            // Form submission using Ajax
            $("#{{ isset($data) ? 'edit' : 'create' }}_user_form").submit(function(e) {
                e.preventDefault();
                $('.error_msg_image').html('');
                $('.error_msg_title').html('');

                var formData = new FormData(this);

                // Assume isEdit is defined somewhere in your script
                var isEdit = {{ isset($data) ? 'true' : 'false' }};


                // Set method for Laravel to recognize it as a PUT request
                formData.append('_method', $('input[name="_method"]').val());

                $.ajax({
                    type: 'POST', // Always use POST method
                    url: "{{ isset($data) ? route('user.update', ['user' => $data->id]) : route('user.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastcall('success', response.message);
                            window.location.href = "{{ route('user.index') }}";
                        } else {
                            toastcall('error', response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status == 422) {
                            // Clear existing error messages
                            $('.error_msg_name').html('');
                            $('.error_msg_email').html('');
                            $('.error_msg_password').html('');
                            $('.error_msg_phone').html('');
                            $('.error_msg_address').html('');
                            $('.error_msg_state_id').html('');
                            $('.error_msg_city_id').html('');
                            $('.error_msg_pincode').html('');
                            $('.error_msg_department_id').html('');
                            $('.error_msg_company_id').html('');
                            $('.error_msg_role').html('');
                            $('.error_msg_image').html(''); // For image field errors

                            var errors = xhr.responseJSON.errors;

                            $.each(errors, function(field, fieldErrors) {
                                var errorMessage = fieldErrors.join(", ");

                                // Handling image fields like 'image.0', 'image.1', etc.
                                if (field.startsWith('image')) {
                                    $('.error_msg_image').append(
                                        '<span><li class="mt-2 text-danger">' +
                                        errorMessage + '</li></span>'
                                    );
                                } else {
                                    $('.error_msg_' + field).html(
                                        '<span><li class="mt-2 text-danger">' +
                                        errorMessage + '</li></span>'
                                    );
                                }
                            });
                        } else {
                            console.log("Error: " + xhr.status + " - " + xhr.statusText);
                        }
                    }

                });
            });

        });
    </script>
@endpush
