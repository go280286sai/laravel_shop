<div>
    @include("layouts.errors")
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div>
        <div class="btn btn-dark" title="Вы действительно хотите удалить все данные?" wire:click="clearJsons">{{__('messages.remove_jsons')}}</div>
        <div class="btn btn-dark" title="Вы действительно хотите удалить все данные?" wire:click="clearAll">{{__('messages.remove_all')}}</div>
      @if(!$status_download)
            <div class="btn btn-danger" disabled="disabled">{{__('messages.no_data')}}</div>
        @else
            <div class="btn btn-danger" title="Загрузить данные?" wire:click="download">{{__('messages.download_jsons')}}</div></div>
      @endif

    </div>
    <form action="{{env('APP_URL').'/admin/exchange'}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <select name="resource" class="form-select" aria-label="Default select example">
                <option selected value="null">Open this select menu</option>
                @foreach($resources as $resource)
                    <option value="{{$resource->url}}">{{$resource->name}} - {{$resource->url}}</option>
                @endforeach
            </select>
            <div id="emailHelp" class="form-text">Select a resource</div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Target</label>
            <select name="target" class="form-select" aria-label="Default select example">
                <option selected value="null">Open this select menu</option>
                <option value="Parser">Parser</option>
                <option value="Clean">Clean</option>
                <option value="Download">Download</option>
            </select>
            <div id="emailHelp" class="form-text">Select a target</div>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">Url</label>
            <input type="text" name="url" placeholder="Url" class="form-control"
                   id="url" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Add a url</div>
        </div>
        <button type="submit" class="btn btn-primary">{{__('messages.send')}}</button>
    </form>
</div>
