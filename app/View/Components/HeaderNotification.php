<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\SupportRequest;

class HeaderNotification extends Component
{
    public $newRequestCount;
    public $requests;

    public function __construct()
    {
        $this->newRequestCount = SupportRequest::where('is_new', true)->count();
        $this->requests = SupportRequest::orderByDesc('created_at')->get();
    }

    public function render()
    {
        return view('components.header-notification');
    }
}
