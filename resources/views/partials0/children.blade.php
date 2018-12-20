<ul>
  @foreach($sParent->children as $sChild)
  <li @if ($current->getParents()->get()->contains($sChild->id)) class="active" @endif>
  	<a href="/{{ LaravelLocalization::getCurrentLocale() }}/{{ $url }}?category_id={{ $sChild->id }}"   >{{ $sChild->name }}</a>
	{!! $sChild->getChildrenHtml($current) !!}
  </li>
  @endforeach
</ul>