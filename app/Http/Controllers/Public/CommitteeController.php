<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use Illuminate\View\View;

class CommitteeController extends Controller
{
    public function index(): View
    {
        $committees = Committee::active()->ordered()->get();

        return view('public.committees.index', compact('committees'));
    }
    public function show($id)
{
    $committee = Committee::findOrFail($id);
    return view('public.committees.show', compact('committee'));
}

}