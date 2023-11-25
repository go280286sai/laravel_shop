<div class="container align-items-center">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <!-- Session Status -->
            <x-auth-session-status :status="session('status')"/>
            <h2 class="txt_h2">{{__("messages.payment_to_card")}}</h2>
            <form method="POST" action="/cart/create" class="form_login mt-2">
                @csrf
                <div class="mb-3">
                    <label for="card" class="form-label text_label">{{__('messages.input_to_card')}}</label>
                    <input class="form-control form_text" id="card" type="number" maxlength="16" name="card"
                           placeholder="0000000000000000">
                    <x-input-error :messages="$errors->get('card')" class="mt-2"/>
                </div>
                <div class="mb-3">
                    <table>
                        <tr>
                            <td colspan="3"><label for="card" class="form-label text_label">{{__('messages.input_date_to_card')}}
                                </label></td>
                            <td>{{__('messages.input_cvv')}}</td>
                        </tr>
                        <tr>
                            <td><input class="form-control form_text" id="card" maxlength="2" type="number" name="day"
                                       placeholder="01">
                                <x-input-error :messages="$errors->get('card')" class="mt-2"/>
                            </td>
                            <td> /</td>
                            <td><input class="form-control form_text" id="card" type="number" maxlength="2" name="month"
                                       placeholder="12">
                                <x-input-error :messages="$errors->get('card')" class="mt-2"/>
                            </td>
                            <td><input class="form-control form_text" id="card" type="number" name="card"
                                       placeholder="123">
                                <x-input-error :messages="$errors->get('card')" class="mt-2"/>
                            </td>
                        </tr>
                    </table>
                </div>
                <input type="hidden" value="{{$id}}" name="payment">
                <div>
                    <button type="submit" class="btn text_label btn-primary mb-3">{{__('messages.to_payment')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

