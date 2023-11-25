@extends('client.layouts.layout')

@section('content')
    <div class="container">
        @include('layouts.errors')
        <form action="{{env('APP_URL')}}/admin/products/{{$products[0]->id}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <img src="{{env('APP_URL')}}/assets/img/en.png" alt="English"/>
            <br>
            <div class="mb-3">
                <label for="title_1" class="form-label">Title</label>
                <input type="text" id="title_1" class="form-control" name="title_1" placeholder="Title"
                       value="{{$products[0]->title}}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content_1" class="form-control" cols="15" rows="5"
                          placeholder="Add a content">{{$products[0]->content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="exerpt_1" class="form-label">Exerpt</label>
                <textarea id="exerpt_1" name="exerpt_1" class="form-control" cols="15" rows="5"
                          placeholder="Add a exerpt">{{$products[0]->exerpt}}</textarea>
            </div>
            <div class="mb-3">
                <label for="keywords_1" class="form-label">Keywords</label>
                <textarea id="keywords_1" name="keywords_1" class="form-control" cols="15" rows="5"
                          placeholder="Add keywords">{{$products[0]->keywords}}</textarea>
            </div>
            <div class="mb-3">
                <label for="description_1" class="form-label">Description</label>
                <textarea id="description_1" name="description_1" class="form-control" cols="15" rows="5"
                          placeholder="Add a description">{{$products[0]->description}}</textarea>
            </div>

            <img src="{{env('APP_URL')}}/assets/img/uk.png" alt="Ukraine"/>
            <br>
            <div class="mb-3">
                <label for="title_2" class="form-label">Назва</label>
                <input type="text" id="title" class="form-control" name="title_2" placeholder="Назва"
                       value="{{$products[1]->title}}">
            </div>
            <div class="mb-3">
                <label for="content_2" class="form-label">Зміст</label>
                <textarea id="content_2" name="content_2" class="form-control" cols="15" rows="5"
                          placeholder="Додати зміст">{{$products[1]->content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="exerpt_2" class="form-label">О товарі</label>
                <textarea id="exerpt_2" name="exerpt_2" class="form-control" cols="15" rows="5"
                          placeholder="Додати о товарі">{{$products[1]->exerpt}}</textarea>
            </div>
            <div class="mb-3">
                <label for="keywords_2" class="form-label">Ключові слова</label>
                <textarea id="keywords_2" name="keywords_2" class="form-control" cols="15" rows="5"
                          placeholder="Додати ключові слова">{{$products[1]->keywords}}</textarea>
            </div>
            <div class="mb-3">
                <label for="description_2" class="form-label">Опис</label>
                <textarea id="description_2" name="description_2" class="form-control" cols="15" rows="5"
                          placeholder="Додати опис">{{$products[1]->description}}</textarea>
            </div>

            <img src="{{env('APP_URL')}}/assets/img/ru.png" alt="Russian"/>
            <br>
            <div class="mb-3">
                <label for="title_3" class="form-label">Название</label>
                <input type="text" id="title_3" class="form-control" name="title_3" placeholder="Название"
                       value="{{$products[2]->title}}">
            </div>
            <div class="mb-3">
                <label for="content_3" class="form-label">Описание</label>
                <textarea id="content_3" name="content_3" class="form-control" cols="15" rows="5"
                          placeholder="Добавить описание товара">{{$products[2]->content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="exerpt_3" class="form-label">О товаре</label>
                <textarea id="exerpt_3" name="exerpt_3" class="form-control" cols="15" rows="5"
                          placeholder="Добавить о товаре">{{$products[1]->exerpt}}</textarea>
            </div>
            <div class="mb-3">
                <label for="keywords_3" class="form-label">Ключевые слова</label>
                <textarea id="keywords_3" name="keywords_3" class="form-control" cols="15" rows="5"
                          placeholder="Добавить ключевые слова">{{$products[1]->keywords}}</textarea>
            </div>
            <div class="mb-3">
                <label for="description_3" class="form-label">Описание</label>
                <textarea id="description_3" name="description_3" class="form-control" cols="15" rows="5"
                          placeholder="Добавить описание">{{$products[1]->description}}</textarea>
            </div>
            <td>{{__('messages.select_category')}}

                <select name="category" class="form-select" aria-label="Default select example">
                    @foreach($categories as $category)
                        @if($products[0]->category_id == $category->id)
                            <option selected value="{{$category->id}}">{{$category->title}}</option>
                        @endif
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </td>
            <div class="mb-3">
                <label for="old_price" class="form-label">Старая цена:</label>
                <input type="text" id="old_price" class="form-control" name="old_price"
                       value="{{$products[0]->old_price}}">
            </div>
            <div class="mb-3">
                <label for="new_price" class="form-label">Новая цена:</label>
                <input type="text" id="new_price" class="form-control" name="new_price" value="{{$products[0]->price}}">
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Количество:</label>
                <input type="text" id="amount" class="form-control" name="amount" value="{{$products[0]->amount}}">
            </div>
            <div class="mb-3">
                <img src="{{\Illuminate\Support\Facades\Storage::url($products[0]->img)}}" alt="" width="200px">
            </div>
            <div class="mb-3">
                <input type="file" id="img" class="form-control" name="img">
            </div>
            <input type="hidden" name="product_id" value="{{$products[0]->id}}">
            <div>
                <input type="submit" class="btn btn-success" value="{{__('messages.update')}}">
            </div>
        </form>
        <br>
        <a href="{{env('APP_URL')}}/admin/products">
            <div class="btn btn-danger" title="{{__('messages.to_back')}}"><-----</div>
        </a>
    </div>
    <div class="mt-3"><h3>{{__('messages.gallery')}}</h3></div>

    <form action="{{env('APP_URL')}}/admin/gallery" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            @foreach($galleries as $gallery)
                <tr>
                    <td><img src="{{\Illuminate\Support\Facades\Storage::url($gallery->img)}}" alt="" width="200px">
                    </td>
                    <td><input type="file" name="gallery[{{$gallery->id}}]"></td>
                    <td><a href="/admin/gallery/{{$gallery->id}}/delete" class="btn"
                           onclick="return confirm('{{__('messages.are_you_sure')}}')" title="{{__('messages.remove')}}">
                            <i class="fa fa-trash"></i>
                        </a></td>
                </tr>
            @endforeach
        </table>
        <div>
            <input type="submit" class="btn btn-success" value="{{__('messages.update')}}">
        </div>
    </form>
<div>
</div>
    <div class="mt-3 mb-3"><h3>{{__('messages.add_to_gallery')}}</h3></div>
    <form action="{{env('APP_URL')}}/admin/add_gallery" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_id" value="{{$products[0]->id}}">
        <input type="file" name="img">
        <input type="submit" class="btn btn-success" value="{{__('messages.send')}}">
    </form>
@endsection

@section('js')
@endsection
