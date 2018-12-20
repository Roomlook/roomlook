<?php

$leftMenu = Menu::instance('admin-menu');


$leftMenu->dropdown('Проекты', function ($sub) {
        $sub->route('admin.projects.index', 'Все проекты', [], 1);
        $sub->route('admin.projectrelation.index', 'Связи проектов', [], 1);
        $sub->divider(3);
    }, 1, ['icon' => 'fa fa-folder']);

$leftMenu->dropdown('Комнаты', function ($sub) {
        $sub->route('admin.rooms.index', 'Все комнаты', [], 1);
        $sub->route('admin.roompictures.index', 'Фотографии', [], 2);
        $sub->route('admin.roompicturetags.index', 'Теги', [], 2);
        $sub->route('admin.roomtypes.index', 'Типы комнат', [], 2);
        $sub->route('admin.styles.index', 'Стили комнат', [], 2);
        $sub->divider(3);
    }, 2, ['icon' => 'fa fa-home']);

$leftMenu->dropdown('Каталог', function ($sub) {
        $sub->route('admin.pcategories.index', 'Категории', [], 1);
        $sub->route('admin.products.index', 'Все товары', [], 1);
        $sub->route('admin.productrelationship.index', 'Связь', [], 1);
        $sub->route('admin.manufacturers.index', 'Производители', [], 2);
        $sub->route('admin.stores.index', 'Магазины', [], 2);
        $sub->divider(3);
    }, 3, ['icon' => 'fa fa-shopping-cart']);
$leftMenu->dropdown('Авторы', function ($sub) {
        $sub->route('admin.authors.index', 'Дизайнеры', [], 1);
        $sub->route('admin.authors.photograph', 'Фотографы', [], 1);
        $sub->route('admin.cities.index','Города');
        $sub->route('admin.countries.index','Страна');
        $sub->divider(3);
    }, 4, ['icon' => 'fa fa-shopping-cart']);

$leftMenu->url('/translations', 'Перевод',  5, ['icon' => 'fa fa-cog']);
/**
 * @see https://github.com/pingpabs/menus
 * ong-l
 * @example adding additional menu.
 *
 * $leftMenu->url('your-url', 'The Title');
 * 
 * $leftMenu->route('your-route', 'The Title');
 */