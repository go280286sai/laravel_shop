<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><a href="{{env('APP_URL').'/parent/'.$path->main_id}}">
                    {{$path->main_title}}
                </a></li>
            <li class="breadcrumb-item"><a href="{{env('APP_URL').'/category/'.$path->category_id}}">
                    {{$path->category_title}}
                </a></li>
            <li class="breadcrumb-item"><a href="{{env('APP_URL').'/product/'.$product_id}}">
                                            {{$product_title}}
                </a></li>

        </ol>
    </nav>
</div>
