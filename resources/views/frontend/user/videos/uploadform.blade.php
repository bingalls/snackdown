@extends('frontend.layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-upload"></i> {{ __('navs.frontend.upload') }}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 order-4 order-sm-1">
                            <div class="row">
                                <div class="col">
                                    <div class="container mb-4" id="app"><!--upload form-->

                                        @if (Session::has('message'))
                                            {{ Session::get('message') }}
                                            <hr />
                                        @endif

                                        <!--suppress SpellCheckingInspection, HtmlUnknownTarget -->
                                        <form action="uploadform" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="file" name="file">
                                            <input type="submit">
                                        </form>

                                    </div><!--upload form-->
                                </div><!--col-->
                            </div><!--row-->

                            <div class="row">

                                @foreach(\App\Models\FileUpload::all() as $video)   {{-- TODO paginate --}}
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <a href="videos/{{$video->video_name}}">{{basename ($video->video_name, '.mp4')}}</a>
                                        </div><!--card-header-->

                                        <div class="card-body">
                                            bit rate: {{$video->bitrate}}<br />
                                            duration: {{$video->duration}}<br />
                                            file size: {{$video->file_size}} M<br />
                                            format: {{$video->video_format}}<br />
                                        </div><!--card-body-->
                                    </div><!--card-->
                                </div><!--col-md-4-->
                                @endforeach

                            </div><!--row-->
                        </div><!--col-md-8-->
                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
