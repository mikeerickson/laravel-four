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

	<p>
		<div class="switch switch-small" data-on-label="Active" data-off-label="Inactive" style="width: 100px;">
			{{ Form::checkbox('active', '1', $user->active ) }}
		</div>
	</p>

	{{ Form::label('username','User Name:') }}
	{{ Form::text('username', $user->username,
		[
			'data-required' => 'true',
			'data-trigger'  => 'change',
		])
	}}

	{{ Form::label('password','Password:') }}
	{{ Form::text('password', $user->password, ['disabled' => 'disabled','style' => 'width: 450px'] ) }}

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
			'data-required' => 'true',
			'data-size'     => 'auto',
			'style'			=> 'width: 220px'
		])
	}}

	<p>
		<div id="toolbar">
			<p> {{ Form::submit('Save',['class' => 'btn btn-small btn-primary']) }}
			&nbsp;&nbsp;<a href="/users?page={{ Input::get('page') }}">Cancel</a>
			</p>
		</div>
	</p>

	{{ Form::close() }}

@stop