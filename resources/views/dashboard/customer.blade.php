@extends("main")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    List of Curriculum Vitae
                </div>
                <div class="card-body">
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
                                    @if($cv->status == 0)
                                        Not Upload
                                    @elseif($cv->status == 1)
                                        Not Pickup
                                    @elseif($cv->status == 2)
                                        On Progress
                                    @elseif($cv->status == 3)
                                        Finish @endif
                                </td>
                                <td>
                                    {{ $cv->price }}
                                </td>
                                <td>
                                    @if($cv->is_paid == 1) Paid @else Unpaid @endif
                                </td>
                                <td>
                                    @if($cv->is_paid == 0)
                                        @if (env('TOYYIBPAY_DEV') == 'yes')
                                            <a href="{{ 'https://dev.toyyibpay.com/' . $cv->bill_code }}" class="btn btn-primary btn-sm" target="_blank">Pay</a>
                                        @else
                                            <a href="{{ 'https://toyyibpay.com/' . $cv->bill_code }}" class="btn btn-primary btn-sm" target="_blank">Pay</a>
                                        @endif
                                    @endif
                                    @if($cv->status == 1 || $cv->status == 2)
                                        @if($cv->cv_origin_filename != null)
                                            <a href="{{ url('cv/' . $cv->cv_origin_filename) }}" target="_blank">Show CV</a>
                                        @endif
                                    @endif
                                    @if($cv->status == 3)
                                        @if($cv->cv_origin_filename != null)
                                            <a href="{{ url('cv/' . $cv->cv_origin_filename) }}" target="_blank">Original CV</a>
                                        @endif
                                        @if($cv->cv_modified_filename != null)
                                            | <a href="{{ url('cv/' . $cv->cv_modified_filename) }}" target="_blank">Modified CV</a>
                                        @endif
                                    @endif
                                    @if($cv->is_paid == 1 && $cv->status == 0)
                                        <input id="cv" type="file" name="cv" hidden data-id="{{ $cv->id }}">
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
                    <div class="row mt-3">
                        <div class="col-1"></div>
                        <div class="col-5">
                            <a href="{{ url('pay-package/'.Auth::user()->id.'/CV Writing') }}" class="btn btn-primary btn-user btn-block w-25">
                                Choose
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="{{ url('pay-package/'.Auth::user()->id.'/CV Templates') }}" class="btn btn-primary btn-user btn-block w-25">
                                Choose
                            </a>
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
            $('#cv').on('change', function () {
                let id = $(this).attr('data-id');
                var formData = new FormData();
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('cv', $(this)[0].files[0]);

                $.ajax({
                    url: '{{ url('curriculum-vitae/upload') }}/' + id,
                    type: 'POST',
                    data: formData,
                    processData: false,  // tell jQuery not to process the data
                    contentType: false,  // tell jQuery not to set contentType
                    success: function (data) {
                        $.toast({
                            heading: 'Success',
                            text: 'CV has been uploaded',
                            position: 'top-center',
                            stack: false,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                    }
                });
            });
        });
    </script>
@append
