@extends ('layouts._default')

@section('content')
	
	{{ Form::open(['route' => 'contacts.update']) }}

		{{ Form::hidden('id', $contact->id) }}
		{{ Form::hidden('page', Input::get('page')) }}

		<p>{{ Form::checkbox('active', '1', $contact->active, ['disabled' => 'true'] ) }}&nbsp;Active2 </p>

		{{ Form::label('lname','Last Name:') }}
		{{ Form::text('lname', $contact->lname, ['readonly' => 'true']) }}

		{{ Form::label('fname','First Name:') }}
		{{ Form::text('fname', $contact->fname, ['readonly' => 'true']) }}

		{{ Form::label('phone','Phone:') }}
		{{ Form::text('phone', $contact->phone, ['readonly' => 'true']) }}

		{{ Form::label('email','E Mail:') }}
		{{ Form::text('email', $contact->email, ['readonly' => 'true']) }}
		
	<div id="toolbar" style="display:none">
		<p> {{ Form::submit('Save',['class' => 'btn btn-small btn-info']) }}&nbsp;&nbsp;<a href="/contacts?page={{ Input::get('page') }}">Cancel</a></p>
	</div>
	
	<p>
	<a href="/contacts/{{ $contact->id }}/edit/?page={{ Input::get('page') }}">Edit</a>
	</p>
	
	{{ Form::close() }}
@stop
