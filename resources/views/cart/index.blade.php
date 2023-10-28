@extends('layouts.app')

@section("content")
    <div class="container mt-5">
        <div class="card p-6 mb-6">
            <div class="row">
                <div class="col-12 col-md-12" style="text-align: center">
                    <section class="h-100">
                        <div class="container h-100 py-2">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-10">

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h3 class="fw-normal mb-0 text-black">Carrito</h3>

                                    </div>

                                    @foreach($cartItems as $item)
                                        <div class="card rounded-3 mb-2 item_cart" id="item_cart_{{$item->id}}"
                                             data-item_id="{{$item->id}}">
                                            <div class="card-body p-4">
                                                <div class="row d-flex justify-content-between align-items-center">
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                        <img style="height:15vh"
                                                             src="{{$item->product->image}}"
                                                             class="img-fluid rounded-3" alt="Cotton T-shirt">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                                        <p class="lead fw-normal mb-2">{{$item->product->name}}</p>
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                        <button class="btn btn-link px-2 btnDown"
                                                                data-item_cart_id="{{$item->id}}"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                            <i class="fas fa-minus"></i>
                                                        </button>

                                                        <input id="input_quantity_{{$item->id}}"
                                                               data-item_cart_id="{{$item->id}}" min="1" name="quantity"
                                                               value="{{$item->quantity}}" type="number"
                                                               class="form-control form-control-sm input_cuantity"/>

                                                        <button class="btn btn-link px-2 btnUp"
                                                                data-item_cart_id="{{$item->id}}"
                                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 ">
                                                        <h5 class="mb-0">
                                                            <span
                                                                id="unit_price_item_{{$item->id}}">{{number_format($item->product->price,2,'.',',')}}</span>

                                                            €/u</h5>
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 col-xl-2 ">
                                                        <h5 class="mb-0">
                                                            <span
                                                                id="total_price_item_{{$item->id}}">{{number_format($item->product->price*$item->quantity,2,'.',',')}}</span>
                                                            €</h5>
                                                    </div>
                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                        <a href="#!" class="text-danger deleteItem"
                                                           data-item_cart_id="{{$item->id}}"><i
                                                                class="fas fa-trash fa-lg"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="card">
                                        <div class="card-body">
                                            <button type="button" id="reload_cart"
                                                    class="btn btn-success btn-block btn-md">Actualizar carrito
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <button type="button" class="btn btn-warning btn-block btn-lg">Pagar
                                                <span id="total_pay">({{number_format( \App\Helpers\CartHelper::getTotalAmount(),2,',','.')}}
                                                    €)</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>

        $('.input_cuantity').change((e) => {
            var quantity = parseFloat(e.currentTarget.value);

            var unit_price = $('#unit_price_item_' + e.currentTarget.dataset.item_cart_id)[0].textContent;
            console.log(unit_price * quantity)
            var total_item = parseFloat(quantity * unit_price)
            $('#total_price_item_' + e.currentTarget.dataset.item_cart_id)[0].textContent = total_item.toFixed(2);

        })
        $('.btnDown, .btnUp').click((e) => {
            console.log('click +-')
            var input_quantity = document.getElementById('input_quantity_' + e.currentTarget.dataset.item_cart_id);
            var quantity = parseFloat(input_quantity.value);
            var unit_price = parseFloat($('#unit_price_item_' + e.currentTarget.dataset.item_cart_id)[0].textContent);
            console.log(unit_price * quantity)
            var total_item = parseFloat(quantity * unit_price)
            $('#total_price_item_' + e.currentTarget.dataset.item_cart_id)[0].textContent = total_item.toFixed(2);

        })
        $('.deleteItem').click((e) => {
            var cart_id = e.currentTarget.dataset.item_cart_id;
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                url: "{{route('destroy.item.cart')}}",
                data: {
                    item_cart_id: cart_id
                },
                success: function (data) {
                    toastr.success(data.message);
                    $('#item_cart_' + cart_id).remove();
                    $('#count_items_cart')[0].textContent = parseInt(data.countItems)
                    $('#total_pay').text(`(${data.totalAmount.toFixed(2)}€)`);
                }
            });
        })
        $('#reload_cart').click(() => {
            var data_array = [];
            $('.item_cart').each((index) => {
                var item_id = $('.item_cart')[index].dataset.item_id;
                var intput_quantity = $('#input_quantity_' + item_id)[0].value;
                data_array.push({"id": item_id, "quantity": intput_quantity})

            })
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                url: "{{route('reload.cart')}}",
                data: {
                    data: data_array
                },
                success: function (data) {
                    toastr.success(data.message);
                    $('#count_items_cart')[0].textContent = parseInt(data.countItems)
                    $('#total_pay').text(`(${data.totalAmount.toFixed(2)}€)`);

                }
            });
        })
    </script>
@endsection
