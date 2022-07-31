@switch(Route::current()->getName())
    @case('index.parse.category')
        @include('parse.data.partials.category')
        @break

    @case('index.parse.manufacturer')
        @include('parse.data.partials.manufacturer')
        @break

    @case('index.parse.product')
        @include('parse.data.partials.product')
        @break

    @case('index.parse.subcategory')
        @include('parse.data.partials.subcategory')
        @break

    @default
        @include('parse.index')
@endswitch
