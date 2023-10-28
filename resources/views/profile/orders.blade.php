@extends('layouts.app')

@section("content")
    <div class="container mt-5">
        <div class="card p-6 mb-6">
            <div class="row">
                <div class="col-12 col-md-12" style="text-align: center">
                        <h1>Mis pedidos</h1>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Total</th>
                                <th scope="col">Fecha de pedido</th>
                                <th scope="col">Pagado</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                                <td>@twitter</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
