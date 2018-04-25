@extends('frontend.layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tags"></i> {{ __('navs.frontend.tags') }}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row"><!-- outer row -->
                        <div class="col-md-12 order-4 order-sm-1">
                            <div class="row"><!-- inner row -->

                                @foreach(\App\Models\FileUpload::all() as $video)   {{-- TODO paginate --}}
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <a href="videos/{{$video->video_name}}">{{basename ($video->video_name, '.mp4')}}</a>
                                            </div><!--card-header-->

                                            <div class="card-body">

                                                <form action="tags" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$video->id}}">
                                                    <input type="text" name="value" placeholder="keyword" title="keyword">
                                                    <input type="submit" value="Add">
                                                </form>

                                            </div><!--card-body-->
                                        </div><!--card-->
                                    </div><!--col-md-4-->
                                @endforeach

                            </div><!-- inner row -->
                        </div><!--col-md-12-->
                    </div><!-- outer row -->
                </div> <!-- card-body -->

                <div class="card-body">
                    <div class="row"><!-- outer row -->
                        <div class="col-md-12 order-4 order-sm-1">
                            <div class="row"><!-- inner row -->

                                @foreach(\Spatie\Tags\Tag::all() as $tag)   {{-- TODO paginate --}}
                                <div class="col-md-4">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            {{$tag->getAttributeValue('name')}}
                                        </div><!--card-header-->

                                        <ul class="card-body">
                                            {{--\App\Models\FileUpload::withAnyTags([$tag->getAttributeValue('name')],
                                             $tag->getAttributeValue('type'))->get()[0]->video_name--}}
                                            @foreach(\App\Models\FileUpload::withAnyTags([$tag->getAttributeValue
                                                ('name')], $tag->getAttributeValue('type'))->get() as $video)
                                                <li>{{$video->video_name}}</li>
                                            @endforeach
                                        </ul><!--card-body-->
                                    </div><!--card-->
                                </div><!--col-md-4-->
                                @endforeach

                            </div><!-- inner row -->
                        </div><!--col-md-12-->
                    </div><!-- outer row -->
                </div> <!-- card-body -->

            </div><!-- card -->
        </div><!-- col -->
    </div><!-- row mb-4 -->
@endsection
