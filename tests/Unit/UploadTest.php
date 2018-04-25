<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Middleware\Upload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UploadTest extends TestCase
{

    /** @test */
    public function a_user_can_upload_a_video(): void
    {
        Storage::fake('public');
        $upload = new Upload();

        $file = $upload->validateVideo(
            ['file' => UploadedFile::fake()->create('wrestler.mp4', 1)],
            true
        );

        $this->assertEquals('wrestler.mp4', $file['filename']);
        $this->assertEquals('Video uploaded successfully', $file['msg']);
    }

    /** @test */
    public function a_user_cannot_upload_an_image(): void
    {
        Storage::fake('public');
        $upload = new Upload();

        $file = $upload->validateVideo(
            ['file' => UploadedFile::fake()->create('wrestler.jpg', 1)],
            true
        );

        $this->assertEquals('', $file['filename']);
        $this->assertEquals('Must be mp4 video!', $file['msg']);
    }
}
