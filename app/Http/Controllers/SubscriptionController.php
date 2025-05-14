<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Subscription;




class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('admin.subscriptions', compact('subscriptions'));
    }

    public function processSubscription(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'duration_months' => 'integer|in:1,3,6,12,24',
        ]);



        try {
            // Calculate dates
            $startDate = now();
            $endDate = $startDate->copy()->addMonths(intval($validated['duration_months']));

            
            // Create subscription record
            $subscription = Subscription::create([
                'doctor_id' => $validated['doctor_id'],
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => 'active'
            ]);



            return redirect()->route('doctor.dashboard')
                ->with('success', 'Subscription activated successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Payment failed: '.$e->getMessage());
        }
    }
}
