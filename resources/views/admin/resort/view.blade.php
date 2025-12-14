@extends('admin.layout.master')

@section('title', 'View Customer')

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
                        {{ $customer->name }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted"> <a
                                href="{{ route('customer.index', ['id' => $customer->category_id]) }}"
                                class="text-muted text-hover-primary">Customer</a></li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Customer Details</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->

                </div>
                <div>
                    @can('customer edit')
                        <a href="{{ route('customer.edit', ['id' => $customer->id]) }}"
                            class="btn btn-sm btn-primary align-self-center">Edit Customer</a>
                    @endcan
                    <a href="" class="btn btn-sm btn-primary align-self-center" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_new_target">Add Site</a>
                    <a href="" class="btn btn-sm btn-primary align-self-center" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_contact">Add Contact</a>
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Order details page-->


                <div class="d-flex flex-column gap-10 gap-lg-10">
                    <!--begin::Order summary-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_general">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_product_advanced">Site Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                href="#kt_ecommerce_add_phone">Contact Management</a>
                        </li>
                    </ul>
                    <!--begin::Order details-->

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="card card-flush py-4 flex-row-fluid">
                                <!--begin::Card header-->


                                <div class="card-body p-9">
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Company Name</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->company_name }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--begin::Row-->
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Name</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->name }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Email</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->email }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">phone</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->phone }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Address</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{!! $customer->address !!}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">City</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->city->name }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">State</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->state->name }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Pincode</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->pincode }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Bank Name</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->bank_name }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Branch Name</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->branch_name }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Account Number</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->account_number }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">IFSC Code</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->ifsc_code }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Gst Number</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->gst_number }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-7">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 fw-semibold text-muted">Pan Number</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $customer->pan_number }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>


                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->

                                <!--end::Card body-->
                            </div>
                        </div>
                        <div class="tab-pane fade " id="kt_ecommerce_add_product_advanced" role="tab-panel">
                            <div class="row">
                                @foreach ($customer->siteManagement as $site)
                                    <div class="col-md-6 col-xl-4 card border-hover-primary mx-2">
                                        <!--begin::Card-->

                                        <!--begin::Card header-->
                                        <div class="card-header border-0 px-9 pt-5 border-hover-primary"
                                            style="align-items: center;">
                                            <!--begin::Card Title-->
                                            <div class="card-title m-0">
                                                <!--begin::Avatar-->
                                                <div class="fs-3 fw-bold text-gray-900">{{ $site->name }}</div>
                                                <!--end::Avatar-->
                                            </div>
                                            <!--end::Car Title-->
                                            <!--begin::Card toolbar-->
                                            <div class="symbol-hover">
                                                <!--begin::User-->
                                                <a href="javascript:void(0)" class="edit_documnet"
                                                    data-id={{ $site->id }} data-address="{{ $site->address }}"
                                                    data-name="{{ $site->name }}"
                                                    data-manager_number="{{ $site->manager_number }}"
                                                    data-manager_name="{{ $site->manager_name }}"
                                                    data-city_id="{{ $site->city_id }}"
                                                    data-state_id="{{ $site->state_id }}">
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit" data-kt-initialized="1">
                                                        <span
                                                            class="symbol-label bg-primary text-inverse-warning fw-bold"><i
                                                                class="ki-solid ki-pencil"
                                                                style="color: white;font-size: 15px;"></i></span>
                                                    </div>
                                                </a>
                                                <!--begin::User-->
                                                <!--begin::User-->
                                                <a href="javascript:void(0)" data-id="{{ $site->id }}"
                                                    id="delete_document" class="delete_document">
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Rob Otto" data-kt-initialized="1">
                                                        <span
                                                            class="symbol-label bg-danger text-inverse-success fw-bold"><i
                                                                class="ki-solid ki-trash"
                                                                style="color: white;font-size: 15px;"></i></span>
                                                    </div>
                                                </a>
                                                <!--begin::User-->
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end:: Card header-->
                                        <!--begin:: Card body-->
                                        <div class="card-body px-9 pt-2">
                                            <!--begin::Name-->

                                            <p>Address : <span
                                                    class="text-gray-500 fw-semibold fs-5 mt-1 mb-2">{{ $site->address }}</span>
                                            </p>
                                            <p>City : <span
                                                    class="text-gray-500 fw-semibold fs-5 mt-1 mb-2">{{ $site->city->name }}</span>
                                            </p>
                                            <p>State : <span
                                                    class="text-gray-500 fw-semibold fs-5 mt-1 mb-2">{{ $site->state->name }}</span>
                                            </p>
                                            <!--end::Description-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-wrap mb-5">
                                                <!--begin::Due-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                                    <div class="fs-6 text-gray-800 fw-bold">Manager Name</div>
                                                    <div class="fw-semibold text-gray-500">{{ $site->manager_name }}
                                                    </div>
                                                </div>
                                                <!--end::Due-->
                                                <!--begin::Budget-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                                    <div class="fs-6 text-gray-800 fw-bold">Manager Number</div>
                                                    <div class="fw-semibold text-gray-500">{{ $site->manager_number }}
                                                    </div>
                                                </div>
                                                <!--end::Budget-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Progress-->

                                            <!--end::Progress-->
                                            <!--begin::Users-->

                                            <!--end::Users-->
                                        </div>
                                        <!--end:: Card body-->

                                        <!--end::Card-->
                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div class="tab-pane fade " id="kt_ecommerce_add_phone" role="tab-panel">
                            <div class="card card-flush py-4 flex-row-fluid">
                                <!--begin::Card header-->


                                <div class="card-body p-9">
                                    <div class="row">
                                        <div class="row mb-7" style="padding-bottom: 17px;border-bottom: 1px solid;">
                                            <div class="col-lg-3">Contact Name</div>
                                            <div class="col-lg-3">Contact Position</div>
                                            <div class="col-lg-3">Contact Number</div>
                                            <div class="col-lg-3">Actions</div>
                                        </div>
                                        @foreach ($customer->phonebook as $phone)
                                            <div class="row mb-7">
                                                <div class="col-lg-3"> <label class=" fw-semibold text-muted">
                                                        {{ $phone->contact_name }}</label></div>
                                                <div class="col-lg-3">
                                                    <label class=" fw-semibold text-muted">
                                                        {{ $phone->contact_position }}</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class=" fw-semibold text-muted">
                                                        {{ $phone->contact_number }}</label>
                                                </div>
                                                <div class="col-lg-3 d-flex align-items-center">
                                                    <a href="javascript:void(0)" data-id="{{ $phone->id }}"
                                                        id="edit_contact" data-contact_name="{{ $phone->contact_name }}"
                                                        data-contact_position="{{ $phone->contact_position }}"
                                                        data-contact_number="{{ $phone->contact_number }}"
                                                        class="edit_contact btn btn-sm btn-icon btn-light btn-active-light-primary btn_method"><i
                                                            class="ki-solid ki-pencil"></i>
                                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="javascript:void(0)" data-id="{{ $phone->id }}"
                                                        id="delete_contact"
                                                        class="delete_contact btn btn-sm btn-icon btn-light btn-active-light-primary btn_method"><i
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
                    </ <!--end::Order details-->

                    <!--end::Order summary-->
                    <!--begin::Orders-->

                    <!--end::Orders-->
                </div>
                <!--end::Order details page-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-1000px">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Site</h5>

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
                                    <div class="col-md-4 mb-5">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Site Name</span>

                                        </label>
                                        <input type="text" name="name" id="name" class="form-control price"
                                            placeholder="Name" required>
                                        <span class="error_msg_name"></span>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="">Site Manager Name</span>

                                        </label>
                                        <input type="text" name="manager_name" id="manager_name"
                                            class="form-control price" placeholder="Manager Name" >
                                        <span class="error_msg_manager_name"></span>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="">Siter Manager Number</span>

                                        </label>
                                        <input type="number" name="manager_number" id="manager_number"
                                            class="form-control price" placeholder="Manager Number" >
                                        <span class="error_msg_manager_number"></span>
                                    </div>

                                    <div class="col-md-4 mb-5">
                                        <!--begin::Label-->
                                        <label class="  form-label required">Address</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea name="address" id="address" class="form-control mb-2" placeholder="Enter Address">{{ old('address', $data->address ?? '') }}</textarea>
                                        <!--end::Input-->
                                        <span class="error_msg_address"></span>

                                    </div>
                                    <div class="col-md-4 mb-5">
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

                                    <div class="col-md-4 mb-5">
                                        <!--begin::Label-->
                                        <label class="required  form-label">City</label>
                                        <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                            id="city_id" name="city_id" data-placeholder="Select an option" required>
                                            <option></option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ old('city_id', $data->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="error_msg_city_id"></span>

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
        <div class="modal-dialog modal-dialog-centered mw-1000px">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Site</h5>

                    <div class="btn btn-sm btn-icon btn-active-color-primary close" data-bs-dismiss="modal">
                        <i class="ki-solid ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-5 pb-15">
                    <form id="document_upload_edit" class="form" method="POST">
                        @method('POST')

                        <input type="hidden" name="id" id="id">
                        <div class="d-flex flex-column mb-8 fv-row">

                            <div class="row">
                                <div class="col-md-4 mb-5">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Site Name</span>

                                    </label>
                                    <input type="text" name="name1" id="name1" class="form-control price"
                                        placeholder="Name" required>
                                    <span class="error_msg_name1"></span>
                                </div>
                                <div class="col-md-4 mb-5">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Site Manager Name</span>

                                    </label>
                                    <input type="text" name="manager_name1" id="manager_name1"
                                        class="form-control price" placeholder="Manager Name" required>
                                    <span class="error_msg_manager_name1"></span>
                                </div>
                                <div class="col-md-4 mb-5">
                                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                        <span class="required">Siter Manager Number</span>

                                    </label>
                                    <input type="number" name="manager_number1" id="manager_number1"
                                        class="form-control price" placeholder="Manager Number" required>
                                    <span class="error_msg_manager_name1"></span>
                                </div>

                                <div class="col-md-4 mb-5">
                                    <!--begin::Label-->
                                    <label class="  form-label ">Address</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <textarea name="address1" id="address1" class="form-control mb-2" placeholder="Enter Address">{{ old('address', $data->address ?? '') }}</textarea>
                                    <!--end::Input-->
                                    <span class="error_msg_address1"></span>

                                </div>
                                <div class="col-md-4 mb-5">
                                    <!--begin::Label-->
                                    <label class="required  form-label">State</label>

                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                        id="state_id1" name="state_id1" data-placeholder="Select an option" required>
                                        <option></option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ old('state_id', $data->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="error_msg_state_id1"></span>

                                </div>

                                <div class="col-md-4 mb-5">
                                    <!--begin::Label-->
                                    <label class="required  form-label">City</label>
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                        id="city_id1" name="city_id1" data-placeholder="Select an option" required>
                                        <option></option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ old('city_id', $data->city_id ?? '') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="error_msg_city_id1"></span>

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


    <div class="modal fade" id="kt_modal_contact" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-1000px">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>

                    <div class="btn btn-sm btn-icon btn-active-color-primary close" data-bs-dismiss="modal">
                        <i class="ki-solid ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-5 pb-15">
                    <form id="contact_form" class="form" method="POST">
                        @method('POST')


                        <div class="d-flex flex-column mb-8 fv-row">
                            <div id="itemsContainer">
                                <div class="row">
                                    <div class="col-md-4 mb-5">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Contact Name</span>

                                        </label>
                                        <input type="text" name="contact_name" id="contact_name"
                                            class="form-control price" placeholder="Enter Contact Name" required>
                                        <span class="error_msg_contact_name"></span>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Contact Position</span>

                                        </label>
                                        <input type="text" name="contact_position" id="contact_position"
                                            class="form-control price" placeholder="Enter Contact Position" required>
                                        <span class="error_msg_contact_position"></span>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Contact Number</span>

                                        </label>
                                        <input type="number" name="contact_number" id="contact_number"
                                            class="form-control price" placeholder="Manager Number" required>
                                        <span class="error_msg_contact_number"></span>
                                    </div>



                                </div>

                            </div>

                        </div>
                        <div class="text-end">
                            <button type="reset" data-bs-dismiss="modal" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit_contact" class="btn btn-primary">
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

    <div class="modal fade" id="kt_modal_contact_edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-1000px">
            <div class="modal-content rounded">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Contact</h5>

                    <div class="btn btn-sm btn-icon btn-active-color-primary close" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-5 pb-15">
                    <form id="contact_form_edit" class="form" method="POST">
                        @method('POST')

                        <input type="hidden" name="contact_id" id="contact_id">
                        <div class="d-flex flex-column mb-8 fv-row">
                            <div id="itemsContainer">
                                <div class="row">
                                    <div class="col-md-4 mb-5">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Contact Name</span>

                                        </label>
                                        <input type="text" name="contact_name" id="contact_name1"
                                            class="form-control price" placeholder="Enter Contact Name" required>
                                        <span class="error_msg_contact_name"></span>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Contact Position</span>

                                        </label>
                                        <input type="text" name="contact_position" id="contact_position1"
                                            class="form-control price" placeholder="Enter Contact Position" required>
                                        <span class="error_msg_contact_position"></span>
                                    </div>
                                    <div class="col-md-4 mb-5">
                                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                            <span class="required">Contact Number</span>

                                        </label>
                                        <input type="number" name="contact_number" id="contact_number1"
                                            class="form-control price" placeholder="Manager Number" required>
                                        <span class="error_msg_contact_number"></span>
                                    </div>



                                </div>

                            </div>

                        </div>
                        <div class="text-end">
                            <button type="reset" data-bs-dismiss="modal" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit_contact_edit" class="btn btn-primary">
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
        $(document).ready(function() {
            $('#state_id').select2({
                dropdownParent: $('#document_upload_form')
            });
        })
        $("#document_upload_form").submit(function(e) {
            e.preventDefault();

            const id = {{ $customer->id }};

            $('.error_msg_image').html('');
            $('.error_msg_title').html('');

            const formData = new FormData(this);




            let url;

            url = "{{ route('add.site', ':id') }}".replace(':id', id);

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
                                $('.error_msg_name').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'manager_name') {
                                $('.error_msg_manager_name').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'manager_number') {
                                $('.error_msg_manager_number').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');
                                toastcall('error', errorMessage);
                            }
                            if (field === 'address') {
                                $('.error_msg_address').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'state_id') {
                                $('.error_msg_state_id').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'city_id') {
                                $('.error_msg_city_id').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

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

            const id = {{ $customer->id }};

            $('.error_msg_image').html('');
            $('.error_msg_title').html('');

            const formData = new FormData(this);




            let url;

            url = "{{ route('edit.site', ':customer') }}".replace(':customer', id);

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
                            if (field === 'name1') {
                                $('.error_msg_name1').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'manager_name1') {
                                $('.error_msg_manager_name1').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'manager_number1') {
                                $('.error_msg_manager_number1').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');
                                toastcall('error', errorMessage);
                            }
                            if (field === 'address1') {
                                $('.error_msg_address1').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'state_id1') {
                                $('.error_msg_state_id1').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'city_id1') {
                                $('.error_msg_city_id1').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

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
                    url: "{{ route('destroy.site') }}", // Ensure this is the correct route
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
            var name = $(this).data('name');
            var manager_name = $(this).data('manager_name');
            var manager_number = $(this).data('manager_number');
            var address = $(this).data('address');
            var state_id = $(this).data('state_id');
            var city_id = $(this).data('city_id');
            $('#id').val(id);
            $('#name1').val(name);
            $('#manager_name1').val(manager_name);
            $('#manager_number1').val(manager_number);
            $('#address1').val(address);
            $('#city_id1').val(city_id).trigger('change');
            $('#state_id1').val(state_id).trigger('change');
            $('#kt_modal_new_target_edit').modal('show');

        });


        $('.delete_contact').on('click', function(e) {
            e.preventDefault(); // Correctly prevent the default action
            var id = $(this).data('id');

            if (confirm('Are you sure?')) {
                $.ajax({
                    url: "{{ route('destroy.contact_customer') }}", // Ensure this is the correct route
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


        $('.edit_contact').on('click', function(e) {
            var contact_id = $(this).data('id');
            var contact_name = $(this).data('contact_name');
            var contact_number = $(this).data('contact_number');
            var contact_position = $(this).data('contact_position');

            $('#contact_id').val(contact_id);
            $('#contact_name1').val(contact_name);
            $('#contact_number1').val(contact_number);
            $('#contact_position1').val(contact_position);

            $('#kt_modal_contact_edit').modal('show');

        });


        $("#contact_form").submit(function(e) {
            e.preventDefault();

            const id = {{ $customer->id }};

            $('.error_msg_image').html('');
            $('.error_msg_title').html('');

            const formData = new FormData(this);

            let url;

            url = "{{ route('add.contact_customer', ':customer') }}".replace(':customer', id);

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
                    $('#kt_modal_new_target_submit_contact').prop('disabled', true);
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
                        $('#kt_modal_new_target_submit_contact').prop('disabled', false);
                    } else {
                        toastcall('error', response.message);
                        $('#kt_modal_new_target_submit_contact').prop('disabled', false);
                    }
                },

                error: function(xhr, status, error) {
                    console.log(xhr.responseJSON.errors);
                    $('#kt_modal_new_target_submit_contact').prop('disabled', false);
                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, fieldErrors) {
                            var errorMessage = fieldErrors.join(", ");
                            if (field === 'contact_name') {
                                $('.error_msg_contact_name').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'contact_number') {
                                $('.error_msg_contact_number').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'contact_position') {
                                $('.error_msg_contact_position').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');
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



        $("#contact_form_edit").submit(function(e) {
            e.preventDefault();

            const id = {{ $customer->id }};

            $('.error_msg_image').html('');
            $('.error_msg_title').html('');

            const formData = new FormData(this);

            let url;

            url = "{{ route('edit.contact_customer', ':customer') }}".replace(':customer', id);

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
                    $('#kt_modal_new_target_submit_contact_edit').prop('disabled', true);
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
                        $('#kt_modal_new_target_submit_contact_edit').prop('disabled', false);
                    } else {
                        toastcall('error', response.message);
                        $('#kt_modal_new_target_submit_contact_edit').prop('disabled', false);
                    }
                },

                error: function(xhr, status, error) {
                    console.log(xhr.responseJSON.errors);
                    $('#kt_modal_new_target_submit_contact_edit').prop('disabled', false);
                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, fieldErrors) {
                            var errorMessage = fieldErrors.join(", ");
                            if (field === 'contact_name') {
                                $('.error_msg_contact_name').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'contact_number') {
                                $('.error_msg_contact_number').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');

                            }
                            if (field === 'contact_position') {
                                $('.error_msg_contact_position').html(
                                    '<span><li class="mt-2 text-danger">' +
                                    errorMessage + '</li></span>');
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
    </script>
@endpush
