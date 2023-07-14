@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <div class="bg_double_show body_minus_header_block"></div>

        <h1 class="mb-4">
            Seleziona il piano di sponsorizzazione adatto a te:
        </h1>

        <div class="row row-cols-1 row-cols-lg-3 g-3">
            @foreach ($plans as $plan)
                <div class="col">
                    <a class="text-decoration-none" href="{{ route('admin.payment', [$apartment, $plan]) }}">
                        <div class="card plan border-0 p-3 shadow h-100">
                            <div class="card-body">
                                <h3 class=" text-center ">
                                    {{ $plan->name }}
                                </h3>

                                <hr>

                                <input type="number" name="price" id="price" value="{{ $plan->price }}"
                                    class="d-none">

                                <p>
                                    {{ $plan->notes }}
                                </p>

                                <hr>

                                <h4>
                                    Prezzo: {{ $plan->price }} €
                                </h4>


                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
