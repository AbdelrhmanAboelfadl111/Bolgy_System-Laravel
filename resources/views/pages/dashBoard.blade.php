<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DashBoard</title>
    @Vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <x-navbar :inDashBoard="$inDashBoard"/>

    <section class="header py-3">
        <div class="container d-flex justify-between">
            <div class="text w-100">
                <p class="postSpan">{{ $postsCount }} Posts</p>
                <h1>Dash Board</h1>
                <p class="textBrief">Edit, Delete, Restore And <span style="color: red">Force Delete</span> Your <span style="color: blue">Posts</span></p>
                <ul>
                    @if ($inTrashed)
                        <a href="{{ route('dashBoard') }}">
                            <li >
                                All
                            </li>
                        </a>
                        <a href="{{ route('trashedData') }}" class="active">
                            <li >
                                Trashed -> {{ $postsCount }}
                            </li>
                        </a>
                        <a href="{{ route('publishedData') }}" >
                            <li >
                                Published
                            </li>
                        </a>
                    @endif

                    @if ($inAll)
                        <a href="{{ route('dashBoard') }}" class="active">
                            <li >
                                All -> {{ $postsCount }}
                            </li>
                        </a>
                        <a href="{{ route('trashedData') }}">
                            <li >
                                Trashed
                            </li>
                        </a>
                        <a href="{{ route('publishedData') }}" >
                            <li >
                                Published
                            </li>
                        </a>
                    @endif


                    @if ($inPublished)
                        <a href="{{ route('dashBoard') }}" >
                            <li >
                                All
                            </li>
                        </a>
                        <a href="{{ route('trashedData') }}">
                            <li >
                                Trashed
                            </li>
                        </a>
                        <a href="{{ route('publishedData') }}" class="active">
                            <li >
                                Published-> {{ $postsCount }}
                            </li>
                        </a>
                    @endif

                </ul>
            </div>
            <div class="addPost w-100 d-flex justify-content-end align-items-center">
                <a href="{{ route('post.add') }}" style="text-decoration: none">
                    <button class="btn btn-primary d-flex justify-center align-items-center"><i class="fa-solid fa-plus d-flex justify-center align-items-center"></i>New Post</button>
                </a>
            </div>
        </div>
    </section>


    <section class="main py-5">
        <div class="container">
            <div class="row">
                    @foreach ($posts as $post)
                    <div class="column col-12">
                        <x-postBox :post="$post" :inDashBoard="$inDashBoard" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="paginationSection d-flex justify-content-center align-items-center">
    {{ $posts->links() }}
</section>
</body>
</html>
