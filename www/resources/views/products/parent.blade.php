@extends('layouts.layout')

@section('content')
    <div class="container">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-2">
                    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <livewire:get-title-parent-model :id="$parent->id"/>
        @foreach($parent->categories as $category)
            @foreach($category->category_descriptions as $description)
                @if($description->language_id == $lang)
                    <div class="col-lg-4 col-sm-6 mb-3">
                        <div class="product-card">
                            <div class="product-tumb">
                                <a href="/category/{{$category->id}}"><img
                                        src="{{\Illuminate\Support\Facades\Storage::url($description->img)}}"
                                        alt=""></a>
                            </div>
                            <div class="product-details text-center">
                                <a href="/category/{{$category->id}}"> <h4>{{$description->title}}</h4></a>
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
    </div>

@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
@endsection
