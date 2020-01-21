@if (isset($user))
    {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) }}
@else
    {!! Form::open(['url' => route('users.store'), 'class'=>'form', 'method' => 'post']) !!}
@endif


<div class="form-group {{ $errors->has('name') ?  'has-error' : ''}}">
    {{ Form::label('name', 'Имя', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('name', null, ['class'=>'form-control', 'required']) }}
        @if ($errors->has('name'))
            <span class="help-block">{{  $errors->first('name') }}</span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('lastname') ?  'has-error' : ''}}">
    {{ Form::label('lastname', 'Фамилия', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('lastname', null, ['class'=>'form-control', 'required']) }}
        @if ($errors->has('lastname'))
            <span class="help-block">{{  $errors->first('lastname') }}</span>
        @endif
    </div>
</div>

<div class="form-group {{ $errors->has('email') ?  'has-error' : ''}}">
    {{ Form::label('email', 'E-Mail', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('email', null, ['class'=>'form-control', 'required']) }}
        @if ($errors->has('email'))
            <span class="help-block">{{  $errors->first('email') }}</span>
        @endif
    </div>
</div>



@if ($formType == 'edit')
    <app-create-user
        current_role = "{{ $role }}"
        :roles_list  = "{{ json_encode($roles) }}"
        action_type  = 'edit'
        plane_hours  = "{{ $user->plane_hours }}"
        week_hours   = "{{ $user->week_hours }}"
        auth_user    = "{{ Auth::id() }}"
        user_id      = "{{ $user->id }}"
    ></app-create-user>
@else
    <app-create-user
        :roles_list ="{{ json_encode($roles) }}"
        action_type = 'create'
    ></app-create-user>
@endif


<div class="form-group">
    {{ Form::label('password', 'Пароль', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        @if ($formType == 'create')
            <input type="password" name="password" class="form-control" required>
        @else
            <input type="password" name="password" class="form-control">
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-9">
        @if ($formType == 'edit')
            {{ Form::submit('Сохранить', ['class' => 'btn btn-success btn-raised']) }}
        @else
            {{ Form::submit('Добавить', ['class' => 'btn btn-success btn-raised']) }}
        @endif
    </div>
</div>
{{ Form::close() }}



@if ($formType == 'edit')
    {!! Form::open(array('route' => ['users.destroy', 'id' => $user->id], 'method' => 'DELETE', 'class' => '')) !!}
        <div class="form-group">
            <div class="col-md-9">
        <button type="submit" class="btn btn-danger">Удалить</button>
            </div>
        </div>
    {!! Form::close() !!}
@endif
