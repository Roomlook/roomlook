@extends('layouts.master8')
@section('title','RoomLook')
@section('seo_keywords')
{{ $category ? $category->seo_keywords : '' }}
@stop
@section('seo_description', $category ? $category->seo_description : '')
@section('content') 
<style> 

aside {
    width: 200px;
    display: inline-block;
    float: left;
    margin-right: 13px;
    min-height: 10px;
    position: absolute;
    left: -200px;
    top: 0px;
}
aside > div {
    background: #fff;
    padding: 20px;
    width: 100%;
    max-width: 180px;
}
aside > div h2 {
    font-size: 23px;
    line-height: 28px;
    margin-bottom: 10px;
}
aside > div ul li {
    padding: 2px 0;
    margin: 3px 0;
}


    @media (max-width: 768px) {
        #catalog {
            width: 100% !important;
        }
    }
</style> 
<section id="main" class="catalog-wrapper {{ $category != '' ? '' : 'pcategory-wrapper' }}">
    <div class="container">
    <div class="row">
	
        <div class="breadcumbs" style="display:block;margin:15px;">
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}">{{ trans('frontend.common.home') }}</a> >
            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog">{{ trans('frontend.common.catalog') }}</a>
        </div>
		
		
		
					<div style="position:relative;">
					
					<aside>
                        <div class="sidebar"> 
		<h2>{{ trans('frontend.common.section') }}</h2>
		<ul>
		<?php /*
            @foreach(App\Models\Pcategory::parents() as $sParent)
                @if ( $category->getParents()->get()->contains($sParent->id) )
                <li class="active">
				@else
                <li class="">
				@endif
            	<a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?category_id={{ $sParent->id }}">{{ $sParent->name }}</a></li> 
            @endforeach 
		*/ ?>	
                        <li>
                <a href="/ru/projects">Все проекты</a>
            </li>
		</ul>
                          
                                 
								
                        </div>
                    </aside>
					 
        <div id="catalog">
                        <div class="catalog">
                            <div class="catalog-header ">

                                    <h2 class="text-left text-uppercase">{{ trans('frontend.common.catalog') }}</h2>
                                    <p>здесь собраны примеры проектов одих из лучших дизайнеров мира</p>
                            </div>
                            <div class="catalog-body list-group "  >  
                                        <div class="row">
                                        @foreach ($pcategories->chunk(3) as $pcategoriesArr)
                                            @foreach($pcategoriesArr as $pcategory)
                                                <div class="col-xs-12 {{ $pcategory->is_wide == 0 ? 'col-md-4' : 'col-md-6'  }} category-item">

                                                        <div class="category-holder">
                                                            <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?category_id={{ $pcategory->id }}"><div class="category-image" style="background-image: url(/images/pcategories/{{ $pcategory->image }});">

                                                            </div></a>
                                                            <div class="category-nav">
                                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?category_id={{ $pcategory->id }}" class="category-name">{{ $pcategory->name }}</a>
                                                                <br>
                                                                <div class="children-category"> 
                                                                    @foreach($pcategory->children as $child)
                                                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?category_id={{ $child->id }}">{{ $child->name }}</a>
                                                         
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="arrow-catalog">
                                                                <a href="/{{ LaravelLocalization::getCurrentLocale() }}/catalog?category_id={{ $pcategory->id }}">
                                                                    <div ></div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endforeach
                                        </div>
                                </div>

                            </div>
                            <div class="clear"></div>
                        </div>
                        </div>
    </div>
    </div>

</section>
@stop