@extends ('layouts._default')

@section('content')

	{{ Form::open(
		[
			'id'			=> 'user',
			'method'        => 'put',
			'route'         => ['users.update',$user->id],
			'data-validate' => 'parsley',
			'class'         => 'well well-large'
		])
	}}

		{{ Form::hidden('id', $user->id) }}
		{{ Form::hidden('page', Input::get('page')) }}

		<p>{{ Form::checkbox('active', '1', $user->active ) }}&nbsp;Active</p>

		{{ Form::label('username','User Name:') }}
		{{ Form::text('username', $user->username,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
			])
		}}

		{{ Form::label('email','E-Mail:') }}
		{{ Form::text('email', $user->email,
			[
				'data-required' => 'true',
				'data-trigger'  => 'change',
				'data-type'	    => 'email'
			])
		}}

		{{ Form::label('category','Category:') }}
		{{ Form::select('category', $category, $user->category,
			[
				'class'         => '',
				'data-required' => 'true',
				'data-size'     => 'auto'
			])
		}}

		<div id="toolbar">
			<p> {{ Form::submit('Save',['class' => 'btn btn-small btn-primary']) }}
			&nbsp;&nbsp;<a href="/users?page={{ Input::get('page') }}">Cancel</a>
			</p>
		</div>

	{{ Form::close() }}

@stop