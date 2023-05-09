<div class="item-container">
    <a href="/order/{{ $product_id }}">
        <div class="image">
            <img src="{{ $product_image }}" />
        </div>
    </a>
    <div class="description-container">

        <a href="/order/{{ $product_id }}">
            <h4>{{ $product_name }}</h4>
        </a>
        <h4>{{ $product_price }}</h4>
        @if ($is_owner)
        <h4>Listed by You!</h4>
        @else
        <h4>Listed by {{ $user_name }}</h4>
        @endif
        @if ($mode == 'manage')
        <h4>
            <a href="/edit/{{ $product_id }}"><button type="button" class="action-buttons encouraged">Edit</button></a>
            <a href="/edit/{{ $product_id }}"><button type="button"
                    class="action-buttons unfriendly">Delete</button></a>
            <a href="#">
                <!--this feature will hide the item from the listings -->
                @if ($product_visibility == 'hidden')
                <form method='POST' id='visibility_visible' action='/update/visibility/{{ $product_id }}'>
                    {{ csrf_field() }}
                    <input class="hidden" name="item_id" value="{{ $product_id }}" />
                    <input class="hidden" name="visibility" value="visible" />
                    <a href='#' onClick='document.getElementById("visibility_visible").submit();'><button type="button"
                            class="action-buttons encouraged">Show</button></a>
                </form>
                @else
                <form method='POST' id='visibility_hidden' action='/update/visibility/{{ $product_id }}'>
                    {{ csrf_field() }}
                    <input class="hidden" name="item_id" value="{{ $product_id }}" />
                    <input class="hidden" name="visibility" value="hidden" />
                    <button type="submit" class="action-buttons encouraged">Hide</button>
                </form>
                @endif
                <!--this feature will hide the item from the listings -->
            </a>
        </h4>
        @else

        @if ($is_owner)
        <h4>
            <a href="/edit/{{ $product_id }}"><button type="button" class="action-buttons encouraged">Edit</button></a>
        </h4>
        @else
        <h4>
            <a href="/order/{{ $product_id }}">
                <button type="button" class="action-buttons friendly">Order</button>
            </a>
        </h4>
        @endif

        @endif

    </div>
</div>