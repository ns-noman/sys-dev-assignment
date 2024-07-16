@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Barcode Manage</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Barcode Manage</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Form</h3>
                            </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-5">
                                            <label>Product Code</label>
                                            <input type="text" class="form-control" name="productCode" id="productCode" placeholder="Product Code">
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label>Number of row</label>
                                            <input type="number" class="form-control" value="1" name="numRow" id="numRow" placeholder="Number of row">
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label>Number of col</label>
                                            <input type="number" class="form-control" value="5" name="numCol" id="numCol" placeholder="Number of col">
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label>Display Value</label><br>
                                            <input type="checkbox" id="displayValue" name="displayValue">
                                        </div>
                                        <div class="form-group col-lg-1" style="margin-top: 32px;">
                                            <button type="button" class="btn btn-primary btn-add">Print</button>
                                        </div>
                                    </div>
                                    <div id="barcodeDisplay">
                                        <svg class="barcode"></svg>
                                    </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/barcodes/JsBarcode.code128.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">
    $('#productCode, #numCol, #numRow, #displayValue').on('keyup chanage input', function(){
        productCode = $('#productCode').val();
        displayValue = $('#displayValue').is(":checked");
        numCol = $('#numCol').val();
        numRow = $('#numRow').val();
        

        var barcode = '';
        for(let i = 0; i<numRow; i++){
            barcode += '<div class="row">';
            for(let j = 0; j<numCol; j++) barcode += '<svg class="barcode"></svg>';
            barcode += '</div>';
        }

        $('#barcodeDisplay').html(barcode);

        JsBarcode(".barcode", productCode, {
            // format: "upc",
            // lineColor: "#0aa",
            width: 1,
            height: 30,
            displayValue: displayValue
        });

    });
    $('.btn-add').click(function(){
        w=window.open();
        w.document.write($('#barcodeDisplay').html());
        w.print();
        w.close();
    });

</script>
@endsection
