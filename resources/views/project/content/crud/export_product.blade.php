<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Category ID</th>
            <th>Supplier ID</th>
            <th>Name</th>
            <th>SKU</th>
            <th>Description</th>
            <th>Purchase Price</th>
            <th>Selling Price</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->category->name }}</td>
            <td>{{ $product->supplier->name }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->sku }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->purchase_price }}</td>
            <td>{{ $product->selling_price }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
