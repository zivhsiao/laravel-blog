@extends('layouts.app')

@section('title', 'DEMO Blog')

@section('main_page')
    <aside id="colorlib-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12 breadcrumbs text-center">
                    <h2>Blog</h2>
                    <p><span><a href="/">Home</a></span></p>
                </div>
            </div>
        </div>
    </aside>
@endsection

@section('content')
    <div class="row row-pb-md">
        @foreach($posts as $post)
        <div class="col-md-4" style="height: 500px;">
            <div class="blog-entry">
                <div class="blog-img">
                    <a href="/blog/view/{{ $post->post_id }}">
                        <img src="{{ Voyager::image($post->thumbnail('medium')) }}" class="img-responsive" alt="html5 bootstrap template">
                    </a>
                </div>
                <div class="desc">
                    <p class="meta">
                        <span class="cat"><a href="#">{{ $post->name }}</a></span>
                        <span class="date">{{ date('Y-m-d', strtotime($post->created_at)) }}</span>
{{--                        <span class="pos">By <a href="#">Rich</a></span>--}}
                    </p>
                    <h2><a href="/blog/view/{{ $post->post_id }}">{{ $post->title }}</a></h2>
                    <p>{{  Str::limit($post->excerpt, 150, '...') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

{{--    <div class="row">--}}
{{--        <div class="col-md-12 text-center">--}}
{{--            <ul class="pagination">--}}
{{--                <li class="disabled"><a href="#">&laquo;</a></li>--}}
{{--                <li class="active"><a href="#">1</a></li>--}}
{{--                <li><a href="#">2</a></li>--}}
{{--                <li><a href="#">3</a></li>--}}
{{--                <li><a href="#">4</a></li>--}}
{{--                <li><a href="#">&raquo;</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
