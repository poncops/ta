<div class="shop-sidebar mr-50">
    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">KATEGORI</h3>
            @foreach($categories_menu as $category_menu)
            <div class="py-2 px-4 bg-dark text-white mb-3">
                <strong class="small text-uppercase font-weight-bold">
                    <a class="text-decoration-none text-white" href="{{ route('shop.index', $category_menu->slug) }}">
                        {{ $category_menu->name }}
                    </a>
                </strong>
            </div>
            <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                    @foreach($category_menu->children as $child)
                    <li class="mb-2">
                        <a class="reset-anchor text-decoration-none px-3" style="color: #000;" href="{{ route('shop.index', $child->slug) }}">
                            {{ $child->name }}
                        </a>
                    </li>
                    @endforeach
            </ul>
            @endforeach 
    </div>
    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">TAG</h3>
        <hr style="margin-top: 0; margin-bottom: 10px; border: solid 1px;">
        <div class="price_filter">
          
            <div class="price_slider_amount">
                <div class="sidebar-categories">
                    <ul>
                        @foreach($tags_menu as $tag_menu)
                            <span style="background: #ebebeb none repeat scroll 0 0; color: #333;
                            display: inline-block; font-size: 12px; line-height: 20px; margin:
                            5px 5px 0 0; padding: 5px 15px; text-transform: capitalize;">
                                <a href="{{ route('shop.tag', $tag_menu->slug) }}" class="text-decoration-none" style="color: #000;">
                                    {{ $tag_menu->name }}
                                    ({{ $tag_menu->products_count }})
                                </a>
                            </span>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">ULASAN TERBARU</h3>
        <hr style="margin-top: 0; margin-bottom: 10px; border: solid 1px;">
        <ul>
            @foreach($recent_reviews as $recent_review)
                <li>
                    <div class="post-wrapper d-flex">
                        <div class="mb-2">
                            @if($recent_review->user && $recent_review->user->foto)
                                <img style="width:45px;" src="{{ asset('storage/images/users/' . $recent_review->user->foto) }}" alt="" width="50">
                            @else
                                <img class="rounded-circle" style="width:45px; border:1px solid #dedede;" src="{{ asset('frontend/assets/img/user.png') }}" alt="{{ $recent_review->first_name }}">
                            @endif
                            <!-- <img src="https://ui-avatars.com/api/?name={{ $recent_review->user->name }}&background=0d8abc&color=fff" alt="{{ $recent_review->name }}"> -->
                        </div>
                        <div class="ml-3 p-0">
                            @if(isset($recent_review->product->slug))
                                <p>
                                    <span class="">{{ $recent_review->user->first_name ? $recent_review->user->first_name.' '.$recent_review->user->last_name : $recent_review->user->username }} </span>
                                    <small class="text-success"> review on :
                                        {{ $recent_review->product->name }}
                                    </small>
                                </p>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
