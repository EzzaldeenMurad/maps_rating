<?php

namespace App\Http\Controllers;

use App\Mail\SendReport;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function create()
    {
        return view('report');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Report::create($data);
        Mail::send(new SendReport($data));
        return back()->with('success', 'شكرًا لتواصلك!');
    }
}
