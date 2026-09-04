<x-layout>
    <x-slot:title title="Products">{{ $title }}</x-slot:title>
    <!-- Main Content -->
    <div class="container my-4">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->name }}">
            </div>
            <div class="col-md-9">
                <h1>{{ $product->name }}</h1>
                <p>{{ $product->description }}</p>
                <p>Price: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <p>Category: {{ $product->productCategory->name }}</p>
                <p>Stock: {{ $product->stock }}</p>
                <form action="{{ route('carts.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    {{-- Quantity input --}}
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}" {{ $in_stock ? '' : 'disabled' }}>
                    </div>
                    <button type="submit" class="btn {{ $in_stock ? 'btn-primary' : 'btn-secondary' }}" {{ $in_stock ? '' : 'disabled' }}>
                        {{ $in_stock ? 'Add to Cart' : 'Out of Stock' }}
                    </button>
                </form>
            </div>
            <div class="col-12 mt-4">
                <h3>Product recommendations</h3>
                <div class="row">
                    @foreach ($productRecommendations as $relatedProduct)
                        <div class="col-md-3 mb-4 d-flex">
                            <x-product-card
                                :title="$relatedProduct->name"
                                :description="$relatedProduct->description"
                                :image="$relatedProduct->image"
                                :slug="$relatedProduct->slug"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>