<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function editUserInfo($id) {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('/')->with('error', 'User not found.');
        }
        return view('edit', compact('user'));
    }

    // public function updateUserInfo(Request $req, $id) {
    //     $user = User::find($id);
    //     $user->name = $req->input('name');
    //     $user->surname = $req->input('surname');
    //     $user->email = $req->input('email');
    //     $user->grade_level = $req->input('grade_level');
    //     $user->number = $req->input('number');
    //     $user->school = $req->input('school');
    //     $user->location = $req->input('location');
    //     $user->update();
    //     return redirect('')->with('status', "Data updated successfully!");
    // }

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
            'password' => 'sometimes|nullable|confirmed'
        ]);

        if (!empty($incomingFields['password'])) {
            $incomingFields['password'] = bcrypt($incomingFields['password']);
        } else {
            unset($incomingFields['password']);
        }

        $user->update($incomingFields);

        return redirect()->route('profile.show', ['encryptedId' => encrypt($user->id)])
                        ->with('success', 'Profile updated successfully.');
    }
}
