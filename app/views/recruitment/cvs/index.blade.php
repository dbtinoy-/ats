@extends('recruitment.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Cvs recruitmentistration @stop
@section('author') @stop
@section('description')Jobs recruitmentistration index @stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h3>
        {{{ $title }}}

        <div class="pull-right">
            <a href="{{{ URL::to('recruitment/cvs/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
        </div>
    </h3>
</div>

<table id="jobs" class="table table-striped table-hover">
    <thead>
        <tr>
            <th class="col-xs-4">{{{ Lang::get('recruitment/cvs/table.title') }}}</th>
            <th class="col-xs-2">{{{ Lang::get('recruitment/cvs/table.status') }}}</th>
            <th class="col-xs-2">{{{ Lang::get('recruitment/cvs/table.created_at') }}}</th>
            <th class="col-xs-2">{{{ Lang::get('table.actions') }}}</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@stop

{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
    var oTable;
    $(document).ready(function() {
        oTable = $('#jobs').dataTable({
            "sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "Show _MENU_ records per page"
            },
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "{{ URL::to('recruitment/cvs/data') }}",
            "fnDrawCallback": function(oSettings) {
                $(".iframe").colorbox({iframe: true, width: "60%", height: "80%"});
                $(".iframe-small").colorbox({iframe: true, width: "30%", height: "30%"});
            }
        });
    });
</script>
@stop