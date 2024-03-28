<?php $lang = \App\Models\Language::getStatus()->id; ?>
<header class="fixed-top">
    <div class="header-top py-3">
        <livewire:head-model />
    </div>
    <div class="header-bottom py-2">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid p-0">
                    <a class="navbar-brand" href="/">{{env('APP_NAME')}}</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                            @foreach($mains as $main)
                                @foreach($main->main_descriptions as $main_description)
                                    @if($main_description->language_id == $lang)
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="{{env('APP_URL').'/parent/'.$main->id}}" id="navbarDropdown"
                                               role="button"
                                                aria-expanded="false">
                                             {{$main_description->title}}
                                            </a>
                                                @endif

                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                @foreach($main->categories as $category)
                                                    @foreach($category->category_descriptions as $category_description)
                                                        @if($category_description->language_id == $lang)
                                                            <li><a class="dropdown-item"
                                                                   href="{{env('APP_URL').'/category/'.$category_description->category_id}}">{{$category_description->title}}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                        @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
