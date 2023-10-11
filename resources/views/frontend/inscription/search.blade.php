<div class="toolbox">
    <div class="toolbox-left">
        <div class="toolbox-info">
            <form action="{{ url('inscriptions-classes/'.$idcycle) }}" method="GET">
                <div class="toolbox-sort">

                    <label for="sortby">Buscar Categoría:</label>

                    <div class="select-custom">
                        <select class="form-control m-2" name="fcategory">
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
                    <button type="submit" class="read-more">{{ __('Search') }}</button>
                <div class="toolbox-layout">

                </div><!-- End .toolbox-layout -->
            </form>
        </div><!-- End .toolbox-info -->
    </div><!-- End .toolbox-left -->
    <div class="toolbox-right">

    </div><!-- End .toolbox-right -->
</div><!-- End .toolbox -->
