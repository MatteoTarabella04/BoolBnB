@extends('layouts.app')

@section('javascript')
    <script src="https://js.braintreegateway.com/web/dropin/1.38.1/js/dropin.min.js"></script>

    <script>
        const price = document.getElementById("amount").value;


        const form = document.getElementById("payment_form");
        const client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
        }, function(createErr, instance) {
            if (createErr) {
                console.log("Create Error", createErr);
                return;
            }
            form.addEventListener("submit", (e) => {
                e.preventDefault();

                if (price != document.getElementById('amount').value) {
                    document.getElementById('amount_error').classList.remove('d-none');
                } else {
                    document.getElementById('amount_error').classList.add('d-none');
                    instance.requestPaymentMethod((err, payload) => {
                        if (err) {
                            console.log("Request Payment Method Error", err);
                            return;
                        }

                        document.querySelector("#payment_method_nonce").value = payload.nonce;
                        form.submit();
                    })
                }
                /* aggiunto d-none al bottone di acquisto dopo essere stato cliccato */
                document.getElementById('buy_btn').classList.add('d-none');
            })
        })
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="bg_double_show body_minus_header_block"></div>

        <div class="alert alert-danger d-none" role="alert" id="amount_error">
            <strong>Errore di pagamento</strong>
            Importo incongruente col prezzo della sponsorizzazione
        </div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="payment_form" action="{{ route('admin.checkout', [$apartment, $sponsorization_plan]) }}" method="post">
            @csrf
            <input type="hidden" name="amount" id="amount" value="{{ $sponsorization_plan->price }}">
            <div class="position-relative transaction_wrapper">
                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
                <input type="hidden" id="payment_method_nonce" name="payment_method_nonce">

                <div class="text-center">
                    <button type="submit" id="buy_btn"
                        class="btn mb-3 btn-outline-success btn_absolute">Acquista</button>
                </div>
            </div>
        </form>

        <div class="card summary m-auto rounded-2">
            <div class="card-body text-center">
                <h3>
                    {{ $sponsorization_plan->name }}
                </h3>

                <h3>
                    {{ $sponsorization_plan->duration }} ore
                </h3>

                <hr>

                <h2>
                    {{ $sponsorization_plan->price }} €
                </h2>
            </div>
        </div>

    </div>
@endsection
