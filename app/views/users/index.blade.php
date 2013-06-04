@extends ('layouts._default')

@section('content')

	<div id="toolbar">
		<a class="btn btn-small btn-info" href="/users/create?page={{ Input::get('page') }}">
			<i class="icon-user icon-white"></i>&nbsp;&nbsp;New {{ Str::singular($title) }}</a>
			<div id="recHeader" class="pull-right">
				{{ $recMessage }} {{ $title }}
			</div>
	</div>

	<table class="table table-striped table-bordered bootstrap-datatable datatable">
		<th width='5%'>Active</th>
		<th width='5%' style='text-align: center'>ID</th>
		<th width='20%'>User</th>
		<th width='30%'>E-Mail</th>
		<th width='15%'>Category</th>
		<th width='15%'>Updated</th>
		<th align='middle'style='text-align: center'>- Actions -</th>


		@foreach ( $users as $user )

			<tr>
				<td align='center'>{{ $user->active ? Form::checkbox('checkbox','1',true,array('disabled' => 'true')) : Form::checkbox('checkbox','1',false, array('disabled' => 'true')) }}</td>
				<td style='text-align: center'>{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
				<td>{{ ucwords($user->username) }}</td>
				<td>{{ Helpers::mailto(strtolower($user->email)) }}</td>
				<td>{{ ucwords($user->category) }}</td>

				<!-- date("m-d-Y", strtotime($user->updated_at)) -->

				<td>{{ ExpressiveDate::make($user->updated_at)->getRelativeDate() }}</td>
				<td style="text-align: center;">
					<a href="/users/{{$user->id}}?page={{ Input::get('page') }}" title="Edit Record">{{ Helpers::image('img/icon_edit_16x16.gif') }}</a> &nbsp;&nbsp;
					<a onclick="return confirm('Are you sure you wish to delete this record?');" href="/users/{{$user->id}}/delete?page={{ Input::get('page') }}" title="Delete Record">{{ Helpers::image('img/icon_trash_16x16.gif') }}</a>
				</td>

			</tr>
		@endforeach
	</table>

		<?= $users->links(); ?>

@stop

@section('validation')

	@if($errors->has())
		<?php
			$errMsg = "Please correct the following errors:</br>";
			$errMsg.= $errors->first('username') ? "- ".str_replace('username','User Name',$errors->first('username'))."</br>" : "";
			$errMsg.= $errors->first('password') ? "- ".str_replace('password','Password' ,$errors->first('password'))."</br>" : "";
			$errMsg.= $errors->first('category') ? "- ".str_replace('category','Category' ,$errors->first('category'))."</br>" : "";
			$errMsg.= $errors->first('email') ? "- ".str_replace('email','EMail', $errors->first('email'))."</br>" : "";
		?>
		<p id="flashMsg" class="error"> {{ HTML::image('img/s_error.png' ) }} {{ $errMsg }} <span id="msg_close"><a href='#'> {{ HTML::image('img/Alarm_Dismiss.tiff') }} </a></span></p>
	@endif
	@if(Session::has('message'))
		@if(Session::has('msg_type'))
			<p id="flashMsg" class={{ Session::get('msg_type') }}>{{ HTML::image('img/s_success.png' ) }} {{ Session::get('message') }} <span id="msg_close"><a href='#'> {{ HTML::image('img/close.gif' ) }} </a></span> </p>
		@else
			<p id="flashMsg" class="note"> {{ HTML::image('img/close.gif' ) }} {{ Session::get('message') }} <span id="msg_close"><a href='#'> {{ HTML::image('img/s_success.png' ) }} </a></span> </p>
		@endif
	@endif

@stop
