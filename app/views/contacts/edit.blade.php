@extends ('layouts._default')

@section('content')

	{{ Form::open(
		[
			'id'			=> 'contact',
			'method'        => 'put',
			'route'         => ['contacts.update',$contact->id],
			'data-validate' => 'parsley',
			'class'         => 'well well-large'
		])
	}}

		{{ Form::hidden('id', $contact->id) }}
		{{ Form::hidden('page', Input::get('page')) }}

		<p>
			<div class="switch switch-small" data-on-label="Active" data-off-label="Inactive" style="width: 100px;">
				{{ Form::checkbox('active', '1', $contact->active ) }}
			</div>
		</p>

		{{ Form::label('compName','Company Name:') }}
		{{ Form::text('compName', (is_null($contact->company) ? "" : $contact->company->companyName),
			['readonly' => 'true']) }}

		{{ Form::label('lname','Last Name:') }}
		{{ Form::text('lname', $contact->lname,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
			])
		}}

		{{ Form::label('fname','First Name:') }}
		{{ Form::text('fname', $contact->fname,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
			])
		}}
		{{ Form::label('status','Status:') }}
		{{ Form::select('status', $status, $contact->status,
			[
				'data-placeholder' => 'Select Status...',
				'data-required'    => 'true',
				'data-size'        => 'auto',
				'style'            => 'width: 220px'
			])
		}}

		{{ Form::label('phone','Phone:') }}
		{{ Form::text('phone', $contact->phone) }}

		{{ Form::label('email','E Mail:') }}
		{{ Form::text('email', $contact->email,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
				'data-type'	    => 'email',
			])
		}}

		<div id="toolbar">
			<p> {{ Form::submit('Save',['class' => 'btn-small btn btn-primary']) }}
			&nbsp;&nbsp;<a href="/contacts?page={{ Input::get('page') }}">Cancel</a>
			</p>
		</div>

	{{ Form::close() }}
@stop

