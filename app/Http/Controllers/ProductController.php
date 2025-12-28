<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Segment;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Brand;
use App\Models\BodyType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Listagem geral de produtos (com filtros)
     */
    public function index(Request $request)
    {
        // Query base
        $query = Product::with(['subcategory.segment', 'subcategory.category', 'brand', 'images', 'variations', 'colors', 'sizes'])
            ->where('is_active', true);

        // Filtro por segmento
        if ($request->filled('segment')) {
            $query->whereHas('subcategory.segment', function ($q) use ($request) {
                $q->where('slug', $request->segment);
            });
        }

        // Filtro por categoria
        if ($request->filled('category')) {
            $query->whereHas('subcategory.category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filtro por marca
        if ($request->filled('brand')) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->where('slug', $request->brand);
            });
        }

        // Filtro por cor
        if ($request->filled('color')) {
            $query->whereHas('colors', function ($q) use ($request) {
                $q->where('slug', $request->color);
            });
        }

        // Filtro por tamanho
        if ($request->filled('size')) {
            $query->whereHas('sizes', function ($q) use ($request) {
                $q->where('slug', $request->size);
            });
        }

        // Filtro por tipo de corpo (DIFERENCIAL!)
        if ($request->filled('body_type')) {
            $query->whereHas('bodyTypes', function ($q) use ($request) {
                $q->where('slug', $request->body_type);
            });
        }

        // Filtro por preço
        if ($request->filled('price_min')) {
            $query->where('price_sell', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price_sell', '<=', $request->price_max);
        }

        // Filtro por promoção
        if ($request->boolean('on_sale')) {
            $query->where('is_on_sale', true);
        }

        // Filtro por novidades
        if ($request->boolean('new')) {
            $query->where('is_new', true);
        }

        // Ordenação
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price_sell', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price_sell', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'bestseller':
                $query->orderBy('sales_count', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        // Paginação
        $products = $query->paginate(12)->withQueryString();

        // Dados para filtros (sidebar)
        $segments = Segment::where('is_active', true)->orderBy('display_order')->get();
        $categories = Category::where('is_active', true)->orderBy('display_order')->get();
        $colors = Color::where('is_active', true)->orderBy('display_order')->get();
        $sizes = Size::where('is_active', true)->orderBy('display_order')->get();
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $bodyTypes = BodyType::where('is_active', true)->orderBy('display_order')->get();

        return view('products.index', compact(
            'products',
            'segments',
            'categories',
            'colors',
            'sizes',
            'brands',
            'bodyTypes'
        ));
    }

    /**
     * Página de detalhe do produto
     */
    public function show(string $slug)
    {
        // Buscar produto com todos os relacionamentos
        $product = Product::with([
            'subcategory.segment',
            'subcategory.category',
            'brand',
            'collection',
            'images',
            'variations.color',
            'variations.size',
            'colors',
            'sizes',
            'materials',
            'occasions',
            'styles',
            'bodyTypes',
            'careInstructions',
            'services'
        ])
        ->where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

        // Incrementar visualizações
        $product->increment('views_count');

        // Produtos relacionados (mesma subcategoria)
        $relatedProducts = Product::with(['images', 'variations'])
            ->where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Produtos da mesma marca
        $brandProducts = collect();
        if ($product->brand_id) {
            $brandProducts = Product::with(['images', 'variations'])
                ->where('brand_id', $product->brand_id)
                ->where('id', '!=', $product->id)
                ->where('is_active', true)
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        // Todos os segmentos (para menu)
        $segments = Segment::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('products.show', compact(
            'product',
            'segments',
            'relatedProducts',
            'brandProducts'
        ));
    }

    /**
     * Busca de produtos
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return redirect()->back()->with('error', 'Digite pelo menos 2 caracteres para pesquisar.');
        }

        $products = Product::with(['subcategory', 'brand', 'images', 'variations'])
            ->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('sku', 'like', "%{$query}%")
                  ->orWhereHas('brand', function ($q2) use ($query) {
                      $q2->where('name', 'like', "%{$query}%");
                  });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $segments = Segment::where('is_active', true)->orderBy('display_order')->get();

        return view('products.search', compact('products', 'segments', 'query'));
    }
}