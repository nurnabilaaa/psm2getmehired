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
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th style="width: 40%">Curriculum Vitae</th>
                            <th style="width: 25%">Date</th>
                            <th style="width: 25%">Status</th>
                            <th style="width: 10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Yiorgos Avraamu</td>
                            <td>Yiorgos Avraamu</td>
                            <td>Yiorgos Avraamu</td>
                            <td></td>
                        </tr>
                        
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
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop
