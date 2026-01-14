<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductSearch extends Component
{
    #[Url]
    public string $search = '';

    #[Url]
    public array $brands = [];

    #[Url]
    public array $categories = [];

    public function clearFilters(): void
    {
        $this->reset(['search', 'brands', 'categories']);
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn ($q) =>
                $q->where('name', 'like', "%{$this->search}%")
            )
            ->when($this->brands, fn ($q) =>
                $q->whereIn('brand_id', $this->brands)
            )
            ->when($this->categories, fn ($q) =>
                $q->whereIn('category_id', $this->categories)
            )
            ->with(['brand', 'category'])
            ->orderBy('name')
            ->get();

        return view('livewire.product-search', [
            'products' => $products,
            'brandsList' => Brand::all(),
            'categoriesList' => Category::all(),
        ]);
    }
}
