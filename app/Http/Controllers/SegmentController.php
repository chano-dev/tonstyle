<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SegmentController extends Controller
{
    /**
     * Página do segmento (ex: /mulher)
     */
    public function show(string $slug)
    {
        // Buscar segmento pelo slug
        $segment = Segment::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Categorias com subcategorias deste segmento
        $categories = Category::where('is_active', true)
            ->whereHas('subcategories', function ($query) use ($segment) {
                $query->where('segment_id', $segment->id)
                      ->where('is_active', true);
            })
            ->with(['subcategories' => function ($query) use ($segment) {
                $query->where('segment_id', $segment->id)
                      ->where('is_active', true)
                      ->orderBy('display_order');
            }])
            ->orderBy('display_order')
            ->get();

        // Produtos em destaque deste segmento
        $featuredProducts = Product::with(['subcategory', 'brand', 'images', 'variations'])
            ->whereHas('subcategory', function ($query) use ($segment) {
                $query->where('segment_id', $segment->id);
            })
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        // Produtos novos deste segmento
        $newProducts = Product::with(['subcategory', 'brand', 'images', 'variations'])
            ->whereHas('subcategory', function ($query) use ($segment) {
                $query->where('segment_id', $segment->id);
            })
            ->where('is_active', true)
            ->where('is_new', true)
            ->latest()
            ->take(8)
            ->get();

        // Todos os segmentos (para menu)
        $segments = Segment::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('segments.show', compact(
            'segment',
            'segments',
            'categories',
            'featuredProducts',
            'newProducts'
        ));
    }

    /**
     * Página da categoria dentro do segmento (ex: /mulher/roupas)
     */
    public function category(string $segmentSlug, string $categorySlug)
    {
        // Buscar segmento
        $segment = Segment::where('slug', $segmentSlug)
            ->where('is_active', true)
            ->firstOrFail();

        // Buscar categoria
        $category = Category::where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        // Subcategorias desta categoria neste segmento
        $subcategories = $category->subcategories()
            ->where('segment_id', $segment->id)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->get();

        // Produtos desta categoria neste segmento
        $products = Product::with(['subcategory', 'brand', 'images', 'variations'])
            ->whereHas('subcategory', function ($query) use ($segment, $category) {
                $query->where('segment_id', $segment->id)
                      ->where('category_id', $category->id);
            })
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        // Todos os segmentos (para menu)
        $segments = Segment::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('segments.category', compact(
            'segment',
            'segments',
            'category',
            'subcategories',
            'products'
        ));
    }

    /**
     * Página da subcategoria (ex: /mulher/roupas/vestidos)
     */
    public function subcategory(string $segmentSlug, string $categorySlug, string $subcategorySlug)
    {
        // Buscar segmento
        $segment = Segment::where('slug', $segmentSlug)
            ->where('is_active', true)
            ->firstOrFail();

        // Buscar categoria
        $category = Category::where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        // Buscar subcategoria
        $subcategory = $segment->subcategories()
            ->where('slug', $subcategorySlug)
            ->where('category_id', $category->id)
            ->where('is_active', true)
            ->firstOrFail();

        // Produtos desta subcategoria
        $products = Product::with(['subcategory', 'brand', 'images', 'variations', 'colors', 'sizes'])
            ->where('subcategory_id', $subcategory->id)
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        // Todas subcategorias da mesma categoria (para sidebar)
        $subcategories = $category->subcategories()
            ->where('segment_id', $segment->id)
            ->where('is_active', true)
            ->orderBy('display_order')
            ->get();

        // Todos os segmentos (para menu)
        $segments = Segment::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('segments.subcategory', compact(
            'segment',
            'segments',
            'category',
            'subcategory',
            'subcategories',
            'products'
        ));
    }
}