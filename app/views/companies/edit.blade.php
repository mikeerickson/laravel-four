@extends ('layouts._default')

@section('content')

	{{ Form::open(
		[
			'id'			=> 'company',
			'method'        => 'put',
			'route'         => ['companies.update',$company->id],
			'data-validate' => 'parsley',
			'class'         => 'well well-large'
		])
	}}

		{{ Form::hidden('id', $company->id) }}
		{{ Form::hidden('page', Input::get('page')) }}

		{{ Form::label('companyName','Company Name:') }}
		{{ Form::text('companyName', $company->companyName,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
			])
		}}

		{{ Form::label('address','Address:') }}
		{{ Form::text('address', $company->address,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
			])
		}}

		{{ Form::label('city','City:') }}
		{{ Form::text('city', $company->city,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
			])
		}}

		{{ Form::label('state','State:') }}
		{{ Form::text('state', $company->state,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
			])
		}}

		{{ Form::label('zip','Zip Code:') }}
		{{ Form::text('zip', $company->zip,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
			])
		}}

		<div id="toolbar">
			<p> {{ Form::submit('Save',['class' => 'btn-small btn btn-primary']) }}
			&nbsp;&nbsp;<a href="/companies?page={{ Input::get('page') }}">Cancel</a>
			</p>
		</div>

	{{ Form::close() }}
@stop

