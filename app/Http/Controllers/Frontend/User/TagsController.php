<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use Illuminate\Http\RedirectResponse;
use Redirect;
use Request;
use Spatie\Tags\Tag;

class TagsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.videos.tags');
    }

    /**
     * Save video
     *
     * @return RedirectResponse
     */
    public function upload():RedirectResponse
    {
        // Get all $_GET,$_POST
        $input = Request::all();
        if (array_key_exists('value', $input)) {
            // use the video ID for each tag type
            $tag = Tag::findOrCreate($input['value'], array_get($input,'id'));
            $fileUpload = new FileUpload();
            $upload = $fileUpload->find(array_get($input, 'id'));
            $upload->attachTag($tag);
        }
        return Redirect::to('/tags')->with('message', 'success');
    }
}
