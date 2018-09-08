<?php

namespace App\Http\Controllers\Image;

use App\Http\Requests\UploadImageRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{

    /**
     * Patch to download image folder
     *
     * @var string
     */
    public $uploadPath = 'image_upload';

    /**
     * ImageController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Download photo user
     *
     * @param UploadImageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        if ($this->savePhoto($request)) {

            return redirect()->back()
                ->with('success', 'Your profile photo upload successfully');
        }
        return redirect()->back()
            ->with('warning', 'Your file exist');
    }

    /**
     * Save photo to data base
     *
     * @param Request $request
     * @return bool
     */
    public function savePhoto(Request $request)
    {
        $file = $request->file('image');
        $PhotoName = str_random(10) . $file->getClientOriginalName();

        if ($file->move($this->uploadPath, $PhotoName)) {
            $user = User::where('id', $request->input('user_id'))->first();
            $this->deleteOldFile($user);
            $user->update([
                'image' => $PhotoName,
            ]);

            return true;
        }
        return false;
    }

    /**
     * Delete old photo and patch if you exist
     *
     * @param $user
     * @return bool
     */
    public function deleteOldFile($user)
    {
        $deleted = $user->image;
        if ($deleted != null && file_exists($this->uploadPath . '/' . $deleted)) {
            unlink($this->uploadPath . '/' . $deleted);
        }
        return true;
    }


    /**
     * Remove photo user.
     *
     * @param User $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $image)
    {
        if (!empty($image->image)) {
            $this->deleteOldFile($image);
            $image->update([
                'image' => null
            ]);

            return redirect()->back()
                ->with('success', 'Your photo deleted!');
        }
        return redirect()->back()
            ->with('warning', 'sdfsdf!');
    }

}
