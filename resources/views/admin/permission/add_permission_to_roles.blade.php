@extends('admin.layout.master')

@section('title', 'Permission')

@section('css')
@endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar pt-10 mb-0">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-body fw-bold fs-3 flex-column justify-content-center my-0">
                        Give Permission To {{ $roles->name }}
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="route('home')" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Permission List</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">

                    {{-- <button class="btn btn-sm fw-bold btn-primary btn_method" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_new_target">Show</button> --}}
                </div>
            </div>
        </div>
        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">

                <form action="{{ route('store_permisson_for_role', ['id' => $roles->id]) }}" method="post">
                    @csrf
<div class="mb-5">
    <label class="form-check form-check-custom form-check-solid">
        <input class="form-check-input h-20px w-20px" type="checkbox" id="checkAllPermissions">
        <span class="form-check-label fw-bold fs-5 text-gray-900">Check All Permissions</span>
    </label>
</div>
                    @foreach ($permissions as $category => $categoryPermissions)
                        <div class="card mb-5">
                            <div class="card-header">
                                <label class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input h-20px w-20px check-all" type="checkbox"
                                        id="checkAll_{{ Str::slug($category) }}" data-category="{{ Str::slug($category) }}"
                                        data-permission-count="{{ count($categoryPermissions) }}">
                                    <span class="form-check-label fw-bold fs-5 text-gray-900">All {{ $category }}</span>
                                </label>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">

                                        <div class="row">
                                            @foreach ($categoryPermissions as $permission)
                                                <div class="col-md-3 p-3">
                                                    <label class="form-check form-check-custom form-check-solid me-10">
                                                        <input class="form-check-input h-20px w-20px permission-checkbox"
                                                            type="checkbox" name="permission[{{ Str::slug($category) }}][]"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                                        <span
                                                            class="form-check-label fw-semibold">{{ $permission->display_name ?? $permission->name }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                    <div class="text-end p-5">
                        <a href="{{ route('role.index') }}" id="cancel" class="btn btn-light me-5">Cancel</a>
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

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to check/uncheck "Select All" based on individual checkbox states
        function updateSelectAllState(category) {
            const checkboxes = document.querySelectorAll(`input[name="permission[${category}][]"]`);
            const checkAll = document.getElementById(`checkAll_${category}`);

            // Check if all checkboxes are checked
            const allChecked = Array.from(checkboxes).every(function(checkbox) {
                return checkbox.checked;
            });

            // Set the "Select All" checkbox state
            checkAll.checked = allChecked;
        }

        // Attach event listeners to each "Select All" checkbox
        document.querySelectorAll('.check-all').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Get the category from the checkbox's data attribute
                const category = checkbox.getAttribute('data-category');

                // Find all checkboxes within the category
                const checkboxes = document.querySelectorAll(
                    `input[name="permission[${category}][]"]`);

                // Set all checkboxes to be checked or unchecked depending on the "Select All" checkbox state
                checkboxes.forEach(function(box) {
                    box.checked = checkbox.checked;
                });
            });

            // Update the "Select All" checkbox state on page load
            const category = checkbox.getAttribute('data-category');
            updateSelectAllState(category);
        });

        // Attach event listeners to each permission checkbox to update the "Select All" checkbox
        document.querySelectorAll('.permission-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const category = checkbox.name.match(/\[(.*?)\]/)[1];
                updateSelectAllState(category);
            });
        });
    });


    const masterCheck = document.getElementById('checkAllPermissions');

if (masterCheck) {
    masterCheck.addEventListener('change', function() {
        const allCategoryCheckboxes = document.querySelectorAll('.check-all');
        const allPermissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        // Set all checkboxes to the master state
        allCategoryCheckboxes.forEach(function(box) {
            box.checked = masterCheck.checked;
        });
        allPermissionCheckboxes.forEach(function(box) {
            box.checked = masterCheck.checked;
        });
    });
}

// Optional: update master checkbox if all categories are checked
document.querySelectorAll('.check-all').forEach(function(categoryBox) {
    categoryBox.addEventListener('change', function() {
        const allCategoryCheckboxes = document.querySelectorAll('.check-all');
        masterCheck.checked = Array.from(allCategoryCheckboxes).every(cb => cb.checked);
    });
});
</script>
@endpush
