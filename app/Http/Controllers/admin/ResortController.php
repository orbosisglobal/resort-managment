<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resort;
use App\Models\Resortpartners;
use Illuminate\Support\Facades\Hash;

class ResortController extends Controller
{
    /* ================= INDEX ================= */
    public function index()
    {
        $resorts = Resort::with('partner')->latest()->get();
        return view('admin.resort.index', compact('resorts'));
    }

    /* ================= CREATE ================= */
    public function create()
    {
        return view('admin.resort.create');
    }

    /* ================= STORE ================= */
  public function store(Request $request)
{
    $request->validate([
        'resort_name'   => 'required|string',
        'address'       => 'required|string',
        'capacity'      => 'required|numeric',
        'styles'        => 'nullable|string',
        'partner_name'  => 'required|string',
        'partner_email' => 'required|email|unique:resortpartners,email',
        'images.*'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    /* ================= MULTI IMAGE STORE ================= */
    $images = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {
            $images[] = $file->store('resorts', 'public');
        }
    }

    /* ================= CREATE RESORT ================= */
    $resort = Resort::create([
        'name'      => $request->resort_name,
        'address'   => $request->address,
        'capacity'  => $request->capacity,
        'styles'    => $request->styles,
        'image'     => $images,   // ✅ ARRAY STORED
        'is_active' => 1,
    ]);

    /* ================= CREATE PARTNER ================= */
    Resortpartners::create([
        'resort_id' => $resort->id,
        'name'      => $request->partner_name,
        'email'     => $request->partner_email,
        'password'  => bcrypt(rand(100000,999999)),
    ]);

    return redirect()
        ->route('resort.index')
        ->with('success', 'Resort created successfully');
}

    /* ================= EDIT ================= */
    public function edit($id)
    {
        $resort = Resort::with('partner')->findOrFail($id);
        return view('admin.resort.edit', compact('resort'));
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
    {
        $resort = Resort::findOrFail($id);

        $request->validate([
            'resort_name' => 'required|string',
            'address'     => 'required|string',
            'capacity'    => 'required|numeric',
            'styles'      => 'nullable|string',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $images = $resort->image ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $images[] = $img->store('resorts','public');
            }
        }

        $resort->update([
            'name'     => $request->resort_name,
            'address'  => $request->address,
            'capacity' => $request->capacity,
            'styles'   => $request->styles,
            'image'    => $images,
        ]);

        return redirect()->route('resort.index')->with('success','Resort updated successfully');
    }

    /* ================= STATUS ================= */
    public function toggleStatus($id)
    {
        $resort = Resort::findOrFail($id);
        $resort->update(['is_active'=>!$resort->is_active]);
        return back();
    }

  public function ajaxAddImages(Request $request, Resort $resort)
{
    $request->validate([
        'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $images = $resort->image ?? [];

    foreach ($request->file('images') as $file) {
        $images[] = $file->store('resorts', 'public');
    }

    $resort->update(['image' => $images]);

    return response()->json(['status' => true]);
}

/* ========== TEMP DELETE ========== */
public function tempDeleteImage(Request $request)
{
    Session::put('undo_image', [
        'resort_id' => $request->resort_id,
        'image'     => $request->image,
    ]);

    return response()->json(['status' => true]);
}

/* ========== UNDO DELETE ========== */
public function undoDeleteImage()
{
    Session::forget('undo_image');
    return response()->json(['status' => true]);
}

/* ========== FINAL DELETE ========== */
public function finalDeleteImage(Request $request)
{
    $resort = Resort::findOrFail($request->resort_id);

    $images = array_values(array_filter(
        $resort->image ?? [],
        fn ($img) => $img !== $request->image
    ));

    Storage::disk('public')->delete($request->image);

    $resort->update(['image' => $images]);

    Session::forget('undo_image');

    return response()->json(['status' => true]);
}

public function destroy($id)
{
    $resort = Resort::with('partner')->findOrFail($id);

    // ✅ Delete images from storage
    if (!empty($resort->image)) {
        foreach ($resort->image as $img) {
            if (Storage::disk('public')->exists($img)) {
                Storage::disk('public')->delete($img);
            }
        }
    }

    // ✅ Delete partner (if exists)
    if ($resort->partner) {
        $resort->partner->delete();
    }

    // ✅ Delete resort
    $resort->delete();

    return redirect()
        ->route('resort.index')
        ->with('success', 'Resort deleted successfully');
}
}
