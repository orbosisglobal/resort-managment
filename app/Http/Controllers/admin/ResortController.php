<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Resort;
use App\Models\Resortpartners;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use DB;

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
        $locations = Location::all();
        return view('admin.resort.create', compact('locations'));
    }

    /* ================= STORE ================= */

    public function store(Request $request)
    {
        $request->validate([
            'resort_name' => 'required|string',
            'resort_number' => 'required|string|unique:users,phone',
            'resort_username' => 'required|string|max:50|unique:users,username',
            'address' => 'required|string',
            'capacity' => 'required|numeric',
            'styles' => 'nullable|string',
            'partner_name' => 'required|string',
            'partner_email' => 'required|email|unique:users,email',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location_id' => 'required|exists:locations,id',
            'pincode' => 'required|string|max:6',
        ]);

        /* ================= MULTI IMAGE STORE ================= */
        $images = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('resorts', 'public');
            }
        }
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->partner_name,
                'email' => $request->partner_email,
                'password' => Hash::make(rand(100000, 999999)),
                'username' => $request->resort_username,
                'phone' => $request->resort_number,
                'address' => $request->address,
                'pincode' => $request->pincode,
            ]);

            $userId = $user->id;
            /* ================= CREATE RESORT ================= */
            $resort = Resort::create([
                'name' => $request->resort_name,
                'address' => $request->address,
                'capacity' => $request->capacity,
                'styles' => $request->styles,
                'image' => $images,  // ✅ ARRAY STORED
                'location_id' => $request->location_id,
                'pincode' => $request->pincode,
                'user_id' => $userId
            ]);
            $user->assignRole('Resort');
            /* ================= CREATE PARTNER ================= */
            // Resortpartners::create([
            //     'resort_id' => $resort->id,
            //     'name'      => $request->partner_name,
            //     'email'     => $request->partner_email,
            //     'password'  => bcrypt(rand(100000,999999)),
            // ]);

            DB::commit();
            return redirect()
                ->route('resort.index')
                ->with('success', 'Resort created successfully');
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.'. $e->getMessage());
        }
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
            'address' => 'required|string',
            'capacity' => 'required|numeric',
            'styles' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $images = $resort->image ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $images[] = $img->store('resorts', 'public');
            }
        }

        $resort->update([
            'name' => $request->resort_name,
            'address' => $request->address,
            'capacity' => $request->capacity,
            'styles' => $request->styles,
            'image' => $images,
        ]);

        return redirect()->route('resort.index')->with('success', 'Resort updated successfully');
    }

    /* ================= STATUS ================= */
    public function toggleStatus($id)
    {
        $resort = Resort::findOrFail($id);
        $resort->update(['is_active' => !$resort->is_active]);
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
            'image' => $request->image,
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
            fn($img) => $img !== $request->image
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
