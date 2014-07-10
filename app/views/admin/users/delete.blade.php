@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    {{-- Delete User Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('admin/users/' . $user->id . '/delete') }}@endif" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $user->id }}" />
        <!-- ./ csrf token -->
        <p>Are you sure you want to delete?</p>
        <!-- Form Actions -->
            <div class="text-right">
                <button class="btn btn-sm btn-link close_popup">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        <!-- ./ form actions -->
    </form>
@stop