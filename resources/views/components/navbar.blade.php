<?php
use Illuminate\Support\Facades\Vite;


?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ Vite::asset('resources/images/blogLogo.gif') }}" alt="">
            Blogy
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            @if ($inDashBoard)
                <li class="nav-item ">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link active" href="{{ route('dashBoard') }}">DashBoard</a>
                </li>
            @endif

            @if (!$inDashBoard)
                <li class="nav-item active">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashBoard') }}">DashBoard</a>
                </li>
            @endif


        </ul>
        </div>
    </div>
</nav>
