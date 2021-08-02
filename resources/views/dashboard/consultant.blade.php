@extends("main")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    List of Curriculum Vitae
                </div>
                <div class="card-body">
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home">Pickup CV</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#onworking" role="tab" aria-controls="home">On Working CV</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#finish" role="tab" aria-controls="home">Finish CV</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">Your CV</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <table class="table table-hover table-md">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%">#</th>
                                        <th scope="col" style="width: 10%">Date</th>
                                        <th scope="col" style="width: 22%">Customer Name</th>
                                        <th scope="col" style="width: 15%">Email</th>
                                        <th scope="col" style="width: 10%">Handphone No</th>
                                        <th scope="col" style="width: 10%">Package</th>
                                        <th scope="col" style="width: 10%">CV</th>
                                        <th scope="col" style="width: 10%">Status</th>
                                        <th scope="col" style="width: 10%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($unpickCvs as $key => $cv)
                                        <tr>
                                            <td scope="row">
                                                @if(!empty(\Request::get('perPage')) && !empty(\Request::get('page')))
                                                    {{ (\Request::get('perPage') * (\Request::get('page') - 1)) + ($key + 1) }}
                                                @else
                                                    {{ $key + 1 }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $cv->created_at->format('d M Y') }}
                                            </td>
                                            <td>
                                                {{ $cv->fullname }}
                                            </td>
                                            <td>
                                                {{ $cv->email }}
                                            </td>
                                            <td>
                                                {{ $cv->phone_no }}
                                            </td>
                                            <td>
                                                {{ $cv->package }}
                                            </td>
                                            <td>
                                                @if($cv->cv_origin_filename != null)
                                                    <a href="{{ url('cv/' . $cv->cv_origin_filename) }}" target="_blank">Show CV</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($cv->status == 0) Not Upload
                                                @elseif($cv->status == 1) Not Pickup
                                                @elseif($cv->status == 2) On Progress
                                                @elseif($cv->status == 3) Finish
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('curriculum-vitae/pickup/' . $cv->id) }}" class="btn btn-primary btn-user btn-block">
                                                    Pickup
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="onworking" role="tabpanel">
                                <table class="table table-hover table-md">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%">#</th>
                                        <th scope="col" style="width: 10%">Date</th>
                                        <th scope="col" style="width: 22%">Customer Name</th>
                                        <th scope="col" style="width: 15%">Email</th>
                                        <th scope="col" style="width: 10%">Handphone No</th>
                                        <th scope="col" style="width: 10%">Package</th>
                                        <th scope="col" style="width: 10%">CV</th>
                                        <th scope="col" style="width: 10%">Status</th>
                                        <th scope="col" style="width: 10%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($onWorkingCvs as $key => $cv)
                                        <tr>
                                            <td scope="row">
                                                @if(!empty(\Request::get('perPage')) && !empty(\Request::get('page')))
                                                    {{ (\Request::get('perPage') * (\Request::get('page') - 1)) + ($key + 1) }}
                                                @else
                                                    {{ $key + 1 }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $cv->created_at->format('d M Y') }}
                                            </td>
                                            <td>
                                                {{ $cv->fullname }}
                                            </td>
                                            <td>
                                                {{ $cv->email }}
                                            </td>
                                            <td>
                                                {{ $cv->phone_no }}
                                            </td>
                                            <td>
                                                {{ $cv->package }}
                                            </td>
                                            <td>
                                                @if($cv->cv_origin_filename != null)
                                                    <a href="{{ url('cv/' . $cv->cv_origin_filename) }}" target="_blank">Show CV</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($cv->status == 0) Not Upload
                                                @elseif($cv->status == 1) Not Pickup
                                                @elseif($cv->status == 2) On Progress
                                                @elseif($cv->status == 3) Finish
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-primary btn-user btn-block finish-btn" data-id="{{ $cv->id }}">
                                                    Finish
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="finish" role="tabpanel">
                                <table class="table table-hover table-md">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%">#</th>
                                        <th scope="col" style="width: 10%">Date</th>
                                        <th scope="col" style="width: 22%">Customer Name</th>
                                        <th scope="col" style="width: 15%">Email</th>
                                        <th scope="col" style="width: 10%">Handphone No</th>
                                        <th scope="col" style="width: 10%">Package</th>
                                        <th scope="col" style="width: 15%">CV</th>
                                        <th scope="col" style="width: 10%">Status</th>
                                        <th scope="col" style="width: 5%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($finishCvs as $key => $cv)
                                        <tr>
                                            <td scope="row">
                                                @if(!empty(\Request::get('perPage')) && !empty(\Request::get('page')))
                                                    {{ (\Request::get('perPage') * (\Request::get('page') - 1)) + ($key + 1) }}
                                                @else
                                                    {{ $key + 1 }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $cv->created_at->format('d M Y') }}
                                            </td>
                                            <td>
                                                {{ $cv->fullname }}
                                            </td>
                                            <td>
                                                {{ $cv->email }}
                                            </td>
                                            <td>
                                                {{ $cv->phone_no }}
                                            </td>
                                            <td>
                                                {{ $cv->package }}
                                            </td>
                                            <td>
                                                @if($cv->cv_origin_filename != null)
                                                    <a href="{{ url('cv/' . $cv->cv_origin_filename) }}" target="_blank">Oroginal CV</a>
                                                @endif
                                                @if($cv->cv_modified_filename != null)
                                                    | <a href="{{ url('cv/' . $cv->cv_modified_filename) }}" target="_blank">Modified CV</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($cv->status == 0) Not Upload
                                                @elseif($cv->status == 1) Not Pickup
                                                @elseif($cv->status == 2) On Progress
                                                @elseif($cv->status == 3) Finish
                                                @endif
                                            </td>
                                            <td>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel">
                                <div class="text-right mb-3">
                                    <a href="javascript:void(0)" class="btn btn-primary" style="width: 150px" data-toggle="modal" data-target="#packageModal">Hired New Task</a>
                                </div>
                                <table class="table table-hover table-md">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="width: 3%">#</th>
                                        <th scope="col" style="width: 10%">Date</th>
                                        <th scope="col" style="width: 13%">Package</th>
                                        <th scope="col" style="width: 13%">Status</th>
                                        <th scope="col" style="width: 13%">Price</th>
                                        <th scope="col" style="width: 13%">Payment Status</th>
                                        <th scope="col" style="width: 13%"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($cvs as $key => $cv)
                                        <tr>
                                            <td scope="row">
                                                @if(!empty(\Request::get('perPage')) && !empty(\Request::get('page')))
                                                    {{ (\Request::get('perPage') * (\Request::get('page') - 1)) + ($key + 1) }}
                                                @else
                                                    {{ $key + 1 }}
                                                @endif
                                            </td>
                                            <td>
                                                {{ $cv->created_at->format('d M Y') }}
                                            </td>
                                            <td>
                                                {{ $cv->package }}
                                            </td>
                                            <td>
                                                @if($cv->status == 0) Not Upload @elseif($cv->status == 1) Not Pickup @elseif($cv->status == 2) On
                                                Progress @elseif($cv->status == 3) Finish @endif
                                            </td>
                                            <td>
                                                {{ $cv->price }}
                                            </td>
                                            <td>
                                                @if($cv->is_paid == 1) Paid @else Unpaid @endif
                                            </td>
                                            <td>
                                                @if($cv->status == 0)
                                                    <input id="cv" type="file" name="cv" hidden>
                                                    <label for="cv" class="upload-label">Upload CV</label>
                                                    <span id="file-chosen">No file chosen</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-info" role="document">
            <form method="POST" action="{{ url('curriculum-vitae/finish') }}" id="form-finish" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Upload Updated CV</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-3">
                            <div class="col-12">
                                <input id="cv" type="file" name="cv" hidden>
                                <label for="cv" class="upload-label">Upload Updated CV</label>
                                <span id="file-chosen">No file chosen</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="packageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-info modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Package Detail</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-5">
                            <h3>CV Writing</h3><br/>
                            <h4>RM80</h4><br/>
                            One-off<br/><br/>
                            You Get<br/>
                            + Full writing ATS CV<br/>
                            + Highlight achievement<br/>
                            + Redesign and rewrite<br/>
                            + Secret CV structure<br/>
                            + Free CV Templates<br/>
                            + Editable file<br/>
                            + Mini library access<br/>
                            + Secret checklist<br/>
                        </div>
                        <div class="col-5">
                            <h3>CV Templates</h3><br/>
                            <h4>RM50</h4><br/>
                            One-off<br/><br/>
                            You Get<br/>
                            + 2 ATS CV<br/>
                            + 3 Non ATS CV<br/>
                            + Full guidelines<br/>
                            + Free example<br/>
                            + Secret CV structure<br/>
                            + Secret CV structure<br/>
                            + Editable file<br/>
                            + Mini library access<br/>
                            + Secret checklist<br/>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-script')
    <script>
        $(document).ready(function () {
            $('.finish-btn').on('click', function () {
                console.log(1);
                $('#form-finish').attr('action', '{{ url('curriculum-vitae/finish') }}/' + $(this).attr('data-id'));
                $('#finishModal').modal('show');
            })
        });
    </script>
@append
