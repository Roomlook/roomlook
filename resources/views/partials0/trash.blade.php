<div class="tool hidden-xs tool--right">
                                <div class="tip"></div>
                                 <div class="tool-content row">
                                    <div class="col-md-5">
                                        <img src="/{{-- $tag->product->imagePath() --}}" alt="" class="img-responsive center">
                                    </div>
                                    <div class="col-md-6 padding-left-0">
                                          <h5>{{-- $tag->product->name --}}</h5>
                                        
                                         <a href="#" tabIndex="-1" style="color: #000; text-decoration: underline;" class="save-btn @if($tag->product->pictures()->first()->isSaved()) saved @endif" data-save-text="{{ trans('frontend.common.saved') }}" data-unsave-text="{{ trans('frontend.common.save') }}" data-model-id="{{ $tag->product->pictures()->first()->id }}" data-model-name="ProductPicture">
                                            @if($tag->product->pictures()->first()->isSaved())
                                             {{   trans('frontend.common.saved') }}
                                            @else
                                              {{  trans('frontend.common.save') }}
                                            @endif
                                        </a>
                                        <br><br>
                                        <a href="/{{-- $tag->product->imagePath() --}}" tabIndex="-1" data-product-id="{{-- $tag->product->id --}}" class="popup-product-open green-link2">{{-- trans('frontend.common.more') --}}</a>
                                    </div>
                                </div>
                                
                              </div>