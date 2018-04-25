<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Upload;
use App\Models\FileUpload;
use Illuminate\Http\RedirectResponse;
use FFMpeg;
use Redirect;
use Request;

/**
 * Class UploadFormController.
 */
class UploadFormController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.videos.uploadform');
    }

    /**
     * Save video
     *
     * @return RedirectResponse
     */
    public function upload():RedirectResponse
    {
        // Get all $_GET,$_POST,$_FILES.
        $input = Request::all();
        $upload = new Upload();
        $result = $upload->validateVideo($input);
        if ($result['filename']) {
            $fileUpload = new FileUpload();
            $fileUpload->file_size = filesize(public_path('/videos/') . $result['filename']) / 1048576; // convert to MB
            // DIR_SEPARATOR for DOS users...
            $stream = FFMpeg::open('../../public/videos/' . $result['filename'])->getFirstStream();

            /** @noinspection PhpUndefinedMethodInspection */
            $fileUpload->bitrate = $stream->get('bit_rate');    /** @noinspection PhpUndefinedMethodInspection */
            $fileUpload->duration = gmdate('H:i:s', $stream->get('duration')); /** limited to 24 hours @noinspection PhpUndefinedMethodInspection */
            $fileUpload->video_format = $stream->get('codec_name');
            $fileUpload->video_name = $result['filename'];
            $fileUpload->save();
        }
        return Redirect::to('/uploadform')->with('message', $result['msg']);
    }
}
