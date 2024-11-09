    @extends('adminlte::page')

    @section('title', 'Pagamento')

    @section('content_header')
        <h1>Pagamento</h1>
    @stop

    @section('content')
        <div class="container">
            <form action="{{ route('payments.store', $sale->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                    <input type="hidden" name="amount" id="amount" value="{{ $total }}">
                    <label for="payment_method">Escolha o Método de Pagamento:</label>
                    <select class="form-control" name="payment_method" id="payment_method" required>
                        <option value="">Selecione a forma de pagamento</option>
                        <option value="avista">À Vista</option>
                        <option value="parcelado">Parcelado</option>
                    </select>
                </div>

                <div id="avista_section" style="display: none;">
                    <div class="form-group">
                    </div>
                </div>

                <div id="parcelado_section" style="display: none;">
                    <div class="form-group">
                        <label for="installments">Número de Parcelas:</label>
                        <input type="number" class="form-control" name="installments" id="installments">
                    </div>

                    <div id="parcelas_container"></div>
                </div>
                <p>
                    Total a Pagar:<strong> {{ number_format($total, 2, ',', '.') }} R$</strong>
                </p>
                <x-adminlte-button class="btn-flat" type="submit" label="Confirmar Pagamento" theme="success" icon="fas fa-lg fa-credit-card" />
            </form>
        </div>
    @stop

    @section('js')
        <script>
            document.getElementById('payment_method').addEventListener('change', function() {
                var method = this.value;
                document.getElementById('avista_section').style.display = method === 'avista' ? 'block' : 'none';
                document.getElementById('parcelado_section').style.display = method === 'parcelado' ? 'block' : 'none';
            });

            document.getElementById('installments').addEventListener('input', function() {
                var total = {{ $total }};
                var numInstallments = parseInt(this.value) || 0;
                var parcelasContainer = document.getElementById('parcelas_container');
                parcelasContainer.innerHTML = '';

                if (numInstallments > 0) {
                    var installmentValue = (total / numInstallments).toFixed(2);

                    for (var i = 1; i <= numInstallments; i++) {
                        var div = document.createElement('div');
                        div.classList.add('form-group');
                        div.innerHTML = `<label>Parcela ${i}:</label>
                            <input type="number" name="installment_values[]" class="form-control installment-input"
                            step="0.01" value="${installmentValue}" required>`;
                        parcelasContainer.appendChild(div);
                    }

                    adjustLastInstallment(total);
                }
            });

            function adjustLastInstallment(total) {
                var installmentInputs = document.querySelectorAll('.installment-input');
                var numInstallments = installmentInputs.length;

                if (numInstallments > 1) {
                    var sum = 0;
                    for (var i = 0; i < numInstallments - 1; i++) {
                        sum += parseFloat(installmentInputs[i].value) || 0;
                    }

                    var lastInstallment = (total - sum).toFixed(2);
                    installmentInputs[numInstallments - 1].value = lastInstallment;
                }

                installmentInputs.forEach((input, index) => {
                    if (index < numInstallments - 1) {
                        input.addEventListener('input', function() {
                            adjustLastInstallment(total);
                        });
                    }
                });
            }
        </script>
    @stop
