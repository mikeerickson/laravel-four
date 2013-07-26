@extends ('layouts._default')

@section('content')

	@include ('layouts._toolbar')

	<table class="table table-striped table-bordered bootstrap-datatable datatable">
			<th width="5%">Active</th>
			<th>Contact Name</th>
			<th>Company</th>
			<th width="25%">E Mail</th>
			<th>Phone</th>
			<th>Status</th>
			<th>Updated</th>
			<th width="10%" style="text-align: center;"></th>

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
					<td width="25%">{{ Helpers::mailto(strtolower($contact->email)) }}</td>
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

						<a class="action" href="/{{strtolower($title)}}/{{$contact->id}}/edit?page={{ Input::get('page') }}"
						   title="Edit Record"><img src="img/icon_edit_16x16.gif">
						</a>&nbsp;
						<a class="action" data-method="delete" data-confirm="Are you sure?" href="/{{strtolower($title)}}/{{$contact->id}}?page={{Input::get('page') }}" title="Delete Record"><img src="img/icon_trash_16x16.gif">
						</a>

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	{{ $contacts->links(); }}

@stop