<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\ProductSearch;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_products_list()
    {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();

        Product::factory()->create([
            'name' => 'Produto Teste',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);

        Livewire::test(ProductSearch::class)
            ->assertSee('Produto Teste');
    }

    /** @test */
    public function it_filters_products_by_name()
    {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();

        Product::factory()->create([
            'name' => 'Notebook Gamer',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);

        Product::factory()->create([
            'name' => 'Mouse',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);

        Livewire::test(ProductSearch::class)
            ->set('search', 'Notebook')
            ->assertSee('Notebook Gamer')
            ->assertDontSee('Mouse');
    }

    /** @test */
    public function it_filters_products_by_category()
    {
        $brand = Brand::factory()->create();
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create();

        $product = Product::factory()->create([
            'name' => 'Produto Categoria A',
            'brand_id' => $brand->id,
            'category_id' => $categoryA->id,
        ]);

        Product::factory()->create([
            'name' => 'Produto Categoria B',
            'brand_id' => $brand->id,
            'category_id' => $categoryB->id,
        ]);

        Livewire::test(ProductSearch::class)
            ->set('categories', [$categoryA->id])
            ->assertSee($product->name)
            ->assertDontSee('Produto Categoria B');
    }

    /** @test */
    public function it_filters_products_by_brand()
    {
        $brandA = Brand::factory()->create();
        $brandB = Brand::factory()->create();
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'name' => 'Produto Marca A',
            'brand_id' => $brandA->id,
            'category_id' => $category->id,
        ]);

        Product::factory()->create([
            'name' => 'Produto Marca B',
            'brand_id' => $brandB->id,
            'category_id' => $category->id,
        ]);

        Livewire::test(ProductSearch::class)
            ->set('brands', [$brandA->id])
            ->assertSee($product->name)
            ->assertDontSee('Produto Marca B');
    }

    /** @test */
    public function it_filters_products_by_combined_filters()
    {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'name' => 'Produto Combinado',
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);

        Product::factory()->create([
            'name' => 'Outro Produto',
            'brand_id' => Brand::factory()->create()->id,
            'category_id' => Category::factory()->create()->id,
        ]);

        Livewire::test(ProductSearch::class)
            ->set('search', 'Combinado')
            ->set('brands', [$brand->id])
            ->set('categories', [$category->id])
            ->assertSee($product->name)
            ->assertDontSee('Outro Produto');
    }

    /** @test */
    public function it_can_clear_filters()
    {
        Livewire::test(ProductSearch::class)
            ->set('search', 'teste')
            ->set('brands', [999])
            ->set('categories', [999])
            ->call('clearFilters')
            ->assertSet('search', '')
            ->assertSet('brands', [])
            ->assertSet('categories', []);
    }
}
