<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Supplier;
use App\Models\Service;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        // Contagens básicas
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $featuredProducts = Product::where('is_featured', true)->count();
        
        // Stock
        $totalStock = ProductVariation::sum('stock_quantity');
        $lowStockCount = ProductVariation::whereColumn('stock_quantity', '<=', 'stock_min')
            ->where('stock_quantity', '>', 0)
            ->count();
        $outOfStockCount = ProductVariation::where('stock_quantity', '<=', 0)->count();
        
        // Fornecedores
        $totalSuppliers = Supplier::where('is_active', true)->count();
        $consignmentSuppliers = Supplier::where('is_consignment', true)->where('is_active', true)->count();
        
        // Serviços
        $totalServices = Service::where('is_active', true)->count();

        return [
            Stat::make('Total de Produtos', $totalProducts)
                ->description($activeProducts . ' activos')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('primary'),
                
            Stat::make('Produtos em Destaque', $featuredProducts)
                ->description('Na página inicial')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
                
            Stat::make('Stock Total', number_format($totalStock, 0, ',', '.'))
                ->description('Unidades em armazém')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),
                
            Stat::make('Stock Baixo', $lowStockCount)
                ->description('Precisam reposição')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($lowStockCount > 0 ? 'warning' : 'success'),
                
            Stat::make('Sem Stock', $outOfStockCount)
                ->description('Esgotados')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color($outOfStockCount > 0 ? 'danger' : 'success'),
                
            Stat::make('Fornecedores', $totalSuppliers)
                ->description($consignmentSuppliers . ' em consignação')
                ->descriptionIcon('heroicon-m-truck')
                ->color('info'),
                
            Stat::make('Serviços', $totalServices)
                ->description('Activos')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('primary'),
        ];
    }
}