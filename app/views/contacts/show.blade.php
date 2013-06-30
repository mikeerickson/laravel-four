@extends ('layouts._default')

@section('content')

	{{ Form::open() }}

		{{ Form::hidden('id', $contact->id) }}
		{{ Form::hidden('page', Input::get('page')) }}

		<p>
			<div class="switch" data-on-label="Active" data-off-label="Inactive" style="width: 125px;">
				{{ Form::checkbox('active', '1', $contact->active, ['disabled' => 'true'] ) }}
			</div>
		</p>

		{{ Form::label('compName','Company Name:') }}
		{{ Form::text('compName', (is_null($contact->company) ? "" : $contact->company->companyName),
			['readonly' => 'true']) }}

		{{ Form::label('lname','Last Name:') }}
		{{ Form::text('lname', $contact->lname, ['readonly' => 'true']) }}

		{{ Form::label('fname','First Name:') }}
		{{ Form::text('fname', $contact->fname, ['readonly' => 'true']) }}

		{{ Form::label('status','Status:') }}
		{{ Form::select('status', $status, $contact->status, ['disabled' => 'true', 'style' => 'width: 220px']) }}

		{{ Form::label('phone','Phone:') }}
		{{ Form::text('phone', $contact->phone, ['readonly' => 'true']) }}

		{{ Form::label('email','E Mail:') }}
		{{ Form::text('email', $contact->email, ['readonly' => 'true']) }}

		<p>
			<div id="toolbar">
				<a class="btn btn-success btn-small" href="/contacts/{{ $contact->id }}/edit/?page={{ Input::get('page') }}" style="width: 100px; line-height: 24px;">Edit</a>&nbsp;&nbsp;
				<a href="/contacts?page={{ Input::get('page') }}">Cancel</a>
			</div>
		</p>


	{{ Form::close() }}
@stop
