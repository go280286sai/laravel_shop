@extends('client.layouts.layout')

@section('content')
    <div class="container">
        @include('layouts.errors')
        <form action="{{env('APP_URL')}}/admin/products" method="post" enctype="multipart/form-data">
            @csrf
            <img src="{{env('APP_URL')}}/assets/img/en.png" alt="English"/>
            <br>
            <div class="mb-3">
                <label for="title_1" class="form-label">Title</label>
                <input type="text" id="title_1" class="form-control" name="title_1" placeholder="Title" value="{{old('title_1')}}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content_1" class="form-control" cols="15" rows="5" placeholder="Add a content">{{old('content_1')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="exerpt_1" class="form-label">Exerpt</label>
                <textarea id="exerpt_1" name="exerpt_1" class="form-control" cols="15" rows="5" placeholder="Add a exerpt">{{old('exerpt_1')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="keywords_1" class="form-label">Keywords</label>
                <textarea id="keywords_1" name="keywords_1" class="form-control" cols="15" rows="5" placeholder="Add keywords">{{old('keywords_1')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="description_1" class="form-label">Description</label>
                <textarea id="description_1" name="description_1" class="form-control" cols="15" rows="5" placeholder="Add a description">{{old('description_1')}}</textarea>
            </div>

            <img src="{{env('APP_URL')}}/assets/img/uk.png" alt="Ukraine"/>
            <br>
            <div class="mb-3">
                <label for="title_2" class="form-label">Назва</label>
                <input type="text" id="title" class="form-control" name="title_2" placeholder="Назва" value="{{old('title_2')}}">
            </div>
            <div class="mb-3">
                <label for="content_2" class="form-label">Зміст</label>
                <textarea id="content_2" name="content_2" class="form-control" cols="15" rows="5" placeholder="Додати зміст">{{old('content_2')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="exerpt_2" class="form-label">О товарі</label>
                <textarea id="exerpt_2" name="exerpt_2" class="form-control" cols="15" rows="5" placeholder="Додати о товарі">{{old('exerpt_2')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="keywords_2" class="form-label">Ключові слова</label>
                <textarea id="keywords_2" name="keywords_2" class="form-control" cols="15" rows="5" placeholder="Додати ключові слова">{{old('keywords_2')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="description_2" class="form-label">Опис</label>
                <textarea id="description_2" name="description_2" class="form-control" cols="15" rows="5" placeholder="Додати опис">{{old('description_2')}}</textarea>
            </div>

            <img src="{{env('APP_URL')}}/assets/img/ru.png" alt="Russian"/>
            <br>
            <div class="mb-3">
                <label for="title_3" class="form-label">Название</label>
                <input type="text" id="title_3" class="form-control" name="title_3" placeholder="Название" value="{{old('title_3')}}">
            </div>
            <div class="mb-3">
                <label for="content_3" class="form-label">Описание</label>
                <textarea id="content_3" name="content_3" class="form-control" cols="15" rows="5" placeholder="Добавить описание товара">{{old('content_3')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="exerpt_3" class="form-label">О товаре</label>
                <textarea id="exerpt_3" name="exerpt_3" class="form-control" cols="15" rows="5" placeholder="Добавить о товаре">{{old('exerpt_3')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="keywords_3" class="form-label">Ключевые слова</label>
                <textarea id="keywords_3" name="keywords_3" class="form-control" cols="15" rows="5" placeholder="Добавить ключевые слова">{{old('keywords_3')}}</textarea>
            </div>
            <div class="mb-3">
                <label for="description_3" class="form-label">Описание</label>
                <textarea id="description_3" name="description_3" class="form-control" cols="15" rows="5" placeholder="Добавить описание">{{old('description_3')}}</textarea>
            </div>
            <td>{{__('messages.select_category')}}
                <select name="category" class="form-select" aria-label="Default select example">
                    <option selected>{{__('messages.select_menu')}}</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </td>
            <div class="mb-3">
                <label for="new_price" class="form-label">{{__('messages.price')}}</label>
                <input type="text" id="new_price" class="form-control" name="new_price" placeholder="{{__('messages.price')}}" value="{{old('new_price')}}">
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">{{__('messages.quantity')}}</label>
                <input type="text" id="amount" class="form-control" name="amount" placeholder="{{__('messages.quantity')}}" value="{{old('amount')}}">
            </div>
            <div class="mb-3">
                <img src="{{\Illuminate\Support\Facades\Storage::url('uploads/img/no-image.jpg')}}" alt=""
                     width="200px">
            </div>
            <div class="mb-3">
                <input type="file" id="img" class="form-control" name="img">
            </div>
            <div>
                <input type="submit" class="btn btn-success" value="{{__('messages.add')}}">
            </div>
        </form>
        <br>
        <a href="{{env('APP_URL')}}/admin/products">
            <div class="btn btn-danger" title="{{__('messages.to_back')}}"><-----</div>
        </a>
    </div>
@endsection

@section('js')
@endsection
