@extends('site.layouts.modal')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.profile') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<form class="form-horizontal" method="post" action="@if (isset($cv)){{ URL::to('recruitment/cvs/' . $cv->id . '/edit') }}@endif" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <!-- ./ csrf token -->

    <!-- Tabs Content -->
    <div class="tab-content">
        <!-- General tab -->
        <div class="tab-pane active" id="tab-general">
            <!-- Cv Title -->
            <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
                <div class="col-xs-12">
                    <label class="control-label" for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($cv) ? $cv->title : null) }}}" />
                    <span class="help-block">{{{ $errors->first('title', ':message') }}}</span>
                </div>
            </div>
            <!-- ./ cv title -->

            <!-- Summary -->
            <div class="form-group {{{ $errors->has('summary') ? 'has-error' : '' }}}">
                <div class="col-xs-12">
                    <label class="control-label" for="summary">Description</label>
                    <textarea class="form-control full-width wysihtml5" name="summary" value="summary" rows="10">{{{ Input::old('summary', isset($cv) ? $cv->summary : null) }}}</textarea>
                    <span class="help-block">{{{ $errors->first('summary', ':message') }}}</span>
                </div>
            </div>
            <!-- ./ summary -->
        </div>
        <!-- ./ general tab -->


        <div class="tab-pane" id="tab-user-info">

            <div class="col-xs-4 {{{ $errors->has('user-firstname') ? 'error' : '' }}}">

                <label class="control-label" for="meta-title">First Name</label>
                <input class="form-control" type="text" name="user-firstname" id="user-firstname" value="{{{ Input::old('user-firstname', isset($cv->owner->firstname) ? $cv->owner->firstname : null) }}}" />
                {{{ $errors->first('user-firstname', '<span class="help-block">:message</span>') }}}

            </div>

            <div class="col-xs-4 {{{ $errors->has('user-middlename') ? 'error' : '' }}}">

                <label class="control-label" for="meta-title">Middle Name</label>
                <input class="form-control" type="text" name="user-middlename" id="user-firstname" value="{{{ Input::old('user-middlename', isset($cv->owner->middlename) ? $cv->owner->middlename : null) }}}" />
                {{{ $errors->first('user-middlename', '<span class="help-block">:message</span>') }}}

            </div>

            <div class="col-xs-4 {{{ $errors->has('user-lastname') ? 'error' : '' }}}">

                <label class="control-label" for="meta-title">Last Name</label>
                <input class="form-control" type="text" name="user-firstname" id="user-firstname" value="{{{ Input::old('user-lastname', isset($cv->owner->lastname) ? $cv->owner->lastname : null) }}}" />
                {{{ $errors->first('user-lastname', '<span class="help-block">:message</span>') }}}

            </div>


            <div class="col-xs-4 {{{ $errors->has('user-gender') ? 'error' : '' }}}">

                <label class="control-label" for="meta-title">Gender</label>
                <input class="form-control" type="text" name="user-gender" id="user-gender" value="{{{ Input::old('user-gender', isset($cv->owner->gender) ? $cv->owner->gender : null) }}}" />
                {{{ $errors->first('user-gender', '<span class="help-block">:message</span>') }}}

            </div>
            <div class="col-xs-4 {{{ $errors->has('user-gender') ? 'error' : '' }}}">

                <label class="control-label" for="meta-civil_status">Civil Status</label>
                <input class="form-control" type="text" name="user-civil_status" id="user-gender" value="{{{ Input::old('user-civil_status', isset($cv->owner->civil_status) ? $cv->owner->civil_status : null) }}}" />
                {{{ $errors->first('user-civil_status', '<span class="help-block">:message</span>') }}}

            </div>
            <div class="col-xs-4 {{{ $errors->has('user-gender') ? 'error' : '' }}}">

                <label class="control-label" for="meta-citizenship">Citizenship</label>
                <input class="form-control" type="text" name="user-citizenship" id="user-gender" value="{{{ Input::old('user-citizenship', isset($cv->owner->citizenship) ? $cv->owner->citizenship : null) }}}" />
                {{{ $errors->first('user-citizenship', '<span class="help-block">:message</span>') }}}

            </div>          

            <div class="col-xs-6 {{{ $errors->has('user-gender') ? 'error' : '' }}}">

                <label class="control-label" for="meta-phone">Phone</label>
                <input class="form-control" type="text" name="user-phone" id="user-phone" value="{{{ Input::old('user-phone', isset($cv->owner->phone) ? $cv->owner->phone : null) }}}" />
                {{{ $errors->first('user-phone', '<span class="help-block">:message</span>') }}}

            </div>
            <div class="col-xs-6 {{{ $errors->has('user-gender') ? 'error' : '' }}}">

                <label class="control-label" for="meta-email">Email</label>
                <input class="form-control" type="text" name="user-email" id="user-email" value="{{{ Input::old('user-email', isset($cv->owner->email) ? $cv->owner->email : null) }}}" />
                {{{ $errors->first('user-email', '<span class="help-block">:message</span>') }}}

            </div>          

        </div>

    </div>

</div>
<!-- ./ tabs content -->

<!-- Form Actions -->
<div class="form-group">
    <div class="text-right controls">
        <button class="btn btn-sm btn-link close_popup">Cancel</button>
        <button type="reset" class="btn btn-sm btn-default">Reset</button>
        <button type="submit" class="btn btn-sm btn-success">@if (isset($cv))Update @else New @endif</button>
    </div>
</div>
<!-- ./ form actions -->
</form>
@stop
