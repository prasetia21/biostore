<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style>
        h4 {
            margin: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .margin-top {
            margin-top: 1.25rem;
        }

        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: rgb(241 245 249);
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 0.875rem;
        }

        table.products tr {
            background-color: rgb(96 165 250);
        }

        table.products th {
            color: #ffffff;
            padding: 0.5rem;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding: 0.5rem;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <span style="color: #ffc107;">
                    <h2>BIOVARNISH</h2>
                </span>
                <img src="" alt="Biovarnish Store" width="200" />
            </td>
            <td class="w-half">
                <h2><span style="color: #ffc107;">Invoice:</span> #{{ $order->invoice_no }}</h2>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div>
                        <h4>Detail Pemesan:</h4>
                    </div>
                    <div>{{ $order->name }} </div>
                    <div>{{ $order->email }}</div>
                    <div>{{ $order->phone }}</div>
                    @php
                        $div = $order->province->name;
                        $dis = $order->city->name;
                    @endphp
                    <div>{{ $order->address }} / {{ $div }} / {{ $dis }}</div>
                    <div>{{ $order->post_code }}</div>
                </td>
                <td class="w-half">
                    <div>
                        <h4>Shipping:</h4>
                    </div>
                    <div>{{$orderShip[0]->shipping_service}} / {{ $order->payment_method }}</div>
                    <div>Ongkir: @price($orderShip[0]->shipping_price)</div>
                    <div>Berat: {{$orderShip[0]->weight}} gram</div>
                    <div>Est: {{ $orderShip[0]->shipping_estimation }} Hari</div>
                    <div><br /></div>
                </td>
                <td class="w-half">
                    <div>
                        <h4>Vendor:</h4>
                    </div>
                    <div>Biovarnish Store</div>
                    <div>Yogyakarta</div>
                    <div><br /></div>
                    <div><br /></div>
                    <div><br /></div>
                </td>
            </tr>
        </table>
    </div>

    <div class="margin-top">
        <table class="products">
            <tr>
                <th>Photo</th>
                <th>Nama Produk</th>
                <th>Kemasan</th>
                <th>Warna</th>
                <th>Kode</th>
                <th>Qty</th>
                <th>Vendor</th>
                <th>Total </th>
            </tr>
            <tr class="items">
                @foreach ($orderItem as $item)
                    <td align="center">
                        <img src="{{ public_path($item->product->product_thumbnail) }}" height="50px;" width="50px;"
                            alt="">
                    </td>
                    <td align="center">{{ $item->product->product_name }}</td>

                    @if ($item->size == null)
                        <td align="center"> ...</td>
                    @else
                        <td align="center"> {{ $item->size }}</td>
                    @endif

                    @if ($item->color == null)
                        <td align="center"> ...</td>
                    @else
                        <td align="center"> {{ $item->color }}</td>
                    @endif


                    <td align="center">{{ $item->product->product_code }}</td>
                    <td align="center">{{ $item->qty }}</td>

                    @if ($item->vendor_id == null)
                        <td align="center">Biovarnish</td>
                    @else
                        <td align="center">{{ $item->product->vendor->name }}</td>
                    @endif

                    <td align="center">@price($item->price)</td>
                @endforeach
            </tr>
        </table>
    </div>

    <div class="total">
        <h4><span style="color: #000;">Subtotal:</span>@price($order->amount)</h4>
        <h4><span style="color: #000;">Total:</span> @price($order->amount)</h4>
    </div>

    <div class="footer margin-top">
        <div>Terima Kasih &copy; Biovarnish</div>
    </div>
</body>

</html>
