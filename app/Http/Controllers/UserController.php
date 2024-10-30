<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userDash()
    {
        $users = Auth::user(); // Or however you fetch the user(s) you need
        return view('user_dash', compact('users'));
    }

    public function profile()
    {
        $users = Auth::user(); // Assuming you want to access the currently authenticated user
        return view('auth.profile', compact('users'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($request->input('user_id'));

        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        if ($user->id === Auth::id()) {
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
            return redirect()->back()->with('success', 'Password updated successfully.');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    public function updateField(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'sometimes|string|max:255', // Validation rules for name
            'email' => 'sometimes|email|max:255|unique:users,email', // Validation rules for email
            'plan_id' => 'sometimes|integer|exists:plans,id', // Add plan_id validation
        ]);

        $user = User::findOrFail($request->input('user_id'));
        if ($user->id === Auth::id()) {
            if ($request->has('name')) {
                $user->name = $request->input('name');
            }
            if ($request->has('email')) {
                $user->email = $request->input('email');
            }
            if ($request->has('plan_id')) {
                $newPlan = Plan::find($request->input('plan_id'));
                if ($newPlan && $user->subscription->plan_id != $newPlan->id) {
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
                }
            }
            $user->save();
            return redirect()->back()->with('success', 'Field updated successfully.');
        }
        return redirect()->back()->with('error', 'Unauthorized action.');
    }

    public function destroy(User $user)
    {
        // Exclude currently authenticated user
        if ($user->id !== Auth::id()) {
            abort(403);
        }

        // Delete the user
        $user->delete();

        // Log out the user after deletion
        Auth::logout();

        // Redirect to home page with success message
        return redirect()->route('home')->with('success', 'Your account has been deleted successfully.');
    }
}
