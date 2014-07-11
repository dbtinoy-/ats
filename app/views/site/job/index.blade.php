@extends('site.layouts.default')

{{-- Content --}}
@section('content')
<!--@foreach ($posts as $post)
<div class="row">
    <div class="col-xs-8">
         Post Title 
        <div class="row">
            <div class="col-xs-8">
                <h4><strong><a href="{{{ $post->url() }}}">{{ String::title($post->title) }}</a></strong></h4>
            </div>
        </div>
         ./ post title 

         Post Content 
        <div class="row">
            <div class="col-xs-2">
                <a href="{{{ $post->url() }}}" class="thumbnail"><img src="http://placehold.it/260x180" alt=""></a>
            </div>
            <div class="col-xs-6">
                <p>
                    {{ String::tidy(Str::limit($post->content, 200)) }}
                </p>
                <p><a class="btn btn-mini btn-default" href="{{{ $post->url() }}}">Read more</a></p>
            </div>
        </div>
         ./ post content 

         Post Footer 
        <div class="row">
            <div class="col-xs-8">
                <p></p>
                <p>
                    <span class="glyphicon glyphicon-user"></span> by <span class="muted">{{{ $post->author->username }}}</span>
                    | <span class="glyphicon glyphicon-calendar"></span> Sept 16th, 2012{{{ $post->date() }}}
                    | <span class="glyphicon glyphicon-comment"></span> <a href="{{{ $post->url() }}}#comments">{{$post->comments()->count()}} {{ \Illuminate\Support\Pluralizer::plural('Comment', $post->comments()->count()) }}</a>
                </p>
            </div>
        </div>
         ./ post footer 
    </div>
</div>

<hr />
@endforeach-->

<!--{{ $posts->links() }}-->
 <a href="{{{ URL::to('user/cvs/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
       
@stop
{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    var oTable;
    $(document).ready(function() {
        $(".iframe").colorbox({iframe: true, width: "60%", height: "80%"});
    });
</script>
@stop