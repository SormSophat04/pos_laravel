@foreach ($products as $product)
<tr>
    <td>{{ $product->id }}</td>
    <td>{{ $product->name }}</td>
    <td>$ {{ $product->price }}</td>
    <td>{{ $product->qty }}</td>
    <td>{{ $product->category }}</td>
    <td><img src="{{ asset($product->image) }}" width="60px" /></td>
    <td class="justify-content-center text-center d-flex gap-2">
        <form action="{{ route('product.showup', $product->id) }}" method="get">
            @csrf
            <button type="submit" class="btn btn-success updatePro"><i class="bi bi-pencil-square"></i></button>
        </form>
        <form action="{{ route('product.destroy', $product->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
        </form>
    </td>
</tr>
@endforeach
