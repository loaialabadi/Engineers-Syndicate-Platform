<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Pharmacy;
use App\Models\Lab;
use Illuminate\Http\Request;

class HealthcareController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;
        $search = $request->search;

        // ====== كل البيانات افتراضي ======
        $doctors = Doctor::active()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($type && $type != 'doctor', fn($q) => $q->whereRaw('0 = 1'))
            ->get();

        $hospitals = Hospital::active()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($type && $type != 'hospital', fn($q) => $q->whereRaw('0 = 1'))
            ->get();

        $pharmacies = Pharmacy::active()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($type && $type != 'pharmacy', fn($q) => $q->whereRaw('0 = 1'))
            ->get();

        $labs = Lab::active()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($type && $type != 'lab', fn($q) => $q->whereRaw('0 = 1'))
            ->get();

        return view('public.healthcare.index', compact(
            'doctors',
            'hospitals',
            'pharmacies',
            'labs',
            'type',
            'search'
        ));
    }


        public function show($type, $id)
    {
        $model = match ($type) {
            'doctor' => \App\Models\Doctor::class,
            'hospital' => \App\Models\Hospital::class,
            'pharmacy' => \App\Models\Pharmacy::class,
            'lab' => \App\Models\Lab::class,
            default => abort(404),
        };

        $item = $model::findOrFail($id);

        return view('public.healthcare.show', compact('item', 'type'));
    }
}