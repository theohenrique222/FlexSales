<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Venda Nº {{ $sale->id }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px;
            color: #333;
            background-color: #fff;
        }

        h1,
        h3 {
            margin-bottom: 5px;
        }

        h1 {
            font-size: 2rem
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            background-color: #1c63ae;
            color: white;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 1.1rem;
            text-align: center
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            border-radius: 6px;
            overflow: hidden;
        }

        th {
            background-color: #f0f4f8;
            text-align: left;
            padding: 12px;
            font-size: 14px;
        }

        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 13px;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .info-table {
            margin-top: 5px;
        }

        .info-table td {
            padding: 6px 0;
        }

        .highlight {
            font-weight: bold;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <h1>Venda Nº {{ $sale->id }}</h1>

    <div class="section">
        <div class="section-title">Informações Gerais</div>
        <table class="info-table">
            <tr>
                <td><span class="highlight">Cliente:</span> {{ $sale->client->name }}</td>
                <td><span class="highlight">Vendedor:</span> {{ $sale->seller->user->name }}</td>
                <td><span class="highlight">Data:</span> {{ $sale->created_at->format('d/m/Y | H:i:s') }}</td>

            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Produtos</div>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor Unitário</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($product->price * $product->pivot->quantity, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Pagamento</div>
        <table class="info-table">
            <tr>
                <td>
                    <span class="highlight">Forma de pagamento:</span>
                    {{ strtolower($sale->payments->payment_method ?? '') === 'avista' ? 'À Vista' : $sale->payments->payment_method ?? 'N/A' }}
                </td>
                @if (($sale->payments->installments ?? 0) > 0)
                    <td>
                        <span class="highlight">Parcelas:</span>
                        {{ $sale->payments->installments . 'x' }}
                    </td>
                @endif
            </tr>
            <tr>
                <td colspan="2" class="total">
                    Total: R$ {{ number_format($sale->payments->amount ?? 0, 2, ',', '.') }}
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
