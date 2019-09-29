@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

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