@extends ('layouts._default')

@section('content')

	@include ('layouts._toolbar')

	<table id="mainList" class="table table-striped table-bordered bootstrap-datatable datatable">
 			<th width="5%" style="text-align: center;">No</th>
			<th>Name</th>
			<th>Position</th>
			<th width="10%" style="text-align: center;">Bat/Throw</th>
			<th style="text-align: center;">Class</th>
			<th width="10%" style="text-align: center;"></th>

		<tbody>
			@foreach ($players as $player)

			<!-- conditionally build <tr> tag based on current player name -->
			{{ ($player->lname == 'erickson') ? '<tr class="special">' : '<tr>' }}

				<td style="text-align: center;">{{ $player->number }} </td>
				<td>{{ ucwords($player->lname) }}, {{ ucwords($player->fname) }}</td>
				<td>{{ ucwords($player->position) }} </td>
				<td width="10%" style="text-align: center;">{{ substr(ucwords($player->bats),0,1)}}/{{ substr(ucwords($player->throws),0,1) }} </td>
				<td style="text-align: center;">{{ $player->class }} </td>
				<td width="10%" style="text-align: center">

					<a class="action" href="/players/{{$player->id}}/edit?page={{ Input::get('page') }}"
					   title="Edit Record">{{ Helpers::image('img/icon_edit_16x16.gif') }}
					</a> &nbsp;&nbsp;

					<a class="action" data-confirm="Are you sure?" data-method="delete" href="/players/{{$player->id}}?page={{Input::get('page') }}"
					   title="Delete Record">{{ Helpers::image('img/icon_trash_16x16.gif') }}
					</a>

				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	{{ $players->links(); }}

@stop