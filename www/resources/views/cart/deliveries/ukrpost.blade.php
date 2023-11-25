<div class="container align-items-center">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <!-- Session Status -->
            <x-auth-session-status :status="session('status')"/>
            <h2 class="txt_h2">{{__('messages.ukrpost')}}</h2>
            <form method="POST" action="/cart/agreement" class="form_login mt-2">
                @csrf
                <input type="hidden" name="service" value="2">
                <div class="mb-3">
                    <label for="name" class="form-label text_label">{{__('messages.name')}}</label>
                    <input class="form-control form_text" id="name" type="text" name="name" value="{{$user->name}}">
                    <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label text_label">{{__('messages.last_name')}}</label>
                    <input class="form-control form_text" id="last_name" type="text" name="last_name"
                           placeholder="Фамилия"
                           value="{{$user->user_descriptions[0]->last_name??''}}">
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label text_label">{{__('messages.phone')}}</label>
                    <input class="form-control form_text" id="phone" type="number" name="phone"
                           placeholder="380950000000"
                           value="{{$user->user_descriptions[0]->phone??''}}">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label text_label">{{__('messages.city')}}</label>
                    <select name="city" class="form-select form_text" aria-label="Default select example">
                        <option selected value="Harkiv">Харьков</option>
                        <option value="Kiev">Киев</option>
                        <option value="Dnepr">Днепр</option>
                        <option value="Odessa">Одесса</option>
                        <option value="Lviv">Львов</option>
                    </select>
                    <x-input-error :messages="$errors->get('city')" class="mt-2"/>
                </div>
                <div class="mb-3">
                    <label for="street" class="form-label text_label">Отделение</label>
                    <select name="street" class="form-select form_text" aria-label="Default select example">
                        <option selected value="street_1">Отделение 1</option>
                        <option value="street_2">Отделение 2</option>
                        <option value="street_3">Отделение 3</option>
                        <option value="street_4">Отделение 4</option>
                        <option value="street_5">Отделение 5</option>
                    </select>
                    <x-input-error :messages="$errors->get('street')" class="mt-2"/>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn text_label btn-primary mb-3">{{__('messages.send')}}</button>
                </div>
                <div class="mb-3">{{__('messages.edit_to_back')}}</div>
                <div class="mb-3">
                    <a href="/cart/store">
                        <div class="btn text_label btn-danger mb-3">{{__('messages.to_back')}}</div>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

