<?php

namespace App\Http\Middleware;

//use Illuminate\Validation\Validator;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Validator;

/**
 * Class Upload
 * @package App\Http\Middleware
 */
class Upload
{
    /**
     * Check that upload is an mp4
     * @param array $input   Uploaded $_FILE
     * @param bool  $testing Default false, if not unit testing
     * @return array['filename', 'msg']
     */
    public function validateVideo(array $input, bool $testing = false):array
    {
        $validation = Validator::make($input, ['file' => 'required|file|max:20000|min:1']);

        if ($validation->fails()) {
            /** @noinspection PhpUndefinedFieldInspection */
            return ['filename' => '', 'msg' => $validation->errors()->first()];
        }

        $file = array_get($input, 'file');
        if (!$file) {
            return ['filename' => '', 'msg' => 'Missing file!'];
        }

        if ($file->getClientMimeType() !== 'video/mp4') {   //hmm mimes:mp4 didn't work in Validator
             return ['filename' => '', 'msg' => 'Must be mp4 video!'];
        }

        // Consider sql escape, too. Randomize with date('Ymd-His') . '_' .
        $fileName = htmlentities($file->getClientOriginalName());

        if (!$testing) {        // Running out of time to mock this
            $dbCheck = new FileUpload();
            if ($dbCheck->where('video_name', $fileName)->first()) {
                return ['filename' => '', 'msg' => 'Duplicate video!'];
            }
        }

        // move upload to DOCROOT/videos
        $upload_success = $file->move('videos', $fileName);

        if ($upload_success) {
            return ['filename' => $fileName, 'msg' => 'Video uploaded successfully'];
        }
        return ['filename' => '', 'msg' => 'Unexpected upload failure'];
    }
}
