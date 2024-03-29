<div class="card pub_image">
    <div class="card-header">

        @if ($image->user->image)
        <div class="container-avatar">
            <img src="{{ route('user.avatar', ['filename'  => $image->user->image]) }}" alt=""
                class="avatar img-responsive">
        </div>
        @endif

        <div class="data-user">
            <a href="{{ route('profile', ['id' => $image->user->id]) }}">
                {{ $image->user->name.' '.$image->user->surname }}
                <span class="nickname">
                    {{' | @'.$image->user->nick}}
                </span>
            </a>
        </div>

    </div>

    <div class="card-body">
        <div class="image-container">
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
            <img src="{{ asset('img/heart-red.png') }}" alt="" data-id="{{ $image->id }}" class="btn-dislike">
            @else
            <img src="{{ asset('img/heart-black.png') }}" alt="" data-id="{{ $image->id }}" class="btn-like">
            @endif

            {{-- count of likes --}}
            <span class="numer-likes">{{ count($image->likes) }}</span>
        </div>

        <div class="comments">
            <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="btn btn-sm btn-warning btn-comments">
                Comentarios ({{ count($image->comments) }})
            </a>
        </div>
    </div>
</div>