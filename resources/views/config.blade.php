@extends('main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    Konfigurasi Umum
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ \URL::to('config/1') }}" id="form-config-general">
                        @csrf
                        <input type="hidden" name="_method" value="PUT"/>
                        <div class="row mt-3">
                            <div class="col-md-8">
                                @if (strpos(Auth::user()->role, 'PENTADBIR SISTEM') !== false)
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Katanama Staf</label>
                                        <div class="col-md-9 pt-1">
                                            <div data-dx="radiogroup" data-name="username_as" data-source="usernameAs" data-value-exp="id" data-layout="horizontal"
                                                 data-value="{{ \Request::old('username_as', isset($usernameAs) ? $usernameAs['value'] : null) }}" data-validate="true"
                                                 data-validation-type="required" data-validation-group="form">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Katalaluan Lalai</label>
                                        <div class="col-md-5">
                                            <div data-dx="textbox" data-name="default_password" data-mode="text" data-case="lowercase"
                                                 data-value="{{ request()->old('default_password', isset($defaultPassword) ? $defaultPassword['value'] : null) }}"
                                                 data-validate="true" data-validation-type="required" data-validation-group="form"></div>
                                        </div>
                                    </div>
                                @endif
                                @if (strpos(Auth::user()->role, 'PENGURUS JABATAN') !== false)
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Masa Servis Per Pesakit</label>
                                        <div class="col-md-3">
                                            <div data-dx="numberbox" data-name="minutes_perpatient"
                                                 data-value="{{ request()->old('minutes_perpatient', isset($minutesPerPatient) ? $minutesPerPatient['value'] : null) }}"
                                                 data-validate="true" data-validation-type="required" data-validation-group="form"></div>
                                        </div>
                                        <label class="col-md-2 col-form-label">Minit</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Bilik Doktor</label>
                                        <div class="col-md-7 pt-1">
                                            <div style="width: 100%" class="text-right">
                                                <div class="buttons">
                                                    <a href="javascript:void(0)" id="add-room" class="btn btn-primary btn-sm mb-3">
                                                        Tambah Bilik
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-md">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" style="width: 90%">Nama Bilik</th>
                                                        <th scope="col" style="width: 10%">&nbsp;</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="room">
                                                    @if (count($doktorRooms) > 0)
                                                        @foreach ($doktorRooms as $room)
                                                            <tr>
                                                                <td style="padding: 5px 10px">
                                                                    <input type="text" name="room[]" value="{{ $room }}"
                                                                           class="form-control form-control-sm text-uppercase"/>
                                                                </td>
                                                                <td style="padding: 5px 10px" class="text-right">
                                                                    <div class="buttons">
                                                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-delete">Buang</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if (strpos(Auth::user()->role, 'PENTADBIR SISTEM') !== false)
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>SMTP</h4>
                                    <hr/>
                                    <ul>
                                        @if (strpos(Auth::user()->role, 'PENTADBIR SISTEM') !== false)
                                            <li>Katanama staf boleh pilih samada nak guna e-mel atau no kad pengenalan atau no pekerja. Katanama untuk klinik panel wajib
                                                e-mel sahaja
                                            </li>
                                        @endif
                                        @if (strpos(Auth::user()->role, 'PENGURUS HOSPITAL') !== false)
                                            <li>Had umur anak normal yang layak untuk ditanggung rawatan oleh, manakala OKU tiada had umur</li>
                                        @endif
                                        @if (strpos(Auth::user()->role, 'PENGURUS JABATAN') !== false)
                                            <li>Jumlah peruntukan setahun untuk seorang staf. Setiap awal tahun jumlah ini akan di reset secara automatik</li>
                                        @endif
                                        @if (strpos(Auth::user()->role, 'PENTADBIR SISTEM') !== false)
                                            <li>Gunakan akaun SMTP (cthnya Gmail anda) untuk send email daripada sistem ini.</li>
                                            <li>Untuk Gmail, jika sistem gagal untuk menghantar email, sila pastikan akaun Gmail anda berada pada mode Less Secure App
                                                accecc.
                                                Semak di sini : <a href="https://myaccount.google.com/u/2/security" target="_blank">https://myaccount.google.com/u/2/security</a>
                                            </li>
                                            <li>Untuk SMTP lainnya, sila ikuti panduan daripada SMTP provider</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Host</label>
                                        <div class="col-md-9">
                                            <div data-dx="textbox" data-name="mail_mailers_smtp_host" data-mode="text" data-case="lowercase"
                                                 data-value="{{ request()->old('mail_mailers_smtp_host', isset($emailHost) ? $emailHost['value'] : null) }}"
                                                 data-validate="true"
                                                 data-validation-type="required" data-validation-group="form"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Port</label>
                                        <div class="col-md-9">
                                            <div data-dx="textbox" data-name="mail_mailers_smtp_port" data-mode="text"
                                                 data-value="{{ request()->old('mail_mailers_smtp_port', isset($emailPort) ? $emailPort['value'] : null) }}"
                                                 data-validate="true"
                                                 data-validation-type="required" data-validation-group="form"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">SSL</label>
                                        <div class="col-md-9">
                                            <div data-dx="textbox" data-name="mail_mailers_smtp_encryption" data-mode="text" data-case="lowercase"
                                                 data-value="{{ request()->old('mail_mailers_smtp_encryption', isset($emailSSL) ? $emailSSL['value'] : null) }}"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Katanama SMTP</label>
                                        <div class="col-md-9">
                                            <div data-dx="textbox" data-name="mail_mailers_smtp_username" data-mode="text" data-case="lowercase"
                                                 data-value="{{ request()->old('mail_mailers_smtp_username', isset($emailUsername) ? $emailUsername['value'] : null) }}"
                                                 data-validate="true"
                                                 data-validation-type="required" data-validation-group="form"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Katalaluan SMTP</label>
                                        <div class="col-md-9">
                                            <div data-dx="textbox" data-name="mail_mailers_smtp_password" data-mode="password" data-case="lowercase"
                                                 data-value="{{ request()->old('mail_mailers_smtp_password', isset($emailPassword) ? $emailPassword['value'] : null) }}"
                                                 data-validate="true"
                                                 data-validation-type="required" data-validation-group="form">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Email Pengirim</label>
                                        <div class="col-md-9">
                                            <div data-dx="textbox" data-name="mail_from_address" data-mode="text" data-case="lowercase"
                                                 data-value="{{ request()->old('mail_from_address', isset($emailFrom) ? $emailFrom['value'] : null) }}" data-validate="true"
                                                 data-validation-type="required,email" data-validation-group="form"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Nama Pengirim</label>
                                        <div class="col-md-9">
                                            <div data-dx="textbox" data-name="mail_from_name" data-mode="text" data-case="lowercase"
                                                 data-value="{{ request()->old('mail_from_name', isset($emailName) ? $emailName['value'] : null) }}" data-validate="true"
                                                 data-validation-type="required" data-validation-group="form"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="card-footer text-right">
                    <div data-dx="btn-submit" data-type="default" data-text="Simpan" data-disabled="false" data-validation-group="form"
                         data-form="form-config-general">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="topup" method="post">
        <input type="hidden" name="_token">
    </form>
@stop

@section('page-script')
    <script>
        $(document).ready(function () {
            $('#add-room').on('click', function () {
                $('#room').append('' +
                    '<tr>' +
                    '<td style="padding: 5px 10px"><input type="text" name="room[]" class="form-control form-control-sm room text-uppercase" /></td>' +
                    '<td style="padding: 5px 10px" class="text-right"><div class="buttons"><a href="javascript:void(0)" data-id="" class="btn btn-sm btn-primary btn-delete">Buang</a></div></td>' +
                    '</tr>');
            });

            $("body").on("click", ".btn-delete", function (e) {
                $(this).closest('tr').remove();
            });

            $(document).on('submit', '#form-config-general', function (e) {
                e.preventDefault();
                let error = false;

                if ($('.room').length > 0) {
                    $('.room').each(function (kp) {
                        if ($(this).val() == '') {
                            $(this).addClass('is-invalid')
                            $(this).next().remove()
                            $('<div class="invalid-feedback">Sila masukkan nama bilik</div>').insertAfter($(this))
                            error = true
                        }
                    })
                }

                if (!error) {
                    this.submit();
                }
            });
        })
    </script>
@append
