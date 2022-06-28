<div class="container">
    <div class="row">
        <div class="span4">
            {{-- <img src="../assets/images/logo/logo.png"
                class="img-rounded logo"> --}}
            <address>
                <strong>{{ $providerName }}</strong><br>

                {{ $providerPhone }}
                <br>
                {{ $providerEmail }}
            </address>
        </div>
        <div class="span4 well">
            <table class="invoice-head">
                <tbody>
                    <tr>
                        <td class="pull-right"><strong>Numero Factura</strong></td>
                        <td>{{ $invoiceNumber }}</td>
                    </tr>
                    <tr>
                        <td class="pull-right"><strong>Fecha Factura</strong></td>
                        <td>{{ $date }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="span8">
            <h2>Factura de Compra</h2>
        </div>
    </div>
    <div class="row">
        <div class="span8 well invoice-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align:center;">Nombre</th>
                        <th style="text-align:center;">Precio</th>
                        <th style="text-align:center;">Cantidad</th>
                        <th style="text-align:center;" colspan="2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shoppingDetails as $item)
                        <tr>
                            <td style="text-align:center;">{{ $item->productsName->name }}</td>
                            <td style="text-align:center;">$ <?php echo number_format($item->price, 0, ',', '.'); ?></td>
                            <td style="text-align:center;">{{ $item->quantity }}</td>
                            <td style="text-align:center;">$ <?php echo number_format($item->total, 0, ',', '.'); ?></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"></td>
                    </tr>
                    <tr class="text-center">
                        <td style="text-align:center;" colspan="2" rowspan="3">{{ $note }}</td>
                        <td style="text-align:center;"><strong>Sub Total</strong></td>
                        <td style="text-align:center;"><strong>$ <?php echo number_format($Subtotal, 0, ',', '.'); ?></strong></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"><strong>Impuesto:</strong></td>
                        <td style="text-align:center;"><strong>{{ $nameTaxe }} -- {{ $taxRate }}</strong></td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"><strong>Total</strong></td>
                        <td style="text-align:center;"><strong>$ <?php echo number_format($total, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="span8 well invoice-body">
            <h5 style="text-align:center;">Gracias!</h5>
        </div>
    </div>
    <div class="row">
        <div class="span3">
            <strong>Phone:</strong>+91-124-111111
        </div>
        <div class="span3">
            <strong>Email:</strong> <a href="info@credihogar.com.co" target="_blank" >info@credihogar.com.co</a>
        </div>
        <div class="span3">
            <strong>Website:</strong> <a href="http://credihogar.com.co" target="_blank" >credihogar.com.co</a>
        </div>
    </div>
</div>
