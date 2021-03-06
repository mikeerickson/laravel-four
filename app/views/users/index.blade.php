@extends ('layouts._default')

@section('content')

	@include ('layouts._toolbar')

	<table id="mainList" class="table table-striped table-bordered bootstrap-datatable datatable">
		<th width="5%">&nbsp;</td>
		<th width='5%'>Status</th>
		<th width='20%'>User</th>
		<th width='25%'>E-Mail</th>
		<th width='10%'>Category</th>
		<th width='15%'>Updated</th>
		<th width='10%' style="text-align: center;">Connections</th>

		<th width='10%' align='middle'style='text-align: center'></th>


		@foreach ( $users as $user )

			<tr>
				<td>{{ Gravatar::get( null , false , $user->email ) }}</td>

 				@if ($user->active)
					<td> <span class="label label-success">Active</span> </td>
				@else
					<td> <span class="label">Inactive</span> </td>
				@endif

				<td>{{ ucwords($user->username) }}</td>
				<td>{{ Helpers::mailto(strtolower($user->email)) }}</td>
				<td>{{ ucwords($user->category) }}</td>

				<!-- date("m-d-Y", strtotime($user->updated_at)) -->

				<td>{{ ExpressiveDate::make($user->updated_at)->getRelativeDate() }}</td>
				<td style="text-align: center;">{{ $user->connections }}</td>
				<td width='10%' style="text-align: center;">
					<a class="action" href="/users/{{$user->id}}/edit?page={{ Input::get('page') }}" title="Edit Record">{{ Helpers::image('img/icon_edit_16x16.gif') }}</a> &nbsp;&nbsp;
					<a class="action" data-method="delete" data-confirm="Are you sure?" href="/{{strtolower($title)}}/{{$user->id}}?page={{Input::get('page') }}" title="Delete Record"><img src="img/icon_trash_16x16.gif">
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
