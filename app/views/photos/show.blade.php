@extends ('master')

@section('container')

	<h1>{{ $photo-> caption }}</h1>
	<img src="/{{ $photo->path }}" width="128" height="128" alt="{{ $photo->caption }}">

@stop