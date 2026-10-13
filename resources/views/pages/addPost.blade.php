<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DashBoard/Add New Post</title>
    @Vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="addPost">
    <x-navbar :inDashBoard="$inDashBoard"/>

    <section class="header addPost py-5">
        <div class="container d-flex justify-between">
            <div class="text w-100">
                <p class="postSpan">DashBoard</p>
                <h1>Add New Post</h1>
                <p class="textBrief">Fill in the details below and <span style="color: blue">publish</span> it to the home page.</p>
            </div>
        </div>
    </section>

    <section class="main py-5">
        <div class="container">

                @session('success')
                    <p class="alert alert-success">
                        {{ $value }}
                    </p>
                @endsession
            <form action="{{ route("post.submitAdd") }}" method="POST">
                @csrf
            <div class="title">
                <label for="Title" class="form-label">Title </label>
                <input value="{{ old('Title') }}" name="Title" class="form-control " type="text" id="Title" placeholder="Title" aria-label="Large input example">
                @error('Title')
                    <p class="alert alert-danger mt-3"> {{ $message }}</p>
                @enderror
            </div>
            <div class="author_name">
                <label for="author_name" class="form-label">Author Name </label>
                <input value="{{ old('author_name') }}" name="author_name" class="form-control " type="text" id="author_name" placeholder="Author Name" aria-label="Large input example">
                @error('author_name')
                    <p class="alert alert-danger mt-3"> {{ $message }}</p>
                @enderror
            </div>
            <div class="description">
                <label for="description" class="form-label">Description </label>
                <textarea name="description" class="form-control resize-none" id="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <p class="alert alert-danger mt-3"> {{ $message }}</p>
                @enderror
            </div>
            <div class="dashed w-100"></div>
            <div class="operations">
                <button class="btn btn-primary">Add</button>
                <a href="{{ route('dashBoard') }}">
                    <button type="button" class="btn btn-danger">cancel</button>
                </a>
            </div>
        </form>
        </div>
    </section>




</body>
</html>
