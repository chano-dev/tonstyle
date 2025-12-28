<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Segment;
use App\Models\Category;
use App\Models\Collection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Página inicial do site
     */
    public function index()
    {
        // Segmentos activos (para menu)
        $segments = Segment::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        // Produtos em destaque
        $featuredProducts = Product::with(['subcategory', 'brand', 'images', 'variations'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        // Produtos novos
        $newProducts = Product::with(['subcategory', 'brand', 'images', 'variations'])
            ->where('is_active', true)
            ->where('is_new', true)
            ->latest()
            ->take(8)
            ->get();

        // Produtos em promoção
        $saleProducts = Product::with(['subcategory', 'brand', 'images', 'variations'])
            ->where('is_active', true)
            ->where('is_on_sale', true)
            ->where('discount_percentage', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        // Produtos mais vendidos
        $bestsellerProducts = Product::with(['subcategory', 'brand', 'images', 'variations'])
            ->where('is_active', true)
            ->where('is_bestseller', true)
            ->orderBy('sales_count', 'desc')
            ->take(8)
            ->get();

        // Coleções activas
        $collections = Collection::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->take(4)
            ->get();

        // Serviços em destaque
        $services = Service::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('display_order')
            ->take(4)
            ->get();

        // Categorias (para secções)
        $categories = Category::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('home', compact(
            'segments',
            'featuredProducts',
            'newProducts',
            'saleProducts',
            'bestsellerProducts',
            'collections',
            'services',
            'categories'
        ));
    }
}