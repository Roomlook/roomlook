<ul class="nav nav-tabs">
    <ul class="nav nav-pills nav-justified">
        <li class="{{ Request::is('home') ? 'active' : '' }}">
            <a href="{{ url('/home') }}">Домой</a>
        </li>
        <li class="{{ Request::is('home/projects') ? 'active' : '' }}">
            <a href="{{ url('/home/projects') }}">Проекты</a>
        </li>
        <li class="{{ Request::is('home/favours') ? 'active' : '' }}">
            <a href="{{ url('/home/favours') }}">Закладки</a>
        </li>
        <li class="{{ Request::is('home/saves') ? 'active' : '' }}">
            <a href="{{ url('/home/saves') }}">Сохраненные</a>
        </li>
        <li role="presentation" class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> Настройки <span class="caret"></span> </a>
            <ul class="dropdown-menu">
                <li><a href="/home/settings">Персональные данные</a></li>
                <li><a href="/home/change-password">Сменить пароль</a></li>
                @if(Auth::user()->is('author'))
                    <li><a href="/home/authors-settings">Изменить данные автора</a></li>
                @endif
            </ul>
        </li>

    </ul>
</ul>