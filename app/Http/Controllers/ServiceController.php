<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Segment;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Listagem de serviços
     */
    public function index()
    {
        // Serviços activos
        $services = Service::with(['subcategory', 'segment', 'images'])
            ->where('is_active', true)
            ->orderBy('display_order')
            ->paginate(12);

        // Serviços em destaque
        $featuredServices = Service::with(['images'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->take(4)
            ->get();

        // Todos os segmentos (para menu)
        $segments = Segment::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('services.index', compact(
            'services',
            'featuredServices',
            'segments'
        ));
    }

    /**
     * Página de detalhe do serviço
     */
    public function show(string $slug)
    {
        // Buscar serviço
        $service = Service::with(['subcategory', 'segment', 'images', 'products'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Outros serviços (para sugestões)
        $otherServices = Service::with(['images'])
            ->where('id', '!=', $service->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Todos os segmentos (para menu)
        $segments = Segment::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('services.show', compact(
            'service',
            'otherServices',
            'segments'
        ));
    }
}