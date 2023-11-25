<?php $lang = \App\Models\Language::getStatus()->id; ?>
<header class="fixed-top">
    <div class="header-top py-3">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col">
                    <a href="tel:{{env('APP_PHONE')}}">
                        <span class="icon-phone">&#9743;</span> {{env('APP_PHONE')}}
                    </a>
                </div>
                <div class="col text-end icons">
                    <form action="{{env('APP_URL')}}/main/search" method="post">
                        <div class="input-group" id="search">
                            @csrf
                            <input type="text" class="form-control" placeholder="{{__('messages.search')}}..." name="text">
                            <button class="btn close-search" type="button"><i class="fas fa-times"></i></button>
                            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>


                    <a href="#" class="open-search"><i class="fas fa-search" title="{{__('messages.search')}}"></i></a>


                    <a href="{{env('APP_URL')}}/cart" class="relative" data-bs-toggle="modal"
                       data-bs-target="#cart-modal">
                        <i class="fas fa-shopping-cart" title="{{__('messages.cart')}}"></i>
                        <span class="badge bg-danger rounded-pill count-items"><b id="cart-count"></b></span>
                    </a>


                    <a href="{{env('APP_URL')}}/wishlist" class="relative"
                       data-bs-target="#favorite-modal">
                        <i class="fas fa-heart" title="{{__('messages.favorite')}}"></i>
                        <span class="badge bg-danger rounded-pill count-items"><b id="favorite-count"></b></span>
                    </a>



                    <div class="dropdown d-inline-block">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="far fa-user" title="{{__('messages.user')}}"></i>
                        </a>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/client/dashboard">{{__('messages.profile')}}</a></li>
                                <li>
                                    <a class="dropdown-item" href="/logout">{{__('messages.logout')}}</a></li>
                            </ul>
                        @else
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/login">{{__('messages.login')}}</a></li>
                                <li><a class="dropdown-item" href="/register">{{__('messages.registration')}}   </a>
                                </li>
                            </ul>
                        @endif
                    </div>
                    <input type="hidden" name="lang" id="lang" value="{{app()->getLocale()}}">
                    <div class="dropdown d-inline-block">
                        <a href="/lang/{{app()->getLocale()}}" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{env('APP_URL')}}/assets/img/{{app()->getLocale()}}.png" alt="Language"
                                 title="{{__('messages.lang')}}">
                        </a>
                        <ul class="dropdown-menu" id="languages">
                            <li>
                                <a href="/lang/uk">
                                    <img src="{{env('APP_URL')}}/assets/img/uk.png" alt="Ukraine"><i class="text_lang">Ukraine</i>
                                </a>
                            </li>
                            <li>
                                <a href="/lang/en">
                                    <img src="{{env('APP_URL')}}/assets/img/en.png" alt="English"><i class="text_lang">English</i>
                                </a>
                            </li>
                            <li>
                                <a href="/lang/ru">
                                    <img src="{{env('APP_URL')}}/assets/img/ru.png" alt="Russian"><i class="text_lang">Russian</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                               role="button"
                                               data-bs-toggle="dropdown" aria-expanded="false">
                                                {{$main_description->title}}
                                                @endif
                                            </a>
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
