@extends('client.layouts.layout')

@section('content')
    <div class="container">
        @include('layouts.errors')
        <form action="{{env('APP_URL')}}/admin/categories/{{$categories[0]->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label"><img src="{{env('APP_URL')}}/assets/img/en.png" alt="English"/></label>
            </div>
            <div class="mb-3">
                <label for="title_1" class="form-label">Title</label>
                <input type="text" name="title_1" placeholder="Title" class="form-control"
                       id="title_1" aria-describedby="emailHelp" value="{{$categories[0]->title}}">
                <div id="title_1" class="form-text">Add a title</div>
            </div>
            <div class="mb-3">
                <label for="description_1" class="form-label">Description</label>
                <textarea class="form-control" name="description_1" id="description_1" rows="3"
                          placeholder="Add a description">{{$categories[0]->description}}</textarea>
            </div>
            <div class="mb-3">
                <label for="keywords_1" class="form-label">Keywords</label>
                <textarea class="form-control" name="keywords_1" id="keywords_1" rows="3"
                          placeholder="Add keywords">{{$categories[0]->keywords}}</textarea>
            </div>
            <div class="mb-3">
                <label for="content_1" class="form-label">Content</label>
                <textarea class="form-control" name="content_1" id="content_1" rows="3"
                          placeholder="Add content">{{$categories[0]->content}}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label"><img src="{{env('APP_URL')}}/assets/img/uk.png" alt="Ukraine"/></label>
            </div>
            <div class="mb-3">
                <label for="title_2" class="form-label">Назва</label>
                <input type="text" name="title_2" placeholder="Назва" class="form-control"
                       id="title_2" aria-describedby="emailHelp" value="{{$categories[1]->title}}">
                <div id="title_2" class="form-text">Додати назву</div>
            </div>
            <div class="mb-3">
                <label for="description_2" class="form-label">Опис</label>
                <textarea class="form-control" name="description_2" id="description_2" rows="3"
                          placeholder="Додати опис">{{$categories[1]->description}}</textarea>
            </div>
            <div class="mb-3">
                <label for="keywords_2" class="form-label">Ключеві слова</label>
                <textarea class="form-control" name="keywords_2" id="keywords_2" rows="3"
                          placeholder="Додати ключеві слова">{{$categories[1]->keywords}}</textarea>
            </div>
            <div class="mb-3">
                <label for="content_2" class="form-label">Зміст</label>
                <textarea class="form-control" name="content_2" id="content_2" rows="3"
                          placeholder="Додати контент">{{$categories[1]->content}}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label"><img src="{{env('APP_URL')}}/assets/img/ru.png" alt="Russian"/></label>
            </div>
            <div class="mb-3">
                <label for="title_3" class="form-label">Название</label>
                <input type="text" name="title_3" placeholder="Название" class="form-control"
                       id="title_3" aria-describedby="emailHelp" value="{{$categories[2]->title}}">
                <div id="title_3" class="form-text">Добавить название</div>
            </div>
            <div class="mb-3">
                <label for="description_3" class="form-label">Описание</label>
                <textarea class="form-control" name="description_3" id="description_3" rows="3"
                          placeholder="Добавить описание">{{$categories[2]->description}}</textarea>
            </div>
            <div class="mb-3">
                <label for="keywords_3" class="form-label">Ключевые слова</label>
                <textarea class="form-control" name="keywords_3" id="keywords_3" rows="3"
                          placeholder="Добавить ключевые слова">{{$categories[2]->keywords}}</textarea>
            </div>
            <div class="mb-3">
                <label for="content_3" class="form-label">Содержание</label>
                <textarea class="form-control" name="content_3" id="content_3" rows="3"
                          placeholder="Добавить содержание">{{$categories[2]->content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="select_category" class="form-label">{{__('messages.select_category')}}</label>
                <select name="main" id="select_category" class="form-select" aria-label="Default select example">

                    @foreach($mains as $main)
                        @if($main->id == $categories[0]->main_id)
                            <option selected value="{{$main->id}}">{{$main->title}}</option>
                        @endif
                        <option value="{{$main->id}}">{{$main->title}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">{{__('messages.update')}}</button>
        </form>

        <br>
        <a href="{{env('APP_URL')}}/admin/categories">
            <div class="btn btn-danger" title="{{__('messages.to_back')}}"><-----</div>
        </a>
    </div>

@endsection

@section('js')
@endsection
