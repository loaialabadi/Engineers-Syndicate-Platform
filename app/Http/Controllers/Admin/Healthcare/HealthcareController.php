<?php

namespace App\Http\Controllers\Admin\Healthcare;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Pharmacy;
use App\Models\Lab;

class HealthcareController extends Controller
{
    public function index()
    {
        // جلب إحصائيات سريعة لعرضها في لوحة تحكم الرعاية الصحية
        $stats = [
            'doctors'    => Doctor::count(),
            'hospitals'  => Hospital::count(),
            'pharmacies' => Pharmacy::count(),
            'labs'       => Lab::count(),
        ];

        return view('admin.healthcare.index', compact('stats'));
    }
}
