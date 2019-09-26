@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @include('includes.message')

                <div class="card pub_image pub_image_detail">
                    <div class="card-header">
                        
                        @if ($image->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', ['filename'  => $image->user->image]) }}" alt="" class="avatar img-responsive">
                            </div>
                        @endif

                        <div class="data-user">
                            {{ $image->user->name.' '.$image->user->surname }}
                            <span class="nickname">
                                {{' | @'.$image->user->nick}}
                            </span>
                        </div>
                        
                    </div>

                    <div class="card-body">
                        <div class="image-container image-detail">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="">
                        </div>
                        
                        <div class="description">
                            <span class="nickname"> {{ '@'.$image->user->nick }} </span>
                            <span class="nickname">  {{' | '.\FormatTime::LongTimeFilter($image->created_at) }} </span>
                            <p>{{ $image->description }}</p>
                        </div>
                        <div class="likes">
                            <img src="{{ asset('img/heart-black.png') }}" alt="">
                        </div>
                        <div class="clearfix"></div>
                        <div class="comments">
                            
                            <h3>Comentarios ({{ count($image->comments) }})</h3>
                            <hr>
                            <form action="{{ route('comment.save') }}" method="post">
                                @csrf

                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                <p>
                                    <textarea class="form-control {{ $errors->any() ? 'is-invalid' : '' }}" name="content" id="content" cols="30" rows="10"></textarea>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </p>
                               

                                <button type="submit" class="btn btn-success">
                                    Enviar
                                </button>

                                
                            </form>

                            <hr>

                            <div class="comments">
                                @foreach ($image->comments as $comment)
                                    <span class="nickname"> {{ '@'.$comment->user->nick }} </span>
                                    <span class="nickname">  {{' | '.\FormatTime::LongTimeFilter($comment->created_at) }} </span>
                                    <p>{{ $comment->content }}
                                        <br>
                                        @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">
                                                Eliminar
                                            </a>
                                        @endif
                                    </p>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
        </div>

    </div>
</div>
@endsection
