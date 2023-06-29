<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $tags = Tag::all();
        return view('auth.register', compact('tags'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'tags' => 'required|array|min:3|max:5',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // after passing validation
        $custom_profile_image = !is_null($request->profile_image);
        if($custom_profile_image) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $image = Image::make($request->file('profile_image'))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(storage_path('app/public/images/' . $imageName));
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->profile_image_path = (($custom_profile_image)? 'images/' . $imageName : null);
        $user->tags()->attach($request->tags);

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
