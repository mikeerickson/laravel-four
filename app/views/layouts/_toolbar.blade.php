<div id="toolbar">
		<div id="queryForm">
			{{ Form::open(
				[
					'id'			=> 'queryForm',
					'method'        => 'get',
					'route'         => [strtolower($title).'.index'],
					'class'         => 'form-inline'
				])
			}}
<!-- 				{{ Session::get('queryParams') }}
				{{ 'f:'.$queryField  }} {{ 'd:'.$queryDelim }} {{'v:'.$queryValue}}
 -->				<!-- Toolbar Button: New -->
				<a class="btn btn-small btn-info" style="width: 60px;" href="/{{strtolower($title)}}/create?page={{ Input::get('page') }}">
				<i class="icon-user icon-white"></i>&nbsp;&nbsp;New</a>

				<!-- Toolbar Button: All -->
				<a class="btn btn-small btn-info" style="width: 60px;" href="{{strtolower($title)}}">
				<i class="icon-list icon-white"></i>&nbsp;&nbsp;All</a>

				<!-- Toolbar Button: Query -->
				<a class="btn btn-small btn-info" style="width: 90px;" id="toolbarQuery" href="#">
				<i class="icon-search icon-white"></i>&nbsp;&nbsp;<span id="queryText">Show Query</span></a>

				<!-- Toolbar Advanced Find Interface -->
				<span style="margin-right: 5px;">&nbsp;</span>
				<span id="formAdvancedQuery" style="display: none;">
					{{ Form::label('queryField','Field:')}}
					{{ Form::select('queryField', $fieldList, $queryField,
						[
							'style' => 'width: 120px;',
						])
					}}
					<span style="margin-right: 5px;"></span>
					{{ Form::select('queryDelim', $delimList, $queryDelim,
						[
							'style' => 'width: 120px;'
						])
					}}

					<span style="margin-right: 5px;"></span>
					{{ Form::label('queryValue','Value:')}}
					{{ Form::input('text','queryValue',$queryValue) }}
					{{ Form::submit('Find',['class' => 'btn-mini btn','style' => 'width: 50px;','id' => 'queryFindBtn']) }}
					<span style="margin-left: 15px; margin-right: 15px; border-right: 1px solid #ccc;"></span>
				</span>

				<!-- Toolbar Button: Filter -->
				{{ Form::label('queryFilter','Filter:')}}
				<input type="text" id="queryFilter">
				<a id="queryFilterClear" href="#"><img src="/img/close.gif"></a>

			{{ Form::close() }}
		</div>
		<p>&nbsp;</p>

		<div id="recHeader" class="pull-right">
			{{ $recMessage }} {{ $title }}
		</div>
</div>
