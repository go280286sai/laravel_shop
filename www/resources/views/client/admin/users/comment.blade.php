@extends('client.layouts.layout')

@section('style')
    <script src="{{env('APP_URL')}}/assets/vendor/ckeditor5/build/ckeditor.js"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="box">
                <form action="{{env('APP_URL').'/admin/user/add_comment'}}" method="post">
                    <div class="box-header with-border">
                        @include('layouts.errors')
                    </div>
                    <h3>{{__('messages.comment')}}</h3>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                @csrf
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <textarea id="editor" cols="10" rows="10" class="form-control"
                                          name="content">{{$comment['comment']??''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="mt-4">
                        <a href="/admin/users" title="{{__('messages.to_back')}}">
                            <div class="btn btn-danger"><-----</div>
                        </a>
                        <input type="submit" class="btn btn-success pull-right" name="submit"
                               value="{{__('messages.send')}}">
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@section('js')

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
