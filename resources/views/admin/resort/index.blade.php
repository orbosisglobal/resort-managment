@extends('admin.layout.master')
@section('title','Resort Management')

@section('css')
<style>
.resort-thumb{
    width:60px;height:60px;
    object-fit:cover;
    border-radius:6px;
    border:1px solid #ddd;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
     <br>
<div class="d-flex justify-content-between mb-3">
    
    <h3>Resort Management</h3>
    
    <a href="{{ route('resort.create') }}" class="btn btn-primary btn-sm">+ Add Resort</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
<table class="table table-bordered align-middle">
<thead class="table-light">
<tr>
<th>#</th>
<th>Resort</th>
<th>Partner Email</th>
<th>Capacity</th>
<th>Images</th>
<th>Status</th>
<th class="text-end">Action</th>
</tr>
</thead>
<tbody>
@forelse($resorts as $key=>$resort)
<tr>
<td>{{ $key+1 }}</td>
<td>
<strong>{{ $resort->name }}</strong><br>
<small>{{ Str::limit($resort->address,40) }}</small>
</td>
<td>{{ $resort->partner->email ?? '-' }}</td>
<td>{{ $resort->capacity }}</td>
<td>
<div class="d-flex gap-2 flex-wrap">
@foreach($resort->image ?? [] as $img)
<img src="{{ asset('storage/'.$img) }}" class="resort-thumb">
@endforeach
</div>
</td>
<td>
<span class="badge {{ $resort->is_active?'bg-success':'bg-danger' }}">
{{ $resort->is_active?'Active':'Inactive' }}
</span>
</td>
<td class="text-end">
<a href="{{ route('resort.edit',$resort->id) }}" class="btn btn-sm btn-primary">Edit</a>
 <form action="{{ route('resort.destroy',$resort->id) }}"
          method="POST"
          class="d-inline"
          onsubmit="return confirm('Are you sure you want to delete this resort?');">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-sm btn-danger">
            Delete
        </button>
    </form>
</td>
</tr>
@empty
<tr><td colspan="7" class="text-center">No Data</td></tr>
@endforelse
</tbody>
</table>
</div>
</div>
@endsection
