@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <h1>Отчеты</h1>
        </div>

        <div class="col-12">
            <ul class="list-group">
                @foreach ($reports as $report)
                    <li class="list-group-item">
                        <span>С {{$report->report_start_date}} - </span>
                        <span>До {{$report->report_end_date}}</span>
                        <span>{{$report->plane_hours}}</span>
                        <span>{{$report->fact_hours}}</span>
                        <span>{{$report->week_hours}}</span>
                        <span>{{$report->effective_hours}}</span>
                        <a href="/reports/{{$report->id}}/edit">Редактировать</a>
                    </li>
                @endforeach
            </ul>
            <a href="{{route('reports.create')}}" class="btn btn-success mt-5">Добавить</a>
        </div>
    </div>
@endsection