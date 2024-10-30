<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Validate and process payment logic here

        $validatedData = $request->validate([
            'cardholder_name' => 'required|string',
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
            'plano' => 'required|string', // Ensure 'plano' is sent from the form
        ]);

        // Get the plan based on 'plano' value
        $plan = Plan::where('name', $validatedData['plano'])->firstOrFail();

        // Example: Create or update subscription for the authenticated user
        $user = auth()->user();

        if ($user->subscription) {
            // Update existing subscription
            $user->subscription->update([
                'plan_id' => $plan->id,
                'starts_at' => now(),
                'ends_at' => now()->addYear(), // Example: Set subscription duration
            ]);
        } else {
            // Create new subscription
            Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'starts_at' => now(),
                'ends_at' => now()->addYear(), // Example: Set subscription duration
            ]);
        }

        // Return response (e.g., JSON response)
        return response()->json(['message' => 'Payment processed successfully']);
    }
}

