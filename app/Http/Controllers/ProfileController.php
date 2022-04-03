<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    protected ImageService $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index(): Response
    {
        return Inertia::render('Profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required']
        ]);

        if($request->get('setPassword') === true)
        {
            $request->validate([
                'newPassword' => ['required'],
                'confirmNewPassword' => ['same:newPassword'],
            ]);
            if($user->password_set === 1)
            {
                $request->validate([
                    'oldPassword' => ['required', new MatchOldPassword],
                ]);
            }

           $user->update([
               'password'=> Hash::make($request->newPassword),
               'password_set'=>1]
           );
        }

        if($request->file('photo'))
        {
            $this->imageService->storeImageAvatar($request->file('photo'),$user->id);
        }
        $user->update([
                'first_name'=> $request->firstName,
                'last_name'=> $request->lastName,
                'about_me' => $request->aboutMe
            ]);
        return back()->with(['message'=>'Profil został zaktualizowany']);
    }
}
