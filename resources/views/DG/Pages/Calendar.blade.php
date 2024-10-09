@extends('DG.layouts.app')


@section('content')
<div id='wrap'>
    <p class="text-center" id="ledger" style="padding-top: 5px; font-size: large;">
        @foreach($event_type as $event_type)
        <i class="fa fa-circle" style="color:  {{ $event_type->event_type_color }}">
            {{ $event_type->event_type_name }}
        </i>
        @endforeach
    </p>
    <div id='calendar'>

    </div>
    <div style='clear:both'></div>
</div>
@endsection