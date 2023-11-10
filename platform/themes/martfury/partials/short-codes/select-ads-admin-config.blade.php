@for ($i = 1; $i <= $maxAds; $i++)
    <label class="control-label">{{ __('Ad :number', ['number' => $i]) }}</label>
    <div class="ui-select-wrapper form-group">
        <select name="ads_{{ $i }}" class="form-control ui-select">
            <option value="">{{ __('-- select --') }}</option>
            @foreach($ads as $ad)
                <option value="{{ $ad->key }}" @if ($ad->key == Arr::get($attributes, 'ads_' . $i)) selected @endif>{{ $ad->name }}</option>
            @endforeach
        </select>
        <svg class="svg-next-icon svg-next-icon-size-16">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 16l-4-4h8l-4 4zm0-12L6 8h8l-4-4z"></path></svg>
        </svg>
    </div>
@endfor
