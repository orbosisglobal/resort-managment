@extends('admin.layout.master')

@section('title', 'Resort Availability')

@section('content')
<div class="d-flex flex-column flex-column-fluid">

    <!-- Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar pt-7 mb-5">
        <div class="app-container container-fluid d-flex flex-stack">

            <!-- Page Title -->
            <div class="page-title d-flex flex-column">
                <h1 class="page-heading text-dark fw-bold fs-3">
                    Resort Availability
                </h1>

                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Resorts
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        Availability
                    </li>
                </ul>
            </div>

            <!-- Actions -->
            <a href="{{ route('resorts.index') }}" class="btn btn-sm btn-light">
                Back
            </a>

        </div>
    </div>

    <!-- Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">

            <!-- Resort Info -->
            <div class="card card-flush mb-6">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between">
                    <div>
                        <h3 class="fw-bold mb-1">{{ $resort->name }}</h3>
                        <div class="text-muted">{{ $resort->address }}</div>
                    </div>

                    <span class="badge {{ $resort->is_active ? 'badge-light-success' : 'badge-light-danger' }} align-self-start">
                        {{ $resort->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <!-- Availability Form -->
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title">Update Availability</h3>
                </div>

                <div class="card-body">
                    <form method="POST"
                          action="{{ route('resorts.availability.save', $resort->id) }}"
                          class="row g-5">

                        @csrf

                        <div class="col-md-4">
                            <label class="required form-label">Date</label>
                            <input type="date"
                                   name="date"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="col-md-4">
                            <label class="required form-label">Availability Status</label>
                            <select name="is_available"
                                    class="form-select"
                                    required>
                                <option value="1">Available</option>
                                <option value="0">Not Available</option>
                            </select>
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                Save Availability
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Availability List -->
            <div class="card card-flush mt-6">
                <div class="card-header">
                    <h3 class="card-title">Availability History</h3>
                </div>

                <div class="card-body table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-gray-500 fw-bold fs-7 text-uppercase">
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($resort->availability as $availability)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($availability->date)->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge {{ $availability->is_available ? 'badge-light-success' : 'badge-light-danger' }}">
                                            {{ $availability->is_available ? 'Available' : 'Not Available' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">
                                        No availability data found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
