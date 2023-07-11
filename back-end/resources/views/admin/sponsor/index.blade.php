@extends("layouts.app")

@section("javascript")
<script src="https://js.braintreegateway.com/web/dropin/1.38.1/js/dropin.min.js"></script>

<script>
  const form = document.getElementById("payment_form");
  const client_token = "{{ $token }}";

  braintree.dropin.create({
    authorization: client_token,
    selector: '#bt-dropin',
  }, function (createErr, instance) {
    if(createErr) {
      console.log("Create Error", createErr);
      return;
    }
    form.addEventListener("submit", (e) => {
      e.preventDefault();

      instance.requestPaymentMethod((err, payload) => {
        if(err) {
          console.log("Request Payment Method Error", err);
          return;
        }

        document.querySelector("#payment_method_nonce").value = payload.nonce;
        form.submit();
      })
    })
  })
</script>
@endsection

@section("content")
  @if(session("success_message"))
  <div class="alert alert-success">
    {{ session("success_message") }}
  </div>
  @endif

  @if(count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>
        {{ $error }}
      </li>
      @endforeach
    </ul>
  </div>
  @endif

  <form id="payment_form" action="/admin/checkout" method="post">
    @csrf
    <input type="number" name="amount" id="amount" value="5">
    <div class="bt-drop-in-wrapper">
      <div id="bt-dropin"></div>
    </div>
    <input type="hidden" id="payment_method_nonce" name="payment_method_nonce">
    <button type="submit">Test transaction</button>
  </form>
@endsection
