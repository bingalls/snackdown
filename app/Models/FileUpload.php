<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    bitrate
 * @property float  duration
 * @property float  file_size
 * @property string video_format
 * @property string video_name
 */
class FileUpload extends Model
{
    use \Spatie\Tags\HasTags;
    //
}
