<div class="container align-items-center">
    <div class="row">
        <div>
            <!-- Session Status -->
            <h2 class="txt_h2">{{__('messages.feedback')}}</h2>
            <form method="POST" action="/client/send_feedback" class="form_login mt-2">
                @csrf
                <input type="hidden" name="client" value="{{$client??'From site'}}">
                <div class="mb-3">
                    <textarea class="form-control" rows="10" id="message" name="message"></textarea>
                </div>
                <div class="flex items-center">
                    <button type="submit" class="btn text_label btn-primary mb-3">{{__('messages.send')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

