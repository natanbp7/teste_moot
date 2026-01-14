<div class="bg-white rounded-xl shadow p-6">

    <h1 class="text-2xl font-semibold mb-6">
        Busca de Produtos
    </h1>

    <!-- Search -->
    <div class="mb-6">
        <input
            type="text"
            wire:model.live.debounce.300ms="search"
            placeholder="Buscar produto..."
            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-blue-200"
        />
    </div>

    <!-- Filters -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        <!-- Categories -->
        <div>
            <h2 class="font-semibold mb-2">Categorias</h2>
            <div class="space-y-1">
                @foreach ($categoriesList as $category)
                    <label class="flex items-center gap-2 text-sm">
                        <input
                            type="checkbox"
                            wire:model.live="categories"
                            value="{{ $category->id }}"
                            class="rounded border-gray-300"
                        />
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Brands -->
        <div>
            <h2 class="font-semibold mb-2">Marcas</h2>
            <div class="space-y-1">
                @foreach ($brandsList as $brand)
                    <label class="flex items-center gap-2 text-sm">
                        <input
                            type="checkbox"
                            wire:model.live="brands"
                            value="{{ $brand->id }}"
                            class="rounded border-gray-300"
                        />
                        {{ $brand->name }}
                    </label>
                @endforeach
            </div>
        </div>

    </div>

    <!-- Actions -->
    <div class="mb-6">
        <button
            type="button"
            wire:click="clearFilters"
            class="text-sm px-4 py-2 border rounded-lg hover:bg-gray-100"
        >
            Limpar filtros
        </button>
    </div>

    <!-- Results -->
    <div class="border-t pt-4 space-y-2">
        @forelse ($products as $product)
            <div class="flex justify-between text-sm">
                <span class="font-medium">{{ $product->name }}</span>
                <span class="text-gray-500">
                    {{ $product->brand->name }} · {{ $product->category->name }}
                </span>
            </div>
        @empty
            <div class="text-sm text-gray-500">
                Nenhum produto encontrado
            </div>
        @endforelse
    </div>

</div>
