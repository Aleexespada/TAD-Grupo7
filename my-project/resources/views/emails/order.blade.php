<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmación de Pedido</title>
</head>

<body>
    <p>Hola {{ $order->user->name }} {{$order->user->last_name}}</p>
    <p>Tu pedido se ha realizado con exito.</p>
    <br />

    <ul>
        <li>Fecha del pedido: {{ $order->created_at }}</li>
        <li>Total del pedido: {{ $order->total_price }} €</li>
        <li>Dirección de envío: {{ $order->address->street }}, {{ $order->address->number }}, {{ $order->address->postal_code }}, {{ $order->address->province }}, {{ $order->address->country }}</li>
        <li>Tarjeta de crédito utilizada: {{ $order->creditCard->cardholder_name }} | {{ $order->creditCard->expiration_month }}/{{ $order->creditCard->expiration_year }} </li>
    </ul>

    <table style="width: 600px; text-align:right">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->product_quantity }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->price * $product->pivot->product_quantity }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" style="border-top:1px solid #ccc;"></td>
                <td style="font-size:15px;font-weight:bold;border-top:1px solid #ccc;">Total: {{ $order->total_price }} €</td>
            </tr>
        </tbody>
    </table>
</body>

</html>