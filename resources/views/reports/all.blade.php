@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <h1>Отчеты</h1>
        </div>

        <div class="col-12">
            {!! Form::open(['url' => route('reports.all'), 'class'=>'form', 'method' => 'get']) !!}
            <div class="form-group">
                {{ Form::label('role', 'Пользователь', ['class' => 'col-md-3 control-label p-0']) }}
                <div class="col-md-4 p-0">
                    <select name="user" id="role" class="form-control" required>
                        <option value="all" @if(request()->user == 'all') selected @endif>Все</option>
                        @foreach ($onlyUsers as $user)
                            <option value="{{$user->id}}" @if(request()->user == $user->id) selected @endif>{{$user->name}} {{$user->lastname}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-9 p-0">
                    {{ Form::submit('Выбрать', ['class' => 'btn btn-success']) }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

        <div class="col-12">
            <div class="table-responsive-sm">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <td>Имя</td>
                            <td>С</td>
                            <td>По</td>
                            <td>Плановое рабочее время</td>
                            <td>Фактическое рабочее время</td>
                            <td>Рабочие часы</td>
                            <td>Эффективные рабочие часы</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td>{{$report->author}}</td>
                                <td>{{$report->report_start_date}}</td>
                                <td>{{$report->report_end_date}}</td>
                                <td>{{$report->plane_hours}}</td>
                                <td>{{$report->fact_hours}}</td>
                                @foreach ($onlyUsers as $user)
                                    @if($report->user_id === $user->id)
                                        @if($report->week_hours < $user->week_hours)
                                            <td class="text-danger">{{$report->week_hours}}</td>
                                        @else
                                            <td class="text-danger">{{$report->week_hours}}</td>
                                        @endif
                                    @endif
                                @endforeach
                                <td>{{$report->effective_hours}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection