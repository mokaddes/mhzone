@extends('front.layouts.master')
@section('title', __('Invoice'))
@push('css')
    <style>
        #print-btn {
            display: block;
            width: 120px;
            margin: 20px auto;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .invoice-container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            border: 1px solid #EEE;
        }

        .seller-info,
        .buyer-info {
            float: left;
            width: 45%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 20px;
            text-align: center;
        }

        .seller-info {
            background-color: #f1f1f1;
            margin-right: 5%;
        }

        .buyer-info {
            background-color: #f1f1f1;
            float: right !important;
        }

        .seller-info p,
        .buyer-info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-container h1 {
            font-size: 16px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        thead th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        tfoot {
            font-weight: bold;
        }

        tfoot td {
            text-align: right;
        }

        footer {
            text-align: right;
            margin-top: 20px;
            color: #666;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            display: block !important;
            width: 100%;
        }

        /*@media print {*/
        /*    .page-break {*/
        /*        page-break-before: always;*/
        /*    }*/
        /*}*/

        @media screen and (max-width:767px) {

            .seller-info,
            .buyer-info {
                width: 100%;
            }
        }

        .seller-info h2 {
            font-size: 18px;
        }

        .seller-info p {
            font-size: 14px;
        }

        .buyer-info h2 {
            font-size: 18px;
        }

        .buyer-info p {
            font-size: 14px;
        }

        thead th {
            font-size: 13px;
            font-weight: 700;
        }

        tfoot td {
            font-size: 13px;
            font-weight: 700;
        }
    </style>
@endpush
@section('content')

    <!-- ============================== Invoice ================================== -->
    <div class="invoice-container mt-5" id="printableArea">
        <div class="">
            <div class="card-header">
                <header>
                    <div>
                        <h1>Invoice #{{ $order->order_number }}</h1>
                    </div>
                </header>
            </div>
            <div class="card-body">
                @foreach ($orderDetails as $seller_id => $itemGroup)
                    <div class="seller_div {{ $loop->last ? 'mt-5' : '' }} {{ $loop->first ? '' : 'page-break' }}">
                        <div class="seller-info">
                            <h2>Seller Information</h2>
                            <p>Seller Name: {{ $itemGroup->seller->name }}</p>
                            <p>Seller Shop: {{ $itemGroup->seller->userShop->name }}</p>
                            <p>Shop Address: {{ $itemGroup->seller->userShop->location }}</p>
                            <p>Contact: {{ $itemGroup->seller->email }}</p>
                        </div>
                        <div class="buyer-info">
                            <h2>Buyer Information</h2>
                            <p>Buyer Name: {{ $order->buyer->name }}</p>
                            <p>
                                Shipping Address: {{ $order->apartment }} {{ $order->address }}, <br>
                                {{ $order->city }}, {{ $order->state }}-{{ $order->postcode }}
                            </p>
                            <p>Contact: {{ $order->phone ?? $order->buyer->phone }}</p>
                        </div>
                        <div class="custome_table table-responsive">
                            <!-- Order details and items -->
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Attributes</th>
                                        <th>Unit Price(With Attribute)</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($itemGroup as $item)
                                        <tr>
                                            <td>{{ $item->ad->title }}</td>
                                            <td>
                                                @if (isset($item->ad->attrs) && $item->ad->attrs->count() > 0)
                                                    @foreach ($item->ad->attrs as $attr)
                                                        {{ $attr->parent_attr->name }} :
                                                        @foreach (json_decode($attr->attr_details, true) as $name => $price)
                                                            {{ $name }} {{ $loop->last ? '' : ',' }}
                                                        @endforeach
                                                        {!! $loop->last ? '' : '</br>' !!}
                                                    @endforeach
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>${{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="text-end">${{ $item->total_price }}</td>
                                        </tr>
                                    @endforeach
                                    <!-- Add more rows as needed -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">Subtotal</td>
                                        <td>${{ $itemGroup->sum('total_price') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Shipping Charge</td>
                                        <td>${{ seller_shipping($order->shipping_charge, $order->total_seller) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td>
                                            ${{ $itemGroup->sum('total_price') + seller_shipping($order->shipping_charge, $order->total_seller) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Status</td>
                                        <td>{{ $order->transaction->payment_status == 1 ? 'Paid' : 'Unpaid' }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endforeach
                <footer>
                    <p>Thank you for stay with mhzone!</p>
                </footer>
            </div>
        </div>
    </div>
    <button id="print-btn" onclick="printDiv('printableArea')">Print</button>
    <!-- ============================== Invoice ================================== -->
@endsection

@push('js')
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
