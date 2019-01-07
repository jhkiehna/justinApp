<?php

namespace App\Http\Controllers;

use App\Employer;
use App\Candidate;
use App\Mail\NotifyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Input;

class EmployerEmailController extends Controller
{
    public function send(Request $request, $employerId)
    {
        $employer = Employer::findOrFail($employerId);

        $candidates = collect($request->except('_token'))
        ->map(function($value) {
            return Candidate::findOrFail($value);
        })->values();

        Mail::to($employer->email)
        ->bcc(config('mail.from.address'))
        ->send(new NotifyClient($candidates, $employer));

        return redirect()->route('dashboard')->withStatus('Email sent to ' . $employer->email);
    }

    public function preview(Request $request, $employerId)
    {
        $employer = Employer::findOrFail($employerId);

        $candidates = collect($request->except('_token'))
        ->map(function($value) {
            return Candidate::findOrFail($value);
        })->values();

        return (new NotifyClient($candidates, $employer))->preview();
    }
}