<h2> {{ strftime('%m.%d.%Y %I:%M %p') }} </h2>

<p>

{{ $family['father'] }} <br />
{{ $family['mother'] }} <br />
{{ $family['daughter1'] }} <br />
{{ $family['son1'] }} <br />
{{ $family['daughter2'] }} <br />
{{ $family['son2'] }} <br />

</p>

Hello {{ $fname }} {{ $lname }} form blade template, reporting for duty!  
<p>

@foreach ( $kids as $key => $item )
	<li>{{ $key+1 }}: {{ ucwords($item) }}
@endforeach

</p>

<p>

{{ strtoupper(implode($kids, " - ")) }} <br>


<p>
Random {{ Str::random(40) }} <br />
Singular {{ Str::singular('patties') }} <br />
Plural {{ Str::plural('patty') }}
</p>


</p>

<p>

{{ implode($family, "<br>") }}<br/>
{{ implode($dogs, "<br>") }}

</p>


<div id="meidoform">
	{{ Form::open() }}


	{{ Form::close() }}
</div>

<p>
Developed by: {{ $designer }}
</p>


