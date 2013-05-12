@extends ('layouts._default')

@section('content')

	<div id="toolbar">
		<a class="btn btn-small btn-info" href="/contacts/create?page={{ Input::get('page') }}">
			<i class="icon-user icon-white"></i>&nbsp;&nbsp;New {{ Str::singular($title) }}</a>
			<div id="recHeader" class="pull-right">
				{{ $recMessage }} {{ $title }}
			</div>
	</div>

	<table class="table table-striped table-bordered bootstrap-datatable datatable">
			<th>Active</th>
			<th>Contact Name</th>
			<th>Company</th>
			<th>E Mail</th>
			<th>Phone</th>
			<th>Status</th>
			<th>Updated</th>
			<th style="text-align: center;"> - Actions - </th>

		<tbody>
			@foreach ($contacts as $contact)
				<tr>
					@if ($contact->active)
						<td> <span class="label label-success">Active</span> </td>
					@else
						<td> <span class="label">Inactive</span> </td>
					@endif
					<td>{{ ucwords($contact->lname) }}, {{ ucwords($contact->fname) }}</td>
					<td> {{ is_null($contact->company) ? "" : $contact->company->companyName }} </td>
					<td>{{ Helpers::mailto(strtolower($contact->email)) }}</td>
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
					<td style="text-align: center">

						<a href="/contacts/{{$contact->id}}/edit?page={{ Input::get('page') }}"
						   title="Edit Record">{{ Helpers::image('img/icon_edit_16x16.gif') }}
						</a> &nbsp;&nbsp;

						<a onclick="return confirm('Are you sure you wish to delete this record?');"
						   data-method="delete" href="/contacts/{{$contact->id}}?page={{Input::get('page') }}"
						   title="Delete Record">{{ Helpers::image('img/icon_trash_16x16.gif') }}
						</a>

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $contacts->links(); }}

@stop