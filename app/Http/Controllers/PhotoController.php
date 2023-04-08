<?php

namespace App\Http\Controllers;

//use App\Models\Data\Photo;
//use App\Models\Registration\Registration;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller {
    static public function getPhotoById($id) {
        return Photo::where('id', $id)->first();
    }

    public function deleteRegistrationImage() {
        $user = Auth::user();
        $photo = $user->photo;

            $this::deletePhoto($photo);
        $user->photo = null;
        $user->save();
        return back();
    }

    public function getUserImage(User $user, $filename) {
        return PhotoController::getUserProfilePhoto($user);
    }
    public function getProfileImage($filename) {
        return PhotoController::getUserProfilePhoto();
    }
    public function updateRegistrationImage(Request $request) {
        $user = Auth::user();
        $croppingData = json_decode($request->all()['avatar_data']);

        $this->validate($request, [
            'avatar_file' => 'required|image|mimes:jpeg,png,jpg,bmp|max:2048',
        ]);
//        dd('tut');
        if($user->photo !== null) {
         //  self::deletePhotoFile($user->photo);
        }
        $imageName = 'r' . $user->id . '_' . time() . '.' . $request->avatar_file->getClientOriginalExtension();

        $user->photo= $imageName;
        $user->save();
        $fieldFile = $request->file('avatar_file');
        $mime= $fieldFile->getClientOriginalExtension();
//            $imageName = time().".".$mime;
        $image = Image::make($fieldFile);
//            dd($image);
        $image =  $image->orientate();
        $image = $image->crop((int) $croppingData->width, (int) $croppingData->height, (int) $croppingData->x, (int) $croppingData->y);
        Storage::disk('profile_photos')->put($imageName, $image->stream());
        return back();
    }
//    static public function getPhotoByFilename($filename) {
//        return Photo::where('file_name', $filename)->first();
//    }

    public static function deletePhoto($photo) {
        $filename = $photo;
        $path = storage_path("app/profile_photos/") . $filename;

        if(File::exists($path)) File::delete($path);

    }



    public static function getPhotoByPath(String $filename, String $path) {
        if(!File::exists($path)) abort(404);

        $type = File::mimeType($path);
//        ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
        $headers = array(
            'Content-Type: ' . $type,
            'Cache-Control: '. 'no-store, no-cache, must-revalidate'
        );

        return response()->download($path, $filename, $headers);
    }


    public static function getUserProfilePhoto( $user =null) {
        if(is_null($user))
        $user = Auth::user();
//        dd($user);
        $profileImage = $user->photo;

        // Check if registration belonging to user
        if( !is_null($user) &&
            !is_null($profileImage))  {
            $filename =  $profileImage;
            $path = storage_path("app/profile_photos/") . $filename;
        } else {
            $filename = 'default-user-image.png';
            $path = public_path("images/") . $filename;
        }
//        dd($path);
        return PhotoController::getPhotoByPath($filename, $path);
    }

    public static function getPhoto(Photo $photo) {
        $filename = $photo->file_name;
        $path = storage_path("app/" . $photo->storage_name . "/") . $filename;

        return PhotoController::getPhotoByPath($filename, $path);
    }

}
