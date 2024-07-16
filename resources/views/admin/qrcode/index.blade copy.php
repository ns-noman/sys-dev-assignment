<style>
    #qrcode-container {
        display: none;
    }

    .qrcode {
        padding: 16px;
    }

    .qrcode img {
        margin: 0 auto;
    }
</style>
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
                                            placeholder="Text-1"/>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Text-2</label>
                                        <input type="url" class="form-control" id="textFieldTwo" name="textFieldTwo"
                                            placeholder="Text-2"/>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Text-3</label>
                                        <input type="url" class="form-control" id="textFieldThree" name="textFieldThree"
                                            placeholder="Text-3"/>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Total Row</label>
                                        <input type="number" class="form-control" id="textFieldTwo" name="textFieldTwo"
                                            placeholder="Total Row"/>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" id="Quantity" name="Quantity"
                                            placeholder="Quantity"/>
                                    </div>
                                    <div class="form-group col-lg-4" style="margin-top: 32px;">
                                        <div class="row">
                                            <div class="col-8">
                                                <button type="button" class="btn btn-primary" onclick="generateQRCode()">Generate QR Code</button>
                                            </div>
                                            <div class="col-4">
                                                <button type="button" class="btn btn-primary btn-add">Print</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="qrcode-container">
                                    <div id="qrcode" class="qrcode">

                                    </div>
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
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script type="text/javascript">
        function generateQRCode() {
            let textFieldOne = $("#textFieldOne").val();
            let textFieldTwo = $("#textFieldTwo").val();
            let textFieldThree = $("#textFieldThree").val();
            let comText = textFieldOne + ', ' + textFieldTwo + ', ' + textFieldThree;

            if (textFieldOne || textFieldThree || textFieldThree) {

                let qrcodeContainer = document.getElementById("qrcode");
                qrcodeContainer.innerHTML = "";
                
                
                for (let index = 0; index < 10; index++) {
                    // new QRCode(qrcodeContainer, comText);
                    new QRCode(qrcodeContainer, {
                        text: comText,
                        width: 60,
                        height: 60,
                    });
                }

                var element = document.getElementById("qrcode-container");
                var parent = element.parentNode;
                var wrapper = document.createElement('div');
                parent.replaceChild(wrapper, element);
                wrapper.appendChild(element);
                document.getElementById("qrcode-container").style.display = "block";

                $('#qrcode img').addClass("m-4");
                
            } else {
                alert("Please enter a valid URL");
            }
        }
        $('.btn-add').click(function(){
            console.log($('#qrcode-container').html());
            w=window.open();
            w.document.write($('#qrcode-container').html());
            w.print();
            w.close();
        });
    </script>
@endsection
