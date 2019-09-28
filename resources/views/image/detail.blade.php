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
                        <img src="{{ route('user.avatar', ['filename'  => $image->user->image]) }}" alt=""
                            class="avatar img-responsive">
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
                        <span class="nickname"> {{' | '.\FormatTime::LongTimeFilter($image->created_at) }} </span>
                        <p>{{ $image->description }}</p>
                    </div>
                    <div class="likes">
                        {{-- check the user´s like --}}
                        <?php $user_like = false; ?>
                        @foreach ($image->likes as $like)
                        @if ($like->user->id == Auth::user()->id)
                        <?php $user_like = true; ?>
                        @endif
                        @endforeach

                        {{-- depending the user show the correct icon --}}
                        @if ($user_like)
                        <img src="{{ asset('img/heart-red.png') }}" alt="" class="btn-dislike"
                            data-id="{{ $image->id }}">
                        @else
                        <img src="{{ asset('img/heart-black.png') }}" alt="" class="btn-like"
                            data-id="{{ $image->id }}">
                        @endif

                        {{-- count of likes --}}
                        <span class="numer-likes">{{ count($image->likes) }}</span>
                    </div>

                    @if (Auth::user() && Auth::user()->id == $image->user->id)
                        <div class="actions">
                            <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-sm btn-primary">Actualizar</a>
                        {{--<a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-sm btn-danger">Borrar</a>--}}

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
                                Borrar
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Si eliminas esta imagen no podrás recuperarla ¿Estás seguro de eliminar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                            <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Borrar definitivamente</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="clearfix"></div>

                    <div class="comments">

                        <h3>Comentarios ({{ count($image->comments) }})</h3>
                        <hr>
                        <form action="{{ route('comment.save') }}" method="post">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <p>
                                <textarea class="form-control {{ $errors->any() ? 'is-invalid' : '' }}" name="content"
                                    id="content" cols="30" rows="10"></textarea>
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
                            <span class="nickname"> {{' | '.\FormatTime::LongTimeFilter($comment->created_at) }} </span>
                            <p>{{ $comment->content }}
                                <br>
                                @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id
                                == Auth::user()->id))
                                <a href="{{ route('comment.delete', ['id' => $comment->id]) }}"
                                    class="btn btn-sm btn-danger">
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