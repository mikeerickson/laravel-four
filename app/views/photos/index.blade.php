@extends ('master')

@section('container')

	<ul class="photos">
		@foreach($photos as $photo)
		<li>
			<figure>
			<img src="/{{ $photo->path }} " width="128" height="128" alt="{{ $photo->caption }}">
			<figcaption>
				<a href="{{ route('photos.show', ['photos' => $photo->id ]) }}">
					{{ $photo->caption }}
				</a>
			</figcaption>
			</figure>
		</li>
		@endforeach
	</ul>
@stop