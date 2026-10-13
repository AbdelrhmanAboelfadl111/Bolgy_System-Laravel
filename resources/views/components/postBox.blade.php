<div class="itemBox ">
    <div  @class(['box', 'active' => $inDashBoard])>
        @if ($post -> deleted_at)
            <div class="layerDeleted">In Trashed</div>
        @endif
        <div class="heading">
            <h4 class="titlePost">
                {{ $post -> title }}
            </h4>
        </div>
        <div class="body">
            <p class="titleBrief">
                @if ($inDashBoard)
                    {{ $post -> fullBody }}
                @endif
                @if (!$inDashBoard)
                    {{ $post -> body }}
                @endif

            </p>
        </div>
        <div class="span"></div>
        <div class="info">
            <div class="imgCon">
                <h6 class="shortName"> {{ collect(explode(' ', $post->author_name))->map(fn($word) => substr($word, 0, 1))->implode('') }}</h6>
                <div class="date">
                    <h6>
                        {{ $post -> author_name }}
                    </h6>
                    <p>{{ $post->created_at?->format('F j, Y, g:i a') }}</p>
                </div>

            </div>
            @if ($inDashBoard)
                <div class="operations">
                    @if (!$post -> deleted_at)
                        <a href="{{ route('post.edit',['id' => $post -> id ,'author_name' => $post -> author_name, 'created_at' => $post->created_at?->format('F j, Y')])}}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('post.delete',['id' => $post -> id ]) }}" class="btn btn-warning">Delete</a>
                    @endif

                    @if ($post -> deleted_at)
                         <a href="{{ route('post.restore',['id' => $post -> id ]) }}" class="btn btn-primary">Restore</a>
                    @endif



                    <a href="{{ route('post.forceDelete',['id' => $post -> id ])}}" class="btn btn-danger" >Force Delete</a>
                </div>
            @endif

        </div>
    </div>
</div>
