@extends('site.layouts.default')

{{-- Content --}}
@section('content')
@foreach ($resumes as $resume)
<div class="row">
	<div class="col-xs-8">
		<!-- Resume Title -->
		<div class="row">
			<div class="col-xs-8">
				<h4><strong><a>{{ String::title($resume->title) }}</a></strong></h4>
			</div>
		</div>
		<!-- ./ resume title -->
	</div>
</div>

<hr />
@endforeach

{{ $resumes->links() }}

@stop
