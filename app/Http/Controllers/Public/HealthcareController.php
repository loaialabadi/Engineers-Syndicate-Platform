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
        $type = $request->get('type', 'all');
        $search = $request->get('search');

        $doctors = Doctor::active()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->get();

        $hospitals = Hospital::active()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->get();

        $pharmacies = Pharmacy::active()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->get();

        $labs = Lab::active()
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
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
}