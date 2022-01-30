<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FaceBookController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Login Using Facebook
     */
    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->fields(['name', 'first_name', 'last_name', 'email', 'gender', 'verified'])->user();

            $is_user = User::where('email', $user->getEmail())->first();


            if(!$is_user) {
                $saveUser = User::updateOrCreate([
                    'facebook_id' => $user->getId(),
                ], [
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName() . '@' . $user->getId())
                ]);
                $this->imageService->storeImageAvatar($user->avatar_original, $saveUser->id);

            } else {
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'facebook_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }

            Auth::loginUsingId($saveUser->id);

            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
