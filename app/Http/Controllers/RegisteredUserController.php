<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        $validate = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(8)->letters(), 'confirmed'],
        ]);


        $user = User::create($validate);

        $defaultPlan = Plan::find(1); // Assuming Plan with ID 1 is the default plan

        if (!$defaultPlan) {
            return redirect('/register')->with('error', 'Default plan not found. Contact support.');
        }

        // Create a new subscription for the user with the default plan
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $defaultPlan->id,
            'plan_name' => $defaultPlan->plan_name,
            'plan_price' => $defaultPlan->plan_price,
            'plan_description' => $defaultPlan->plan_description,
            'credits_per_month' => $defaultPlan->credits_per_month,
            'duration_days' => 30,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
        ]);

        // Associate the subscription with the user
        $user->subscription_id = $subscription->id;
        $user->credits = $defaultPlan->credits_per_month;
        $user->save();

        Auth::login($user);

        return redirect('/');
    }

    public function userDash()
    {
        $users = User::all();
        return view('auth.dashboard', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['nullable', Password::min(5)->letters(), 'confirmed'],
            'plan_id' => ['nullable', 'exists:plans,id'], // Add plan_id validation
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        if (isset($validatedData['plan_id']) && $validatedData['plan_id'] != $user->subscription->plan_id) {
            $newPlan = Plan::find($validatedData['plan_id']);

            if ($newPlan) {
                $subscription = $user->subscription;
                $subscription->update([
                    'plan_id' => $newPlan->id,
                    'plan_name' => $newPlan->plan_name,
                    'plan_price' => $newPlan->plan_price,
                    'plan_description' => $newPlan->plan_description,
                    'credits_per_month' => $newPlan->credits_per_month,
                ]);

                // Update user's credits
                $user->credits = $newPlan->credits_per_month;
                $user->save();
            }
        }

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }
}
