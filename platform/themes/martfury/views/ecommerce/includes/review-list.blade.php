@foreach($reviews as $review)
    <div class="block--review">
        <div class="block__header">
            <div class="block__image"><img src="{{ $review->user->avatar_url }}" alt="{{ $review->user->name }}" width="60" /></div>
            <div class="block__info">
                <div class="rating">
                    <div class="product_rate" style="width: {{ $review->star * 20 }}%"></div>
                </div>
                <div class="my-2">
                    <span class="d-block lh-1">
                        <strong>{{ $review->user->name }}</strong>
                        @if ($review->order_created_at)
                            <span class="ml-2">{{ __('✅ Purchased :time', ['time' => $review->order_created_at->diffForHumans()]) }}</span>
                        @endif
                    </span>
                    <small class="text-secondary lh-1">{{ $review->created_at->diffForHumans() }}</small>
                </div>

                <div class="block__content">
                    <p>{{ $review->comment }}</p>
                </div>
                @if($review->images && count($review->images))
                    <div class="block__images">
                        @foreach($review->images as $image)
                            <a href="{{ RvMedia::getImageUrl($image) }}">
                                <img src="{{ RvMedia::getImageUrl($image, 'thumb') }}" alt="{{ RvMedia::getImageUrl($image, 'thumb') }}" class="img-responsive rounded h-100">
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach

<div class="ps-pagination">
    {{ $reviews->links() }}
</div>
