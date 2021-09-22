@extends('main')
@section('content')
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{  isset($announcement) ? route('announcement.update', $announcement->id) : route('announcement.store') }}" id="form-announcement"
                  enctype="multipart/form-data" novalidate>
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        @if (isset($announcement)) Update @else Add @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="title">Title</label>
                                    <div class="col-md-7">
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                               value="{{ \Request::old('title', isset($announcement) ? $announcement->title : null) }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="content_type">Content type</label>
                                    <div class="col-md-7">
                                        <select class="form-control" id="content_type" name="content_type">
                                            <option value="text" @if(isset($announcement) && $announcement->content_type == 'text' || \Request::old('content_type') == 'text') selected @endif>Text</option>
                                            <option value="image" @if(isset($announcement) && $announcement->content_type == 'image' || \Request::old('content_type') == 'image') selected @endif>Image</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="text-section" @if (\Request::old('content_type') == 'image') style="display: none" @endif>
                                    <label class="col-md-2 col-form-label" for="content_text">Content</label>
                                    <div class="col-md-7">
                                        <div @error('content_text') style="border: 1px solid #e55353" @enderror>
                                        <textarea id="content_text" name="content_text">
                                             @if(isset($announcement) && $announcement->content_type == 'text')
                                                {{ \Request::old('content', isset($announcement) ? $announcement->content : null) }}
                                            @endif
                                        </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="image-section" @if (\Request::old('content_type') == 'text') style="display: none" @endif>
                                    <label class="col-md-2 col-form-label" for="department_id">Content</label>
                                    <div class="col-md-7">
                                        <div @error('content_image') style="border: 1px solid #e55353" @enderror>
                                            <input id="content_image" type="file" name="content_image" hidden>
                                            <label for="content_image" class="upload-label">Upload Image</label>
                                            <span id="file-chosen">No file chosen</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="expired_at">Expired At</label>
                                    <div class="col-md-7">
                                        <input id="phone_no" type="date" class="form-control @error('expired_at') is-invalid @enderror" name="expired_at"
                                               value="{{ \Request::old('expired_at', isset($announcement) ? $announcement->expired_at : null) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('announcement.index') }}" class="btn btn-ghost-danger">Cancel</a>
                        <button type="submit" class="btn btn-sm btn-primary">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@stop

@section('page-script')
    <script>
        $(document).ready(function () {
            $('#content_type').on('change', function () {
                if ($(this).val() === 'image') {
                    $('#image-section').removeAttr('style')
                    $('#text-section').css('display', 'none')
                } else {
                    if ($(this).val() === 'text') {
                        $('#text-section').removeAttr('style')
                        $('#image-section').css('display', 'none')
                    }
                }
            })
            tinymce.init({
                selector: '#content_text',
                branding: false,
                height: 500,
                menubar: false
            });
        })
    </script>
@append
