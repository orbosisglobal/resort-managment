@extends('admin.layout.master')
@section('title','Edit Resort')

@section('css')
<style>
    .image-box {
        width: 140px;
    }
    .image-box img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
    }
    .section-title {
        font-weight: 600;
        font-size: 16px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
 <br>
<h3 class="mb-4 fw-bold">Edit Resort</h3>

<!-- ================= RESORT DETAILS ================= -->
<form method="POST" action="{{ route('resort.update',$resort->id) }}">
@csrf
@method('PUT')

<div class="card mb-4">
    <div class="card-header">
        <span class="section-title">Update Resort Details</span>
    </div>

    <div class="card-body row">
        <div class="col-md-6 mb-3">
            <label>Resort Name</label>
            <input type="text" name="resort_name" class="form-control" value="{{ $resort->name }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ $resort->capacity }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Styles</label>
            <input type="text" name="styles" class="form-control" value="{{ $resort->styles }}">
        </div>

        <div class="col-md-6 mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" required>{{ $resort->address }}</textarea>
        </div>
    </div>

    <div class="card-footer text-end">
        <button class="btn btn-success px-4">
            Update Resort
        </button>
    </div>
</div>
</form>

<!-- ================= EXISTING IMAGES ================= -->
<div class="card mb-4">
    <div class="card-header">
        <span class="section-title">Resort Images</span>
    </div>

    <div class="card-body d-flex flex-wrap gap-3" id="existingImages">
        @foreach($resort->image ?? [] as $img)
            <div class="image-box position-relative" data-image="{{ $img }}">
                <img src="{{ asset('storage/'.$img) }}">
                <button
                    class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 delete-image"
                    title="Delete Image">
                    ×
                </button>
            </div>
        @endforeach
    </div>

    <div id="undoBar" class="alert alert-warning d-none mx-3 mb-3">
        Image deleted
        <button id="undoBtn" class="btn btn-sm btn-warning ms-2">
            Undo
        </button>
    </div>
</div>

<!-- ================= ADD IMAGES ================= -->
<div class="card mb-4">
    <div class="card-header">
        <span class="section-title">Add New Images</span>
    </div>

    <div class="card-body">
        <input type="file" id="newImages" class="form-control mb-3" multiple>

        <div class="d-flex gap-2 flex-wrap">
            <button id="uploadImages" class="btn btn-primary">
                Upload Images
            </button>

            <a href="{{ route('resort.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>
    </div>
</div>

</div>
@endsection

@push('scripts')
<script>
let deletedImage=null, timer=null;

/* ================= DELETE + UNDO ================= */
document.querySelectorAll('.delete-image').forEach(btn=>{
    btn.onclick=()=>{
        let box=btn.closest('.image-box');
        let image=box.dataset.image;

        box.style.display='none';
        deletedImage={box,image};

        document.getElementById('undoBar').classList.remove('d-none');

        fetch("{{ route('resort.image.tempDelete') }}",{
            method:'POST',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}',
                'Content-Type':'application/json'
            },
            body:JSON.stringify({resort_id:{{ $resort->id }},image})
        });

        timer=setTimeout(()=>finalDelete(image),5000);
    };
});

document.getElementById('undoBtn').onclick=()=>{
    clearTimeout(timer);
    deletedImage.box.style.display='block';
    document.getElementById('undoBar').classList.add('d-none');

    fetch("{{ route('resort.image.undoDelete') }}",{
        method:'POST',
        headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}
    });

    deletedImage=null;
};

function finalDelete(image){
    fetch("{{ route('resort.image.finalDelete') }}",{
        method:'POST',
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}',
            'Content-Type':'application/json'
        },
        body:JSON.stringify({resort_id:{{ $resort->id }},image})
    });
    document.getElementById('undoBar').classList.add('d-none');
}

/* ================= ADD IMAGES ================= */
document.getElementById('uploadImages').onclick=()=>{
    let files=document.getElementById('newImages').files;
    if(!files.length) return alert('Please select images');

    let fd=new FormData();
    [...files].forEach(f=>fd.append('images[]',f));

    fetch("{{ route('resort.images.add',$resort->id) }}",{
        method:'POST',
        headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'},
        body:fd
    }).then(()=>location.reload());
};
</script>
@endpush
