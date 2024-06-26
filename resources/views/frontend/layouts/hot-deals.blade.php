<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($hot_deals as $hot_deal)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('/product/details/' . $hot_deal->id . '/' . $hot_deal->product_slug) }}"><img
                                        src="{{ asset('upload/product_images/thambnail/' . $hot_deal->product_thambnail) }}"
                                        alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('/product/details/' . $hot_deal->id . '/' . $hot_deal->product_slug) }}">{{ $hot_deal->product_name }}</a>
                                </h6>
                                @php
                                    $avarage = App\Models\Review::where([
                                        'product_id' => $hot_deal->id,
                                        'status' => 1,
                                    ])->avg('rating');
                                @endphp
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        @if ($avarage == 0)
                                        @elseif($avarage == 1 || $avarage < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif($avarage == 2 || $avarage < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif($avarage == 3 || $avarage < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif($avarage == 4 || $avarage < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @elseif($avarage == 5 || $avarage < 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                    </div>
                                </div>
                                @if ($hot_deal->discount_price == null)
                                    <span><small>$</small>{{ $hot_deal->selling_price }}</span>
                                @else
                                    <div class="product-price">
                                        <span><small>$</small>{{ $hot_deal->discount_price }}</span>
                                        <span class="old-price"><small>$</small>{{ $hot_deal->selling_price }}</span>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_offers as $special_offer)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a
                                    href="{{ url('/product/details/' . $special_offer->id . '/' . $special_offer->product_slug) }}"><img
                                        src="{{ asset('upload/product_images/thambnail/' . $special_offer->product_thambnail) }}"
                                        alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('/product/details/' . $special_offer->id . '/' . $special_offer->product_slug) }}">{{ $special_offer->product_name }}</a>
                                </h6>
                                @php
                                    $avarage = App\Models\Review::where([
                                        'product_id' => $special_offer->id,
                                        'status' => 1,
                                    ])->avg('rating');
                                @endphp
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        @if ($avarage == 0)
                                        @elseif($avarage == 1 || $avarage < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif($avarage == 2 || $avarage < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif($avarage == 3 || $avarage < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif($avarage == 4 || $avarage < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @elseif($avarage == 5 || $avarage < 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                    </div>
                                </div>
                                @if ($special_offer->discount_price == null)
                                    <span><small>$</small>{{ $special_offer->selling_price }}</span>
                                @else
                                    <div class="product-price">
                                        <span><small>$</small>{{ $special_offer->discount_price }}</span>
                                        <span
                                            class="old-price"><small>$</small>{{ $special_offer->selling_price }}</span>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">

                    @foreach ($recently_added as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('/product/details/' . $item->id . '/' . $item->product_slug) }}"><img
                                        src="{{ asset('upload/product_images/thambnail/' . $item->product_thambnail) }}"
                                        alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('/product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>
                                @php
                                    $avarage = App\Models\Review::where([
                                        'product_id' => $item->id,
                                        'status' => 1,
                                    ])->avg('rating');
                                @endphp
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        @if ($avarage == 0)
                                        @elseif($avarage == 1 || $avarage < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif($avarage == 2 || $avarage < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif($avarage == 3 || $avarage < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif($avarage == 4 || $avarage < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @elseif($avarage == 5 || $avarage < 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                    </div>
                                </div>
                                @if ($item->discount_price == null)
                                    <span><small>$</small>{{ $item->selling_price }}</span>
                                @else
                                    <div class="product-price">
                                        <span><small>$</small>{{ $item->discount_price }}</span>
                                        <span class="old-price"><small>$</small>{{ $item->selling_price }}</span>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_deals as $special_deal)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a
                                    href="{{ url('/product/details/' . $special_deal->id . '/' . $special_deal->product_slug) }}"><img
                                        src="{{ asset('upload/product_images/thambnail/' . $special_deal->product_thambnail) }}"
                                        alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('/product/details/' . $special_deal->id . '/' . $special_deal->product_slug) }}">{{ $special_deal->product_name }}</a>
                                </h6>
                                @php
                                    $avarage = App\Models\Review::where([
                                        'product_id' => $special_deal->id,
                                        'status' => 1,
                                    ])->avg('rating');
                                @endphp
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        @if ($avarage == 0)
                                        @elseif($avarage == 1 || $avarage < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif($avarage == 2 || $avarage < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif($avarage == 3 || $avarage < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif($avarage == 4 || $avarage < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @elseif($avarage == 5 || $avarage < 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                    </div>
                                </div>
                                @if ($special_deal->discount_price == null)
                                    <span><small>$</small>{{ $special_deal->selling_price }}</span>
                                @else
                                    <div class="product-price">
                                        <span><small>$</small>{{ $special_deal->discount_price }}</span>
                                        <span
                                            class="old-price"><small>$</small>{{ $special_deal->selling_price }}</span>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
