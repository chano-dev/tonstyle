<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SchemaOrg extends Component
{
    public $data;

    public function __construct($data = [])
    {
        // Garante que @context e @type sempre existem
        $this->data = array_merge([
            '@context' => 'https://schema.org',
        ], $data);
    }

    public function render()
    {
        return view('components.schema-org');
    }
}