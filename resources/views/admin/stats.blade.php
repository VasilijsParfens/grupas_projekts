@extends('layout')
@section('content')
<div class="container">
    <div class="adm-button-container" style="text-align: center; margin-bottom: 60px; margin-top: 60px">
        <a href="{{ route('admin.users') }}" class="adm-button">Users</a>
        <a href="{{ route('admin.posts') }}" class="adm-button">Posts</a>
        <a href="{{ route('admin.comments') }}" class="adm-button">Comments</a>
        <a href="{{ route('admin.stats') }}" class="adm-button">Stats</a>
    </div>

    <h1 style="text-align: center;">Statistics</h1>

    <div class="stats-container" style="display: flex; justify-content: space-around; flex-wrap: wrap;">
        <div class="stat-block" style="background-color: #f28b82; color: white; border-radius: 10px; padding: 20px; text-align: center; margin: 10px; width: 200px; display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin-bottom: 10px;">Total Users</h2>
            <p style="font-size: 2rem; margin: 0;">{{ $totalUsers }}</p>
        </div>

        <div class="stat-block" style="background-color: #fbbc04; color: white; border-radius: 10px; padding: 20px; text-align: center; margin: 10px; width: 200px; display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin-bottom: 10px;">Total Posts</h2>
            <p style="font-size: 2rem; margin: 0;">{{ $totalPosts }}</p>
        </div>

        <div class="stat-block" style="background-color: #34a853; color: white; border-radius: 10px; padding: 20px; text-align: center; margin: 10px; width: 200px; display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin-bottom: 10px;">Total Comments</h2>
            <p style="font-size: 2rem; margin: 0;">{{ $totalComments }}</p>
        </div>

        <div class="stat-block" style="background-color: #4285f4; color: white; border-radius: 10px; padding: 20px; text-align: center; margin: 10px; width: 200px; display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin-bottom: 10px;">Total Likes</h2>
            <p style="font-size: 2rem; margin: 0;">{{ $totalLikes }}</p>
        </div>

        <div class="stat-block" style="background-color: #ea4335; color: white; border-radius: 10px; padding: 20px; text-align: center; margin: 10px; width: 200px; display: flex; flex-direction: column; justify-content: center;">
            <h2 style="margin-bottom: 10px;">Total Files</h2>
            <p style="font-size: 2rem; margin: 0;">{{ $totalFiles }}</p>
        </div>
    </div>
</div>
@endsection
