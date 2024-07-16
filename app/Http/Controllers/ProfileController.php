<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editUserInfo($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('/')->with('error', 'User not found.');
        }
        return view('edit', compact('user'));
    }


    public function updateUserInfo(Request $request, $id) {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('/')->with('error', 'User not found.');
        }

        $incomingFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'grade_level' => 'required',
            'number' => 'required',
            'school' => 'required',
            'location' => 'required',
            'current_password' => 'nullable',
            'password' => 'sometimes|nullable|confirmed'
        ]);

        // Check if current password is provided and correct
        if (!empty($incomingFields['current_password'])) {
            if (Hash::check($incomingFields['current_password'], $user->password)) {
                // Encrypt new password if provided
                if (!empty($incomingFields['password'])) {
                    $incomingFields['password'] = bcrypt($incomingFields['password']);
                } else {
                    unset($incomingFields['password']);
                }
            } else {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }
        } else {
            unset($incomingFields['password']);
        }

        // Remove the current_password field from incomingFields
        unset($incomingFields['current_password']);

        // Update user information
        $user->update($incomingFields);

        return redirect()->route('profile.show', ['encryptedId' => encrypt($user->id)])
                         ->with('success', 'Profile updated successfully.');
    }

}
