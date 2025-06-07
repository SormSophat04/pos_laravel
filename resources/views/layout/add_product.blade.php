@extends('layout.app')

@section('table')
    <section class="lg:w-2/3">
        <div class="bg-white rounded-xl shadow-md p-4 mb-4">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <h2 class="text-2xl font-bold text-blue-500">{{ __('message.product') }}</h2>
                <div class="relative w-full sm:w-80">
                    <input type="text" id="product-search" placeholder="{{ __('message.search_product') }}..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none  focus:ring-indigo-500"
                        oninput="filterTable()" />
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Product Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="max-h-[880px] overflow-y-auto">
                    <table class="w-full table-auto border-collapse" id="product-table">
                        <thead class="bg-blue-50 text-blue-700 sticky top-0 z-10">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-sm">#</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">{{ __('message.name') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">{{ __('message.price') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">{{ __('message.quantity') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">{{ __('message.category') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-sm">{{ __('message.image') }}</th>
                                <th class="px-4 py-3 text-center font-semibold text-sm">{{ __('message.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-4 py-3 text-gray-700">{{ $product->id }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $product->name }}</td>
                                    <td class="px-4 py-3 text-gray-700">$ {{ number_format($product->price, 2) }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $product->qty }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $product->category }}</td>
                                    <td class="px-4 py-3">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                            class=" h-12 object-cover rounded-md shadow-sm" />
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <form action="{{ route('product.showup', $product->id) }}" method="get">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-150"
                                                    title="{{ __('message.edit') }}">
                                                    <svg class="w-4 h-8" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('{{ __('message.confirm_delete') }}')"
                                                    type="submit"
                                                    class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors duration-150"
                                                    title="{{ __('message.delete') }}">
                                                    <svg class="w-4 h-8" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4M3 7h18" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Client-side Search Script -->
            <script>
                function filterTable() {
                    const input = document.getElementById('product-search').value.toLowerCase();
                    const table = document.getElementById('product-table');
                    const rows = table.getElementsByTagName('tr');

                    for (let i = 1; i < rows.length; i++) {
                        const cells = rows[i].getElementsByTagName('td');
                        let match = false;

                        // Search in name and category columns
                        for (let j = 1; j <= 4; j++) {
                            if (cells[j] && cells[j].textContent.toLowerCase().includes(input)) {
                                match = true;
                                break;
                            }
                        }
                        rows[i].style.display = match ? '' : 'none';
                    }
                }
            </script>
        </div>
    </section>
@endsection

@section('product_form')
    <section class="lg:w-1/3">
        <div class="bg-white rounded-xl shadow-md p-4 sticky top-4">
            <!-- Image Preview -->
            <h2 class="text-3xl font-extrabold text-blue-500 mb-6 text-center">Add New Product</h2>

            <!-- Image Preview -->
            <div class="mb-6 flex justify-center">
                <img id="imagePreview" src="" alt="Image Preview"
                    class="w-68 h-48 object-cover rounded-lg border-2 border-gray-200 shadow-sm" style="display: none;" />
            </div>

            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Product Name -->
                <div class="mb-4">
                    <label for="productName" class="block text-sm font-semibold text-blue-700 mb-2">
                        {{ __('message.name') }} {{ __('message.product') }}
                    </label>
                    <input type="text"
                        class="w-full px-4 py-2 border border-blue-300 rounded-lg  focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        name="productName"
                        placeholder="{{ __('message.enter') }} {{ __('message.name') }} {{ __('message.product') }}"
                        required>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="productPrice" class="block text-sm font-semibold text-blue-700 mb-2">
                        {{ __('message.price') }} ($)
                    </label>
                    <input type="number"
                        class="w-full px-4 py-2 border border-blue-300 rounded-lg  focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        name="productPrice" placeholder="{{ __('message.enter') }} {{ __('message.price') }}" required
                        min="0" step="0.01">
                </div>

                <!-- Quantity -->
                <div class="mb-4">
                    <label for="productQty" class="block text-sm font-semibold text-blue-700 mb-2">
                        {{ __('message.quantity') }}
                    </label>
                    <input type="number"
                        class="w-full px-4 py-2 border border-blue-300 rounded-lg  focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        name="productQty" placeholder="{{ __('message.enter') }} {{ __('message.quantity') }}" required
                        min="1">
                </div>

                <!-- Category -->
                <div class="mb-4">
                    <label for="productCategory" class="block text-sm font-semibold text-blue-700 mb-2">
                        {{ __('message.category') }}
                    </label>
                    <select
                        class="w-full px-4 py-2 border border-blue-300 rounded-lg  focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                        name="productCategory" required>
                        <option selected disabled>{{ __('message.select') }} {{ __('message.category') }}</option>
                        <option value="phone">Phone</option>
                        <option value="laptop">Laptop</option>
                        <option value="tablet">Tablet</option>
                        <option value="watch">Watch</option>
                        <option value="headphones">Headphones</option>
                    </select>
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label for="productImage" class="block text-sm font-semibold text-blue-700 mb-2">
                        {{ __('message.image') }} {{ __('message.product') }}
                    </label>
                    <input
                        class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-200"
                        type="file" name="productImage" accept="image/*" onchange="previewImage(event)" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none  focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                        {{ __('message.add_to_cart') }}
                    </button>
                </div>
            </form>
            <script>
                function previewImage(event) {
                    const input = event.target;
                    const preview = document.getElementById('imagePreview');

                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result; // Set the preview image source
                            preview.style.display = 'block'; // Make the image visible
                        }
                        reader.readAsDataURL(input.files[0]); // Read the image file
                    }
                }
            </script>
        </div>
    </section>
@endsection
