<div>
    <div class="btn btn-danger" wire:click="removeAll()">{{__('messages.remove_all')}}</div>
    <table id="example" class="table" style="width:100%">
        <thead>
        <tr>
            <th scope="col">{{__('messages.title')}}</th>
            <th scope="col">{{__('messages.created')}}</th>
            <th scope="col" colspan="2" class="text-center">{{__('messages.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($messages as $message)
            <tr class={{$message->is_read == 0 ? 'table-secondary' : 'table-light'}}>
                <td>
                    {{$message->text}}
                </td>
                <td>
                    {{$message->created_at}}
                </td>
                <td>
                    <button wire:click="remove({{$message->id}})" class="btn"
                            title="{{__('messages.remove')}}"><i class="fa fa-trash"></i></button>
                </td>
                <td>
                    @if($message->is_read == 0)
                        <button wire:click="read({{$message->id}})" class="btn"
                                title="{{__('messages.updated')}}"><i class="fa fa-envelope"></i></button>
                    @else
                        <button class="btn"
                                title="{{__('messages.updated')}}"><i class="fa fa-envelope-open"></i></button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
