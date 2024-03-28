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

                    <div class="dropdown d-inline-block">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="far fa-user" title="messages.user"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="/logout">{{__('messages.logout')}}</a></li>
                        </ul>
                    </div>
                    <input type="hidden" name="lang" id="lang" value="uk">
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

                            <li>Рекламное предложение</li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
