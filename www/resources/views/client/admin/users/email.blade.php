@extends('client.layouts.layout')

@section('style')
    <script src="{{env('APP_URL')}}/assets/vendor/ckeditor5/build/ckeditor.js"></script>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="box">
                <h3>Email</h3>
                <form action="{{env('APP_URL').'/admin/user/send_email'}}" method="post">
                    <div class="box-header with-border">
                        @include('layouts.errors')
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('messages.to')}}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       placeholder="{{$user->email}}" disabled="disabled" name="email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">{{__('messages.title')}}</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                      name="title">
                            </div>
                            <div class="form-group">
                                @csrf
                                <label for="exampleInputEmail1">{{__('messages.text')}}</label>
                                <textarea id="editor" cols="30" rows="10" class="form-control"
                                          name="content">{{old('content')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer mt-4">
                        <a href="{{env('APP_URL')}}/admin/users">
                            <div class="btn btn-danger" title="{{__('messages.to_back')}}"><-----</div>
                        </a>
                        <input type="submit" class="btn btn-success pull-right" name="submit" value="{{__('messages.send')}}">
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
