@extends('admin.layout.master')

@section('title','Add Resort')

@section('content')
<div class="d-flex flex-column flex-column-fluid">

    <!-- Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar pt-7 mb-5">
        <div class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column">
                <h1 class="page-heading fw-bold fs-3">Add New Resort</h1>
                <ul class="breadcrumb fw-semibold fs-7">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Resort Management</li>
                </ul>
            </div>
            <a href="{{ route('resort.index') }}" class="btn btn-light btn-sm">Back</a>
        </div>
    </div>

    <!-- Content -->
  <div class="app-content container-fluid">
    <form method="POST" action="{{ route('resort.store') }}" enctype="multipart/form-data" class="d-flex flex-column gap-7">
        @csrf
  @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        <!-- Resort Details -->
        <div class="card card-flush">
            <div class="card-header"><h3 class="card-title">Resort Details</h3></div>
            <div class="card-body row">

                <div class="col-md-6 mb-5">
                    <label class="required form-label">Resort Name</label>
                    <input type="text" name="resort_name" class="form-control" required
                           value="{{ old('resort_name') }}">
                </div>

                <div class="col-md-6 mb-5">
                    <label class="required form-label">Resort Number</label>
                    <input type="text" name="resort_number" class="form-control" required
                           inputmode="numeric" pattern="[0-9]*"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           maxlength="10"
                           value="{{ old('resort_number') }}">
                </div>

                <div class="col-md-6 mb-5">
                    <label class="required form-label">Capacity</label>
                    <input type="number" name="capacity" class="form-control" required
                           value="{{ old('capacity') }}">
                </div>

                <div class="col-md-6 mb-5">
                    <label class="form-label">Styles</label>
                    <input type="text" name="styles" class="form-control"
                           value="{{ old('styles') }}">
                </div>

                <div class="col-md-6 mb-5">
                    <label class="required form-label">Address</label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                </div>

                <div class="col-md-6 mb-5">
                    <label class="required form-label">Location/Area</label>
                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                            id="location_id" name="location_id"
                            data-placeholder="Select an option" required>
                        <option></option>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}"
                                {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-5">
                    <label class="required form-label">Pincode</label>
                    <input type="text" name="pincode" class="form-control" rows="3" required value="{{ old('pincode') }}" inputmode="numeric" pattern="[0-9]*"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           maxlength="6">
                </div>

            </div>
        </div>

        <!-- Partner Details -->
        <div class="card card-flush">
            <div class="card-header"><h3 class="card-title">Resort Login Details</h3></div>
            <div class="card-body row">

                <div class="col-md-6 mb-5">
                    <label class="required form-label">Owner Name</label>
                    <input type="text" name="partner_name" class="form-control" required
                           value="{{ old('partner_name') }}">
                </div>

                <div class="col-md-6 mb-5">
                    <label class="required form-label">Resort Username</label>
                    <input type="text" name="resort_username" class="form-control" required
                           value="{{ old('resort_username') }}">
                </div>

                <div class="col-md-6 mb-5">
                    <label class="required form-label">Resort Email</label>
                    <input type="email" name="partner_email" class="form-control" required
                           value="{{ old('partner_email') }}">
                </div>

                <div class="col-12">
                    <div class="alert alert-info">
                        Resort credentials will be auto-generated and emailed.
                    </div>
                </div>

            </div>
        </div>

        <!-- Images -->
        <div class="card card-flush">
            <div class="card-header"><h3 class="card-title">Upload Resort Images</h3></div>
            <div class="card-body">
                <div id="itemsContainer"></div>
                <button type="button" id="addButton" class="btn btn-light-primary mt-3">
                    + Add Image
                </button>
            </div>
        </div>

        <!-- Actions -->
        <div class="d-flex justify-content-end gap-3">
            <a href="{{ route('resort.index') }}" class="btn btn-light">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Resort</button>
        </div>

    </form>
</div>

</div>
@endsection

@push('scripts')
<script>

    $(document).ready(function() {
  $('#location_id').select2({
    placeholder: 'Select an option',
    allowClear: false
            });
        });
document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('itemsContainer');
    const addBtn = document.getElementById('addButton');

    function addImageRow() {
        const row = document.createElement('div');
        row.className = 'row mb-4';

        row.innerHTML = `
            <div class="col-md-5">
                <input type="file" name="images[]" class="form-control" accept="image/*" required>
            </div>
            <div class="col-md-5">
                <img class="img-preview d-none rounded border" width="120">
            </div>
            <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-danger remove-item">×</button>
            </div>
        `;

        const input = row.querySelector('input');
        const img = row.querySelector('.img-preview');

        input.addEventListener('change', e => {
            img.src = URL.createObjectURL(e.target.files[0]);
            img.classList.remove('d-none');
        });

        row.querySelector('.remove-item').onclick = () => row.remove();
        container.appendChild(row);
    }

    addBtn.onclick = addImageRow;
    addImageRow(); // first row
});
</script>
@endpush
