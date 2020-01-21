@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <h1>Отчеты</h1>
        </div>

        @if (session()->has('status'))
            <div class="col-12 mt-3 status status--success">
                {{ session('status') }}
            </div>
        @endif

        <div class="col-12 mt-4">
            <div class="table-responsive-sm">
                <table class="table table-dark">
                    <thead>
                    <tr>
                        <td>С</td>
                        <td>По</td>
                        <td>Плановое рабочее время</td>
                        <td>Фактическое рабочее время</td>
                        <td>Рабочие часы</td>
                        <td>Эффективные рабочие часы</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr class="bg-light text-dark">
                            <td>{{$report->report_start_date}}</td>
                            <td>{{$report->report_end_date}}</td>
                            <td>{{$report->plane_hours}}</td>
                            <td>{{$report->fact_hours}}</td>
                            <td>{{$report->week_hours}}</td>
                            <td>{{$report->effective_hours}}</td>
                            <td>
                                <a href="/my-reports/{{$report->id}}/edit" class="text-dark">Редактировать</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection