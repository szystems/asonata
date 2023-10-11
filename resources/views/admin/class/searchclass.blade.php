
<form action="{{ url('index_classes/'.$cycle->id) }}" method="GET">
    @csrf
    <div class="row">

        <div class="col-md-12 mb-0">
            <label for=""><strong>{{ __('Filtrar x Categoría') }}:</strong></label>

        </div>
        <div class="col-md-4 mb-3">
            <select class="form-select px-2" aria-label="Default select example" name="fcategory">
                <option value="">All</option>
                @if ($queryCategory != null)
                    @php
                        $categoryinfo = \App\Models\Category::find($queryCategory);
                    @endphp
                    <option selected value="{{ $categoryinfo->id }}">{{ $categoryinfo->name }}</option>
                @else
                    <option selected value="">{{ __('All') }}</option>
                @endif
                <option value="">{{ __('All') }}</option>
                @foreach ($categoriesFilter as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 mb-3" >
            <button type="submit" class="btn btn-info"><i class="material-icons">search</i> {{ __('Search') }}</button>
        </div>
    </div>
</form>
