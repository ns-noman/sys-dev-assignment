@extends('layouts.master')
@section('content')
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
                                    <div class="form-group col-lg-4">
                                        <label>Text-1</label>
                                        <input type="url" class="form-control" id="textFieldOne" name="textFieldOne"
                                            placeholder="Text-1" />
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Text-2</label>
                                        <input type="url" class="form-control" id="textFieldTwo" name="textFieldTwo"
                                            placeholder="Text-2" />
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Text-3</label>
                                        <input type="url" class="form-control" id="textFieldThree" name="textFieldThree"
                                            placeholder="Text-3" />
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Total Row</label>
                                        <input type="number" value="2" class="form-control" id="numRow" name="numRow"
                                            placeholder="0.00" />
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Quantity</label>
                                        <input type="number" value="20" class="form-control" id="quantity" name="quantity"
                                            placeholder="0.00" />
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Height</label>
                                        <input type="number" value="70" class="form-control" id="height" name="height"
                                            placeholder="0.00" />
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label>Width</label>
                                        <input type="number" value="70" class="form-control" id="width" name="width"
                                            placeholder="0.00" />
                                    </div>
                                    <div class="form-group col-lg-4" style="margin-top: 32px;">
                                        <button type="button" class="btn btn-primary btn-add">Print</button>
                                    </div>
                                </div>
                                <div id="qrcodeDisplay">
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function htmlEncode(value) {
            return $('<div/>').text(value).html();
        }

        productCode = $('#productCode').val();
        
        displayValue = $('#displayValue').is(":checked");
        var numCol = Math.ceil(quantity / numRow);

        $("#textFieldOne, #textFieldTwo, #textFieldThree, #quantity, #numRow, #displayValue, #height, #width").on('keyup chanage input',function() {
            let textFieldOne = $("#textFieldOne").val();
            let textFieldTwo = $("#textFieldTwo").val();
            let textFieldThree = $("#textFieldThree").val();
            let height = $("#height").val() ? $("#height").val() : 70;
            let width = $("#width").val() ? $("#width").val() : 70;
            let comText = textFieldOne + ', ' + textFieldTwo + ', ' + textFieldThree;
            let quantity = $('#quantity').val();
            let numRow = $('#numRow').val();
            let numCol = Math.ceil(quantity / numRow);

            var qrcode = '';
            for(let i = 0; i<numRow; i++){
                qrcode += '<div class="row">';
                for(let j = 0; j<numCol; j++){
                    if(quantity==0){
                        break;
                    }
                    qrcode += '<img src="" class="qr-code img-thumbnail img-responsive" style="max-width: 200px; margin: 10px;">';
                    quantity--;
                }
                qrcode += '</div>';
            }
            $('#qrcodeDisplay').html(qrcode);
            $("img").attr("src", "https://api.qrserver.com/v1/create-qr-code/?data=" + data + "&size="+width+"x"+height);
            console.log($('#qrcodeDisplay').html());
        });

        $('.btn-add').click(function() {
            console.log($('#qrcodeDisplay').html());
            w = window.open();
            w.document.write("<div>" + $('#qrcodeDisplay').html() + "</div>");
            w.print();
            w.close();
        });
    </script>
@endsection
