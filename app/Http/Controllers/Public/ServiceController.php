<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * صفحة عرض كل الخدمات
     */
    public function index()
    {
$services = Service::where('is_active', 1)
    ->orderByRaw('sort_order IS NULL, sort_order ASC')
    ->get();


        return view('public.services.index', compact('services'));
    }

    /**
     * صفحة تفاصيل خدمة واحدة
     */
    public function show(Service $service)
    {
    

        return view('public.services.show', compact('service'));
    }
}