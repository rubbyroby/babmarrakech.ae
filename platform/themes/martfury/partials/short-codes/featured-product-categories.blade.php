@php
    $categoriesCount = count($categories);
@endphp

<div class="ps-top-categories mt-40 mb-40">
    <div class="ps-container mt-5">
        <div class="ps-section__header" style="background-color:#fff !important;">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <h3>{!! BaseHelper::clean($title) !!}</h3>
                    </div>
                  
                </div>
            </div>
            </div>

<div class="ps-container categories-contenaier" style="text-align: -webkit-center;">
    <div class="row g-3 w-75 categories-header-list" style="place-content: center;">
        @foreach($categories->take(5) as $category)
            <div class="col-md-3 col-6 categories-list">
                <div class="custom-image-grid-container custom-image-grid-cover">
                    <a href="{{ $category->url }}"> {{-- Ensure $category->url is the correct URL --}}
                        @if(__("I'm shopping for...") == "I'm shopping for...")
                            <img src="{{ RvMedia::getImageUrl($category->image) }}" alt="{{ $category->name }}">
                        @else
                        @php
                            $url = RvMedia::getImageUrl($category->image);
    
                            // Extract the path and filename from the URL
                            $pathInfo = pathinfo($url);
    
                            // Append '-ar' to the filename
                            $newFilename = $pathInfo['filename'] . '-ar';
    
                            // Build the new URL with the modified filename
                            $newUrl = $pathInfo['dirname'] . '/' . $newFilename . '.' . $pathInfo['extension'];
    
                        @endphp
                            <img src="{{ RvMedia::getImageUrl($newUrl) }}" alt="{{ $category->name }}">
                        @endif
                    </a>
                </div>
            </div>
        @endforeach

        @if($categoriesCount > 5)
            <div class="col-md-3 col-6 categories-list">
                <div class="custom-image-grid-container custom-image-grid-cover">
                    <a href="{{URL::to('/products')}}"> {{-- Replace with the actual route to show more categories --}}
                        <img src="{{URL::to('/storage/more.png')}}" alt="More Categories">
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

    </div>
</div>
