<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DashBoard/Edit Post</title>
    @Vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="addPost">
    <x-navbar :inDashBoard="$inDashBoard"/>

    <section class="header addPost py-5">
        <div class="container d-flex justify-between">
            <div class="text w-100">
                <p class="postSpan">DashBoard</p>
                <h1>Edit <span style="color: blue">{{ $author_name }}'s</span> Post</h1>
                <p class="textBrief">Fill in the details below and <span style="color: blue">publish</span> it to the home page.</p>
            </div>
        </div>
    </section>

    <section class="main py-5">
        <div class="container">
            <div class="row editPost">

                <div class="col-md-6 col-lg-8 column">
                    <form action="{{ route("post.submitEdit",['id'=>$id]) }}" method="POST">
                        @csrf
                        <div class="title">
                            <label for="Title" class="form-label">Title </label>
                            <input value="{{ $post->title }}" name="Title" class="form-control " type="text" id="Title" placeholder="Title" aria-label="Large input example">
                            @error('Title')
                                <p class="alert alert-danger mt-3"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="author_name">
                            <label for="author_name" class="form-label">Author Name </label>
                            <input value="{{ $post->author_name }}" name="author_name" class="form-control " type="text" id="author_name" placeholder="Author Name" aria-label="Large input example">
                            @error('author_name')
                                <p class="alert alert-danger mt-3"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="description">
                            <label for="description" class="form-label">Description </label>
                            <textarea name="description" class="form-control resize-none" id="description" rows="4">{{ $post->fullbody }}</textarea>
                            @error('description')
                                <p class="alert alert-danger mt-3"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="dashed w-100"></div>
                        <div class="operations">
                            <button class="btn btn-primary">Edit</button>
                            <a href="{{ route('dashBoard') }}">
                                <button type="button" class="btn btn-danger">cancel</button>
                            </a>
                        </div>
                    </form>
                </div>

                <div class="col-md-6 col-lg-4 column">
                    <div class="details">
                        <div class="detailsBox">
                            <h5 class="titleBox">Post Details</h5>
                            <div class="dashed w-100"></div>
                            <div class="id">
                                <h6 class="titleId">ID</h6>
                                <h6 class="idValue">{{ $id }}</h6>
                            </div>
                            <div class="date">
                                <h6 class="titleId">Created</h6>
                                <h6 class="idValue">{{ $created_at }}</h6>
                            </div>
                        </div>
                    <div class="deleteBox">
                            <h5 class="titleBox">Danger zone</h5>
                            <div class="dashed w-100"></div>
                            <h6 class="deleteText">Moving this post to the trash hides it from the home page. You can restore it any time from the dashboard.</h6>
                            <a href="{{ route('post.delete',['id' => $id ]) }}"><button>Move To Trash</button></a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>




</body>
</html>
