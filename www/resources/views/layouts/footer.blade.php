<footer>
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <h4>{{__('messages.information')}}</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">{{__('messages.main')}}</a></li>
                        <li><a href="#">{{__('messages.about')}}</a></li>
                        <li><a href="#">{{__('messages.delivery')}}</a></li>
                        <li><a href="#">{{__('messages.contacts')}}</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-6">
                    <h4>{{__('messages.work_time')}}</h4>
                    <ul class="list-unstyled">
                        <li>{{__('messages.address')}}</li>
                        <li>{{__('messages.graph')}}</li>
                        <li>{{__('messages.reset_time')}}</li>
                    </ul>
                </div>
                <div class="col-md-3 col-6">
                    <h4>Контакты</h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:{{env('APP_PHONE')}}">{{env('APP_PHONE')}}</a></li>
                        <li><a href="tel:{{env('APP_PHONE')}}">{{env('APP_PHONE')}}</a></li>
                        <li><a href="tel:{{env('APP_PHONE')}}">{{env('APP_PHONE')}}</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-6">
                    <h4>{{__('messages.social')}}</h4>
                    <div class="footer-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

               <livewire:cart-modal />

