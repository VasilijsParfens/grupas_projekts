@extends('layout')
@section('content')

    <div class="browse-tabs">
        <a href="/newest"><div class="browse-tab" id="newTab">New</div></a>
        <a href="/popular"><div class="browse-tab browse-active" id="popularTab">Popular</div></a>
        @auth
            <a href="/following"><div class="browse-tab" id="followingTab">Following</div></a>
        @endauth
        <a href="/trending"><div class="browse-tab" id="trendingTab">Trending</div></a>
    </div>

    <h2 style="text-align: center;">Popular posts</h2>

    <div class="browse-content-slots">
        <!-- Post slots -->
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 1</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 2</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 3</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 4</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 5</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 6</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 7</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 8</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 9</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 10</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 11</div>
        </div>
        <div class="browse-slot">
            <div class="browse-slot-image"></div>
            <div class="browse-slot-text">Post 12</div>
        </div>
    </div>
@endsection
