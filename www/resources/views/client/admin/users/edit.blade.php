@extends('client.layouts.layout')

@section('content')
    <div class="container">
        @include('layouts.errors')
        <form action="{{env('APP_URL').'/admin/users/'.$user->id}}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_description_id" value="{{$user->user_description_id}}">
            <div class="mb-3">
                <label for="name" class="form-label">{{__('messages.name')}}</label>
                <input type="text" name="name" class="form-control"
                       id="name" aria-describedby="emailHelp" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">{{__('messages.last_name')}}</label>
                <input type="text" name="last_name" class="form-control"
                       id="last_name" aria-describedby="emailHelp" value="{{$user->last_name}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control"
                       id="email" aria-describedby="emailHelp" value="{{$user->email}}" disabled="disabled">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">{{__('messages.phone')}}</label>
                <input type="text" class="form-control" name="phone"
                       id="phone" aria-describedby="emailHelp" value="{{$user->phone}}">
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">{{__('messages.birthday')}}</label>
                <input type="date" name="birthday" class="form-control"
                       id="birthday" aria-describedby="emailHelp" value="{{$user->birthday}}">
            </div>
            <div class="mb-3">
                <label for="gender_id" class="form-label text_label">{{__('messages.gender')}}</label>
                <select name="gender_id" class="form-select form_text" aria-label="Default select example">
                    @foreach($genders as $gender)
                        @foreach($gender->gender_descriptions as $gender_description)
                            @if($user->gender_id ==$gender_description->gender_id && $gender_description->language_id==$lang->id)
                                <option selected
                                        value="{{$gender_description->gender_id}}">{{$gender_description->name}}</option>
                            @endif
                            @if($gender_description->language_id==$lang->id)
                                <option
                                    value="{{$gender_description->gender_id}}">{{$gender_description->name}}</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{__('messages.update')}}</button>
        </form>
        <br>
        <a href="/admin/users" title="{{__('messages.to_back')}}">
            <div class="btn btn-danger"><-----</div>
        </a>
    </div>
@endsection

@section('js')
@endsection
