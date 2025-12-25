<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SchemaOrg extends Component
{
    public ?array $data;

    public function __construct(?array $data = null)
    {
        $this->data = $data;
    }

    public function render(): View|Closure|string
    {
        return view('components.schema-org');
    }
}