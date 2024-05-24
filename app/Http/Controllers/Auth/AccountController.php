<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Services\ImageService;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ImageUploadRequest;
use App\Http\Requests\UpdateProfileRequest;

class AccountController extends Controller
{
    private $imageService;

    public function __construct(ImageService $cartService)
    {
        $this->imageService = $cartService;
    }

    public function show()
    {
        return view('auth.account', [ 'user' => Auth::user() ]);
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $validatedData = $request->validated();
        $user->update($validatedData);
        return response()->json(['mensaje' => 'actualizado']);
    }
    
    public function updateProfileImg(ImageUploadRequest $request, User $user)
    {
        $newFilename = $this->imageService->uploadImage($request->file('img'), 'avatares');
        if ($user->img) {
            $this->imageService->deleteImage($user->img);
        }

        $user->img = $newFilename;
        $user->save();
        
        return response()->json([
            'mensaje' => 'actualizado',
            'newAvatarPath' => $user->avatar_url
        ]);
    }
}
