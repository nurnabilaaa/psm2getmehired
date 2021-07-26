@extends("main")

@section("content")
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-value-lg">{{ $totalCV->total }}</div>
                    <div>Total CV</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-value-lg">{{ $totalCompleted->total }}</div>
                    <div>Total Completed</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-value-lg">{{ $totalOnProgress->total }}</div>
                    <div>Total On Progress</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-value-lg">{{ $totalNotPickup->total }}</div>
                    <div>Total Not Pickup</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-value-lg">{{ $totalCustomer->total }}</div>
                    <div>Total Customer</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-value-lg">{{ $totalConsultant->total }}</div>
                    <div>Total Consultant</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-value-lg">RM{{ number_format($totalIncome->total, 2) }}</div>
                    <div>Total Income</div>
                </div>
            </div>
        </div>
    </div>
@stop
