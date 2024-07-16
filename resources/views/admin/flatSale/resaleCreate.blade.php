@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-1">
                <div class="card-title">
                    <h4 class="p-3">Create Flat Sales</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form id='formID' action="{{ url('flatSales') }}" method="POST" enctype="multipart/form-data">
                            @csrf()
                            <div class="row">
                                <input type="hidden" name="oldSaleID" id="oldSaleID" value="{{ $FlatSale->id }}">
                                <div class="form-group col-6">
                                    <label>Client Name</label>
                                    <select class="form-control" required name="clientID" id="clientID">
                                        <option value="">Select Client</option>
                                        @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Project Name</label>
                                    <select class="form-control" name="projectID" id="projectID" required>
                                        <option value="{{ $projects->id }}">{{ $projects->name }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Flat Name</label>
                                    <select class="form-control" name="flatID" id="flatID" required>
                                        <option value="{{ $flats->id }}" selected>{{ $flats->flatName }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Previous Client Paid Total</label>
                                    <input readonly value="{{ $prevClientTotalPaid }}" type="number" class="form-control" required name="prevClientTotalPaid" id="prevClientTotalPaid" placeholder="0.00">
                                </div>
                                <div class="form-group col-6">
                                    <label>Previous Saling Price</label>
                                    <input readonly type="number" value="{{ $FlatSale->totalPrice }}" class="form-control" required id="prevSalePrice" placeholder="0.00">
                                </div>
                                <div class="form-group col-6">
                                    <label>New Sale Price</label>
                                    <input type="number" class="form-control" required name="flatPrice" id="flatPrice" placeholder="0.00">
                                </div>
                                <div class="form-group col-6">
                                    <label>Booking Amount</label>
                                    <input type="number" class="form-control" required name="bookingAmount" 
                                    id="bookingAmount" placeholder="Booking Amount">
                                </div>
                                <div class="form-group col-6">
                                    <label>Total Installment Amount</label>
                                    <input readonly type="number" class="form-control" required name="totalInstallment" id="totalInstallment" placeholder="0.00">
                                </div>
                                <div class="form-group col-6">
                                    <label>Number Of Installment</label>
                                    <input type="number" class="form-control" required name="numOfinstallment" id="numOfinstallment" placeholder="0.00">
                                </div>
                                <div class="form-group col-6">
                                    <label>Per Installment Amount</label>
                                    <input readonly type="text" class="form-control" required name="perinstallmentamount" id="perinstallmentamount" placeholder="0.00">
                                </div>
                                <div class="form-group col-6">
                                    <label>Images</label>
                                    <input type="file" class="form-control" id="image" name="images[]" multiple>
                                </div>
                                <div class="form-group col-6">
                                    <label>Note</label>
                                    <input type="text" class="form-control" name="note" placeholder="Note">
                                </div>
                                <div class="form-group col-6">
                                    <label>Contract Date</label>
                                    <input type="date" class="form-control" required name="contractDate" onfocus="this.showPicker()" id="contractDate">
                                </div>
                                <div class="form-group col-6">
                                    <label>Installment Starting Date</label>
                                    <input type="date" class="form-control" required name="insStartingDate" onfocus="this.showPicker()" id="insStartingDate">
                                </div>
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-outline-primary ml-2 mt-3">SUBMIT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

    $("#image").change(
        function()
        {
            $("#contractDate").focus();
            $("#contractDate").showPicker();
        }
    );
    
    $("#contractDate").change(
        function()
        {
            $("#insStartingDate").focus();
        }
    );

    $("#flatPrice, #bookingAmount, #numOfinstallment, #numOfinstallment").keyup(function(){
        var flatPrice = $('#flatPrice').val();
        var bookingAmount = $("#bookingAmount").val();
        var numOfIns = $("#numOfinstallment").val();
        var totalInstallment = flatPrice-bookingAmount;
        var perIns = Math.ceil((totalInstallment/numOfIns)=='Infinity'?0:(totalInstallment/numOfIns));
        $("#totalInstallment").val(totalInstallment);
        $('#perinstallmentamount').val(perIns);
    });
</script>
@endsection