@extends('layouts.app')

@section('title', 'DEMO Blog')

@section('social')
    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="{{ $post->title }}"/>
    <meta property="og:image" content="{{ Voyager::image($post->thumbnail('medium')) }}"/>
    <meta property="og:url" content="/post/view/{{ $post->id }}"/>
    <meta property="og:site_name" content="{{ $post->title }} | Demo Page"/>
    <meta property="og:description" content="{{ str_replace(array("\r", "\n", "\r\n", "\n\r"), '', strip_tags($post->body)) }}"/>
    <meta name="twitter:title" content="{{ $post->title }}" />
    <meta name="twitter:image" content="{{ Voyager::image($post->thumbnail('medium')) }}" />
    <meta name="twitter:url" content="/post/view/{{ $post->id }}" />
    <meta name="twitter:card" content="" />
@endsection

@section('blog_single')
    <aside id="colorlib-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 breadcrumbs text-center">
                    <h2>Blog detail</h2>
                    <p><span><a href="/">Home</a></span> / <span><a href="/">Blog </a></span> / <span>{{ $post->title }}</span></p>
                </div>
            </div>
        </div>
    </aside>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 content">
            <div class="row row-pb-lg">
                <div class="col-md-12">
                    <div class="blog-entry">
                        <div class="blog-img blog-detail ">
                            <img width="60%" src="{{ Voyager::image($post->image) }}" class="img-responsive" alt="html5 bootstrap template">
                        </div>
                        <div class="desc">
                            <p class="meta">
                                <span class="cat"><a href="#">{{ $post->name }}</a></span>
                                <span class="date">{{ date('Y-m-d', strtotime($post->created_at)) }}</span>
{{--                                <span class="pos">By <a href="#">Rich</a></span>--}}
                            </p>
                            <h2><a href="/blog/view/{{ $post->id }}">{{ $post->title }}</a></h2>
                            <p>
                                {!! $post->body !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
