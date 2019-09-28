@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Editar mi imagen</div>

                <div class="card-body">
                    <form action="{{ route('image.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="image_id" value="{{ $image->id }}">

                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-7">
                                @if ($image->user->image)
                                    <div class="container-avatar">
                                        <img src="{{ route('user.avatar', ['filename'  => $image->user->image]) }}" alt="" class="avatar img-responsive">
                                    </div>
                                @endif

                                <input type="file" name="image_path" id="image_path" class="form-control" required>

                                @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-7">
                                <textarea name="description" id="description" cols="30" rows="10" required
                                    class="form-control">{{ $image->description }}</textarea>

                                @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" value="Actualizar Imagen" id="enviar" class="btn btn-primary">
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection