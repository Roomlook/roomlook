        <header class="mobile">
            <div class="container-fluid">
                <div class="row">
                <div class="col-sm-2 col-md-2 col-xs-3 logo-holder">
                    <a href="/">
                        <img src="/images/mb-logo.jpg" alt="" class="logo"> 
                    </a>
                </div>
                <div class="col-sm-8 col-md-8 col-xs-4"> 
                </div> 
                <div class="col-sm-8 col-md-8 col-xs-5"> 
					<div class="mb-settings">
						<div><div class="mb-search"></div></div>
						<div><div class="mb-profil"><a href="/auth/login"></a></div></div>
						<div><div class="mb-language">{{ LaravelLocalization::getCurrentLocale() }}</div></div>
						<div><div class="mb-location"> 
  <input id="hamburger2" class="hamburger is-closed" type="checkbox">
  <label class="hamburger is-closed" for="hamburger2" style="left:0;margin-left:0px;">
						
						<ul class="dropdown-menu" style="margin-left: -110px; display: none;" aria-labelledby="dropdownMenu1">

                            <?php $i = 0;
                            $n =  App\Models\Country::all()->count() - 1;?>
                            @foreach(App\Models\Country::all() as $country) 
                                @if ($country->cities)
                                @foreach($country->cities as $city)
                                <li>
                                    <a href="/changecity/{{ $city->id }}" style="{{ ( null !== session('city_id')  && session('city_id') == $city->id ) ? 'font-weight: bold' : '' }}"  data-city-id="{{ $city->id }}">{{ $city->name }}</a>
                                </li>
                                @endforeach
                                @endif
                                @if ($i < $n)
                                <li role="separator" class="divider"></li>
                                @endif
                            <? $i++; ?> 
                            @endforeach
							
                                </ul>
		</label>
						
						</div></div>
						<div><div class="mb-menu">
						
						<content class="mob-view"> 
  <input id="hamburger" class="hamburger is-closed" type="checkbox">
  <label class="hamburger is-closed" for="hamburger" style="left:0;margin-left:0px;">
    <i style="left:20%;"></i>
    <text style="display:none;">
      <close>закрыть</close>
      <open>меню</open>
    </text>
  </label>
  <section class="drawer-list" style="width:100%;">
        <ul>
        <li><a data-id="1" href="https://roomlook.com/ru/projects">Проекты</a></li>
		<li> <a data-id="1" href="https://roomlook.com/ru/room">Комнаты</a></li>
		<li><a data-id="1" href="https://roomlook.com/ru/articles">Статьи</a></li>
		<li><a data-id="1" href="https://roomlook.com/ru/catalog">Каталог</a></li>
		<li><a data-id="1" href="https://roomlook.com/ru/author?city_id=16">Дизайнеры</a></li>
		<li><a data-id="1" href="https://roomlook.com/ru/stores">Магазины</a></li>
		</ul>
      </section>
</content>
						
						</div></div>
					</div>
                </div> 
				</div>
			</div>
		</header>