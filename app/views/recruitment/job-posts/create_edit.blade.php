@extends('recruitment.layouts.modal')

{{-- Content --}}
@section('content')
<!-- Tabs -->
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
</ul>
<!-- ./ tabs -->

{{-- Edit Job Form --}}
<form class="form-horizontal" method="post" action="@if (isset($post)){{ URL::to('recruitment/job-posts/' . $post->id . '/edit') }}@endif" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <!-- ./ csrf token -->

    <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
            <!-- Post Title -->
            <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                <div class="col-xs-12">
                    <label class="control-label" for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($post) ? $post->title : null) }}}" />
                    <span class="help-block">{{{ $errors->first('title', ':message') }}}</span>
                </div>
            </div>
            <!-- ./ post title -->

            <!-- Content -->
            <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                <div class="col-xs-12">
                    <label class="control-label" for="content">Description</label>
                    <textarea class="form-control full-width wysihtml5" name="content" value="content" rows="10">{{{ Input::old('content', isset($post) ? $post->content : null) }}}</textarea>
                    <span class="help-block">{{{ $errors->first('content', ':message') }}}</span>
                </div>
            </div>
            <!-- ./ content -->
        </div>
        <!-- ./ general tab -->
    </div>
    <!-- ./ tabs content -->

    <!-- Form Actions -->
    <div class="form-group">
        <div class="text-right controls">
            <button class="btn btn-sm btn-link close_popup">Cancel</button>
            <button type="reset" class="btn btn-sm btn-default">Reset</button>
            <button type="submit" class="btn btn-sm btn-success">@if (isset($post))Update @else New @endif</button>
        </div>
    </div>
    <!-- ./ form actions -->
</form>
@stop
