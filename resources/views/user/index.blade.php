@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Gente</h1>

            <form action="{{ route('user.index') }}" method="GET" id="search-form">
                <div class="row">

                    <div class="form-group col">
                        <input type="text" class="form-control" id="search"
                            placeholder="Busca gente por nombre, nick, o apellido">
                    </div>

                    <div class="form-group col btn-search">
                        <input type="submit" class="btn btn-primary" value="Buscar">
                    </div>

                </div>
            </form>

            <hr>

            <div class="profile-user">

                @foreach ($users as $user)
                @if ($user->image)
                <div class="container-avatar">
                    <img src="{{ route('user.avatar', ['filename' => $user->image]) }}" alt=""
                        class="img-responsive-profile">
                </div>
                @endif

                <div class="user-info">
                    <h2>{{ '@'.$user->nick }}</h2>
                    <h3>{{ $user->name.' '.$user->surname }}</h3>
                    <p>{{ 'se unió: '.\FormatTime::LongTimeFilter($user->created_at) }}</p>
                    <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-success">Ver perfil</a>
                </div>


                <div class="clearfix"></div>
                <hr>
                @endforeach
            </div>

            <!--PAGINATION-->
            <div class="clearfix"></div>
            {{ $users->links() }}

        </div>
    </div>
</div>
@endsection