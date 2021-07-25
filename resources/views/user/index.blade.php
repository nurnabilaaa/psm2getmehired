@extends("main")
@section("content")
    <div class="card">
        <div class="card-header">
            <div class="mt-1 float-left">
                <strong>Senarai Pengguna Semasa</strong>
            </div>
            <div class="float-right" style="display: flex;flex-direction: row;">
                <button class="btn btn-primary btn-sm grid-btn-refresh" type="button" style="margin-right: 4px;" data-for="users">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-reload') }}"></use>
                    </svg>
                </button>
                <div data-dx="tooltip" class="d-none">Reset Senarai</div>
                <button class="btn btn-primary btn-sm grid-btn-excel" type="button" style="margin-right: 4px;" data-for="users">
                    <svg class="c-icon">
                        <use xlink:href="{{ asset('icons/free.svg#cil-cloud-download') }}"></use>
                    </svg>
                </button>
                <div data-dx="tooltip" class="d-none">Muat Turun Excel</div>
            </div>
        </div>
        <div class="card-body">
            <div id="grid" data-for="users"></div>
        </div>
    </div>
@stop
