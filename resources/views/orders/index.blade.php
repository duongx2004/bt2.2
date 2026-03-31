<h2>Tạo đơn</h2>

<form method="POST" action="/orders">
    @csrf
    <input name="customer_name" placeholder="Tên khách">
    <button>Tạo</button>
</form>

<hr>

@foreach($orders as $order)

<h3>{{ $order->customer_name }}</h3>

<form method="POST" action="/orders/add-item">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">

    <select name="product_id">
        @foreach($products as $p)
            <option value="{{ $p->id }}">
                {{ $p->name }} - {{ $p->price }}
            </option>
        @endforeach
    </select>

    <input type="number" name="quantity" value="1">
    <button>Thêm</button>
</form>

<table border="1">
<tr>
    <th>Sản phẩm</th>
    <th>Số lượng</th>
    <th>Giá</th>
    <th>Thành tiền</th>
    <th>Xóa</th>
</tr>

@php $total = 0; @endphp

@foreach($order->items as $item)
@php 
    $money = $item->quantity * $item->product->price;
    $total += $money;
@endphp

<tr>
    <td>{{ $item->product->name }}</td>
    <td>{{ $item->quantity }}</td>
    <td>{{ $item->product->price }}</td>
    <td>{{ $money }}</td>

    <td>
        <form method="POST" action="/orders/item/{{ $item->id }}">
            @csrf
            @method('DELETE')
            <button>Xóa</button>
        </form>
    </td>
</tr>
@endforeach

<tr>
    <td colspan="3">Tổng</td>
    <td>{{ $total }}</td>
</tr>

</table>

<hr>

@endforeach