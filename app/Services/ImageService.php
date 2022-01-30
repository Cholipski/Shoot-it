<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{

    public function storeImageAvatar(string $avatar, string $userId){
        $fileContents = file_get_contents($avatar);
        $path =  '/users/' . $userId . "/".$userId."_avatar.webp";
        $image = Image::make($fileContents)->encode('webp', 90)->resize(200, 250);
        Storage::put($path, $image);

        User::find($userId)->update([
            'avatar' => $path
        ]);

    }

}
