@extends ('layouts._default')

@section('content')

	<div id="toolbar">
			<div id="queryForm">
				{{ Form::open(
					[
						'id'			=> 'queryForm',
						'method'        => 'get',
						'route'         => ['contacts.index'],
						'class'         => 'form-inline'
					])
				}}
					<a class="btn btn-small btn-info" style="width: 100px;" href="/contacts/create?page={{ Input::get('page') }}">
					<i class="icon-user icon-white"></i>&nbsp;&nbsp;New {{ Str::singular($title) }}</a>

					<a class="btn btn-small btn-info" style="width: 100px;" href="/contacts">
					<i class="icon-list icon-white"></i>&nbsp;&nbsp;All {{ $title }}</a>

					<span style="margin-right: 25px;">&nbsp;</span>

					{{ Form::label('queryField','Field:')}}
					{{ Form::select('queryField', $fieldList, Input::get('queryField'),
						[
							'style' => 'width: 120px;'
						])
					}}
					{{ Form::select('queryDelim', $delimList, Input::get('queryDelim'),
						[
							'style' => 'width: 120px;'
						])
					}}
					<span style="margin-right: 5px;"></span>
					{{ Form::label('queryValue','Value:')}}
					{{ Form::input('text','queryValue',Input::get('queryValue')) }}
					{{ Form::submit('Find',['class' => 'btn-mini btn','style' => 'width: 50px;']) }}
					<span style="margin-left: 15px; margin-right: 15px; border-right: 1px solid #ccc;"></span>
					{{ Form::label('queryFilter','Filter:')}}
					<input type="text" id="queryFilter">

				{{ Form::close() }}
			</div>
			<p>&nbsp;</p>

			<div id="recHeader" class="pull-right">
				{{ $recMessage }} {{ $title }}
			</div>
	</div>
	<table class="table table-striped table-bordered bootstrap-datatable datatable">
			<th>Active</th>
			<th>Contact Name</th>
			<th>Company</th>
			<th width="15%">E Mail</th>
			<th>Phone</th>
			<th>Status</th>
			<th>Updated</th>
			<th width="10%" style="text-align: center;"> - Actions - </th>

		<tbody id="mainList">
			@foreach ($contacts as $contact)

				{{ (($contact->lname == 'Erickson') ? '<tr class="special">': '<tr>') }}
					@if ($contact->active)
						<td> <span class="label label-success">Active</span> </td>
					@else
						<td> <span class="label">Inactive</span> </td>
					@endif
					<td>{{ ucwords($contact->lname) }}, {{ ucwords($contact->fname) }}</td>
					<td>{{ is_null($contact->company) ? "" : $contact->company->companyName }} </td>
					<td width="15%">{{ Helpers::mailto(strtolower($contact->email)) }}</td>
					<td>{{ Helpers::formatPhone($contact->phone) }}</td>

					<?php

						$class = '';

						switch ($contact->status) {
							case 'active':
								$class = 'label-success';
								break;
							case 'inactive':
								$class = '';
								break;
							case 'pending':
								$class = 'label-warning';
								break;
							case 'banned':
								$class = 'label-important';
								break;
						}
					?>

					<td> <span class="label {{ $class }}">{{ ucwords($contact->status) }}</span> </td>
					<td>{{ ExpressiveDate::make($contact->updated_at)->getRelativeDate() }}</td>
					<td width="10%" style="text-align: center">

						<a href="/contacts/{{$contact->id}}/edit?page={{ Input::get('page') }}"
						   title="Edit Record"><img src="img/icon_edit_16x16.gif">
						</a>&nbsp;
						<a onclick="return confirm('Are you sure you wish to delete this record?');"
						   data-method="delete" href="/contacts/{{$contact->id}}?page={{Input::get('page') }}"
						   title="Delete Record"><img src="img/icon_trash_16x16.gif">
						</a>

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $contacts->links(); }}

@stop