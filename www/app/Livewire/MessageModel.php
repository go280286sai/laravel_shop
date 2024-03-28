<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MessageModel extends Component
{
    /**
     * @param int $id
     * @return void
     */
    public function remove(int $id): void
    {
        Message::remove($id);
    }

    /**
     * @return void
     */
    public function removeAll(): void
    {
        Message::removeAll();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $messages = Message::all()->sortByDesc('created_at')->take(10);

        return view('livewire.message-model', ['messages' => $messages]);
    }

    /**
     * @param int $id
     * @return void
     */
    public function read(int $id): void
    {
        Message::setStatus($id);
    }
}
