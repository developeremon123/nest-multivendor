<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $skip_category_2->category_name }} Category </h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($skip_product_2 as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a
                                            href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            <img class="default-img" style="height: 200px"
                                                src="{{ asset('upload/product_images/thambnail/' . $product->product_thambnail) }}"
                                                alt="Product Thambnail" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;
                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if ($product->discount_price == null)
                                            <span class="new">New</span>
                                        @else
                                            <span class="hot">{{ round($discount) }}%</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">{{ $product->category->category_name }}</a>
                                    </div>
                                    <h2><a
                                            href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                    </h2>
                                    @php
                                        $review = App\Models\Review::where([
                                            'product_id' => $product->id,
                                            'status' => 1,
                                        ])
                                            ->latest()
                                            ->get();
                                        $avarage = App\Models\Review::where([
                                            'product_id' => $product->id,
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
                                        <span class="font-small ml-5 text-muted"> ({{ count($review) }})</span>
                                    </div>
                                    <div>
                                        @if ($product->vendor_id == null || $product->vendor == null)
                                            <span class="font-small text-muted">By Owner</span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="javascript:void(0)">{{ $product->vendor->name }}</a></span>
                                        @endif
                                    </div>
                                    <div class="product-card-bottom">
                                        @if ($product->discount_price == null)
                                            <span><small>$</small>{{ $product->selling_price }}</span>
                                        @else
                                            <div class="product-price">
                                                <span><small>$</small>{{ $product->discount_price }}</span>
                                                <span
                                                    class="old-price"><small>$</small>{{ $product->selling_price }}</span>
                                            </div>
                                        @endif

                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.html"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!--end product card-->
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
        <!--End tab-content-->
    </div>
</section>
