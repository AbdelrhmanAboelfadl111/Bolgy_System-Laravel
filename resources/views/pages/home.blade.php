<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @Vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>

    <x-navbar :inDashBoard="$inDashBoard" />



    <section class="header py-3">
        <div class="container">
            <div class="text">
                <p class="postSpan">{{ $postsCount }} Posts</p>
                <h1>Latest <span style="color: blue">Posts</span></h1>
                <p class="textBrief">Stories, notes and ideas from our authors, newest first.</p>
            </div>
        </div>
    </section>


    <section class="main py-5">
        <div class="container">
            <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-md-6 column col-lg-4">
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
