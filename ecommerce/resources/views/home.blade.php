<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Main Content -->
    <div class="container mt-5 mb-4">
        <div class="row">
            @foreach ($products as $item)
                <div class="col-md-3 mb-4 d-flex">
                    <x-product-card :title="$item->name"
                        :description="$item->description"
                        :image="$item->image" 
                        :slug="$item->slug"
                    />
                </div>
            @endforeach
            <div class="col-12 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</x-layout>