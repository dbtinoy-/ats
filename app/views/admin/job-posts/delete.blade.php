@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    {{-- Delete Post Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($post)){{ URL::to('admin/job-posts/' . $post->id . '/delete') }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $post->id }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <p>Are you sure you want to delete?</p>
            <div class="text-right">
                <button class="btn btn-sm btn-link close_popup">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        <!-- ./ form actions -->
    </form>
@stop