@extends('admin.layout.master')
@section('title', 'Dashboard')

@section('css')
<style>
    .stat-card {
        border-radius: 10px;
        padding: 20px;
        color: #fff;
        height: 100%;
    }
    .bg-blue { background: linear-gradient(135deg,#4e73df,#224abe); }
    .bg-green { background: linear-gradient(135deg,#1cc88a,#13855c); }
    .bg-orange { background: linear-gradient(135deg,#f6c23e,#dda20a); }
    .bg-red { background: linear-gradient(135deg,#e74a3b,#be2617); }

    .stat-card h2 {
        font-size: 28px;
        margin: 0;
    }
    .stat-card p {
        margin: 0;
        opacity: .9;
    }

    .card {
        border-radius: 10px;
    }

    canvas {
        max-height: 300px;
    }
</style>
@endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">

    <!-- Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar pt-7 mb-5">
        <div class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column">
                <h1 class="page-heading fw-bold fs-3">Dashboard</h1>
                <ul class="breadcrumb fw-semibold fs-7">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home') }}" class="text-muted">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content container-fluid">

        <!-- ================= SUMMARY CARDS ================= -->
        <div class="row g-4 mb-5">

            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-blue">
                    <p>Total Enquiries</p>
                    <h2>125</h2>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-green">
                    <p>Total Employees</p>
                    <h2>42</h2>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-orange">
                    <p>Today Enquiries</p>
                    <h2>18</h2>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stat-card bg-red">
                    <p>Pending Enquiries</p>
                    <h2>9</h2>
                </div>
            </div>

        </div>

        <!-- ================= CHART + TABLE ================= -->
        <div class="row g-4">

            <!-- Chart -->
            <div class="col-lg-7">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Monthly Enquiry Overview</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="enquiryChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="col-lg-5">
                <div class="card h-100">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Recent Enquiries</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Rahul Sharma</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Anita Verma</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Amit Singh</td>
                                    <td><span class="badge bg-danger">Rejected</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Pooja Patel</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('enquiryChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul'],
        datasets: [
            {
                label: 'Enquiries',
                data: [12,19,8,15,22,10,18],
                backgroundColor: '#4e73df'
            },
            {
                label: 'Completed',
                data: [8,14,6,12,18,7,15],
                type: 'line',
                borderColor: '#1cc88a',
                borderWidth: 2,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endpush
