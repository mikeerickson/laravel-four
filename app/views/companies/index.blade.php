@extends ('layouts._default')

@section('content')

	@include ('layouts._toolbar')

	<table id="mainList" class="table table-striped table-bordered bootstrap-datatable datatable">
 			<th>Company</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zip</th>
			<th width="10%" style="text-align: center;"></th>

		<tbody>
		@foreach ($companies as $company)
		<tr>
			<td>{{ $company->companyName }} </td>
			<td>{{ $company->address }} </td>
			<td>{{ $company->city }} </td>
			<td>{{ $company->state }} </td>
			<td>{{ $company->zip }} </td>
			<td width="10%" style="text-align: center">

				<a class="action" href="/companies/{{$company->id}}/edit?page={{ Input::get('page') }}"
				   title="Edit Record">{{ Helpers::image('img/icon_edit_16x16.gif') }}
				</a> &nbsp;&nbsp;

				<a class="action" data-method="delete" data-confirm="Are you sure?" href="/companies/{{$company->id}}?page={{Input::get('page') }}"
				   title="Delete Record">{{ Helpers::image('img/icon_trash_16x16.gif') }}
				</a>

			</td>
		</tr>
		@endforeach
		</tbody>
	</table>

	{{ $companies->links(); }}

@stop