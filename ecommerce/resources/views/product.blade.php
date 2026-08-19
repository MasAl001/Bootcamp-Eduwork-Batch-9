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
                <a href="#" class="btn btn-primary">Add to Cart</a>
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