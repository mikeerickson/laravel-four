@foreach($dogs as $dog)
<li>
	<a href="{{ route('dogs.show', $dog->id) }}">
		{{ $dog->name }} : {{ $dog->age }}
	</a>
</li>
@endforeach