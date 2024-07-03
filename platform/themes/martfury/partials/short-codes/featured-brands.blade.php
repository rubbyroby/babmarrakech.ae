<div class="ps-product-list mb-60" style="margin:0px !important;">
    <div class="ps-container">
        <div class="ps-section__header">
            @if(__("I'm shopping for...") == "I'm shopping for...")
                <h3>Our Partners</h3>
            @else
                <h3>شركاؤنا</h3>
            @endif
        </div>
    </div>
</div>


<div class="ps-container my-3"> <!-- Added ps-container class -->
    <div class="row">
        <div class="col-12">
                <div class="partner-container py-3 text-center"> <!-- Added text-center class -->
                    <section class="client">
                    	<div class="container">
                    		<div class="row">
                    			<div class="carousel-client">
                    				
                    				@foreach($brands as $brand)
                                        @if($brand->logo && $brand->logo !== "NULL")
                                            <div class="slide"><a href="/products?brands%5B%5D={{$brand->id}}"><img src="{{ RvMedia::getImageUrl($brand->logo, null, false, RvMedia::getDefaultImage()) }}" alt="{{ $brand->name }}"></a></div>
                                        @endif
                                    @endforeach
                        

                    			</div>
                    		</div>
                    	</div>
                    </section>
                </div>
        </div>
    </div>
</div>