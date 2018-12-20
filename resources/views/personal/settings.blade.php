@extends('layouts.master')
@section('title','Изменить личные данные')
@section('content')
    <section id="main">
        <div class="container">
            <div class="col-md-offset-0 col-xs-offset-1">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Персональные данные</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Сменить пароль</a></li>
                    @if($user->hasRole('admin'))
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Автор</a></li>
                    @endif
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="col-md-6">
                            <form class="form-horizontal">
                                Изменить личные данные
                                <div class="form-group">
                                    <label for="">Имя</label>
                                    <input type="text" name="name" value="{{$user->name}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="{{$user->email}}"/>
                                </div>
                            </form>
                        </div>
                        <a href="/author/request/{{$user->id}}" class="pull-right btn btn-large btn-success">Подать заявку на автора</a>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <div class="col-md-6">
                            <form class="form-horizontal">
                                Cменить пароль
                                <div class="form-group">
                                    <label for="">Текущий пароль</label>
                                    <input type="text" name="password"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Новый пароль</label>
                                    <input type="text" name="email"/>
                                </div>
                                <div class="form-group">
                                    <label for="">Потверждение пароля</label>
                                    <input type="text" name="email"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="messages">

                    </div>
                    <div role="tabpanel" class="tab-pane" id="settings">

                    </div>
                </div>

            </div>
        </div>
    </section>
@stop