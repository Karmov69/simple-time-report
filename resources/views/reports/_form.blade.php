{{ Form::model($report, ['route' => ['reports.update', $report->id], 'method' => 'put']) }}

<div class="form-group {{ $errors->has('plane_hours') ?  'has-error' : ''}}">
    {{ Form::label('plane_hours', 'Плановое рабочее время', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::number('plane_hours', null, ['class'=>'form-control', 'step'=>'any', 'readonly'=>'readonly']) }}
        @if ($errors->has('plane_hours'))
            <span class="status status--error">{{  $errors->first('plane_hours') }}</span>
        @endif
    </div>
</div>


<div class="form-group {{ $errors->has('fact_hours') ?  'has-error' : ''}}">
    {{ Form::label('fact_hours', 'Фактическое рабочее время', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::number('fact_hours', null, ['class'=>'form-control', 'step'=>'any', 'required']) }}
        @if ($errors->has('fact_hours'))
            <span class="status status--error">{{  $errors->first('fact_hours') }}</span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('week_hours') ?  'has-error' : ''}}">
    {{ Form::label('week_hours', 'Рабочие часы', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::number('week_hours', null, ['class'=>'form-control', 'step'=>'any', 'required']) }}
        @if ($errors->has('week_hours'))
            <span class="status status--error">{{  $errors->first('week_hours') }}</span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('effective_hours') ?  'has-error' : ''}}">
    {{ Form::label('effective_hours', 'Эффективные рабочие часы', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::number('effective_hours', null, ['class'=>'form-control', 'step'=>'any', 'required']) }}
        @if ($errors->has('effective_hours'))
            <span class="status status--error">{{  $errors->first('effective_hours') }}</span>
        @endif
    </div>
</div>

@if (session()->has('status'))
    <div class="form-group">
        <div class="col-md-9 status status--error">
            {{ session('status') }}
        </div>
    </div>
@endif


<div class="form-group">
    <div class="col-md-9">
        {{ Form::submit('Сохранить', ['class' => 'btn btn-success btn-raised']) }}
    </div>
</div>
{{ Form::close() }}
