<div class="product-card">
                            <div class="row">
                                <div class="col-xs-5">
                                    <a href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $product->id }}"><img src="/{{ $product->imagePath() }}" class="img-responsive"></a>
                                </div>
                                <div class="col-xs-7">
                                    <h3><a href="/{{ LaravelLocalization::getCurrentLocale() }}/product/{{ $product->id }}">{{ $product->name }}</a></h3>
                                     <p>
                                        <?php $i = 0; ?>
                                         @foreach ($product->stores as $store)
                                            {{ $store->name }}@if ($i + 1 != $product->stores()->count()), @endif
                                            <?$i++;?>
                                        @endforeach
                                     </p>
                                     <p>
                                         {{ $product->manufacturer ? $product->manufacturer->name : '' }}
                                     </p>
                                     {{-- <h2 class="text-right">
                                         {{ $product->price }} тг
                                     </h2> --}}
                                </div>
                            </div>
                        </div>