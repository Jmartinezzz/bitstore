<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ImageUploadRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ImageService;

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
        $newFilename = $this->imageService->uploadImage($request->file('img'), 'img/avatares');
        if ($user->img) {
            $deleteImagePath = public_path('img/avatares/' . $user->img);
            $this->imageService->deleteImage($deleteImagePath);
        }
        
        $user->img = $newFilename;
        $user->save();
        
        return response()->json([
            'mensaje' => 'actualizado',
            'newAvatarPath' => $user->avatar_url
        ]);
    }
}
