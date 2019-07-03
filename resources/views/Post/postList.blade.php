@extends('layouts.layout')

@section('content')
<div id="post-list">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col-md-11">
            <h3>Post List</h3>
    </div>

<div class="row justify-content-center">
        <form action="/posts/search" method="GET" class="form-inline">
            @csrf
            <div class="form-group mb-2">
                <input type="text" name="search" value="{{session('searchKeyword')}}" class="form-control mb-4 mr-3" placeholder="Search...">
                <button type="submit" class="btn btn-primary mb-4 mr-3">Search</button>
                <a href="/post/create" class="btn btn-primary mb-4 mr-3">Add</a>
                <a href="/csv/upload" class="btn btn-primary mb-4 mr-3">Upload</a>
                <a href="/download" class="btn btn-primary mb-4 mr-3">Download</a>
            </div>
        </form>
    </div>
</div>
