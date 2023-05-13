@extends($master)

@section('content')
    @include('laravelticket::shared.header')

    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                @include('laravelticket::shared.nav')
            </div>
        </div>
        @if(View::hasSection('laravelticket_content'))
            <div class="card">
                <h5 class="card-header d-flex justify-content-between align-items-baseline flex-wrap">
                    @if(View::hasSection('page_title'))
                        <span>@yield('page_title')</span>
                    @else
                        <span>@yield('page')</span>
                    @endif

                    @yield('laravelticket_header')
                </h5>
                <div class="card-body @yield('laravelticket_content_parent_class')">
                    @yield('laravelticket_content')
                </div>
            </div>
        @endif
        @yield('laravelticket_extra_content')
    </div>
@stop
