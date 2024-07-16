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
                                <div class="form-group col-6">
                                    <label>Client Name</label>
                                    <select class="normalize" required name="clientID" id="clientID">
                                        <option value=''>Select Client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Project Name</label>
                                    <select class="normalize" onchange="selproject()" name="projectID" id="projectID" required>
                                        <option value="" selected>Select Project</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Flat Name</label>
                                    <select class="form-control" onchange="selflat()" name="flatID" id="flatID" required>
                                        <option value="" selected>Select Flat</option>
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label>Booking Amount</label>
                                    <input type="number" class="form-control" required name="bookingAmount" 
                                    id="bookingAmount" placeholder="Double Click For Default Booking Amount">
                                </div>
                                <div class="form-group col-6">
                                    <label>Default Booking Amount</label>
                                    <input readonly type="number" class="form-control" required name="bookingAmountDefault" id="bookingAmountDefault" placeholder="0.00">
                                </div>
                                <div class="form-group col-6">
                                    <label>Flat Price</label>
                                    <input type="number" class="form-control" required name="flatPrice" id="flatPrice" placeholder="0.00">
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
                                    <input type="file" class="form-control" required name="images[]" multiple>
                                </div>
                                <div class="form-group col-6">
                                    <label>Contract Date</label>
                                    <input type="date" class="form-control" required name="contractDate" onfocus="this.showPicker()" id="contractDate">
                                </div>
                                <div class="form-group col-6">
                                    <label>Installment Starting Date</label>
                                    <input type="date" class="form-control" required name="insStartingDate" onfocus="this.showPicker()" id="insStartingDate">
                                </div>
                                <div class="form-group col-6">
                                    <label>Transaction Method</label>
                                    <input type="text" class="form-control" name="transactionMethod" placeholder="Transaction Method">
                                </div>
                                <div class="form-group col-6">
                                    <label>Note</label>
                                    <input type="text" class="form-control" name="note" placeholder="Note">
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
    $("#agreementpaper").change(
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
    function selproject()
    {
        var id = $('#projectID').val();
        $.ajax(
                {
                    url: "{{ url('/project_flats') }}/"+id,
                    type: "GET",
                    cache: false,
                    dataType: "json",
                    success: function(data) {
                        var text = '<option value="" selected>Select Flat</option>';
                        $.each(data, function(key, value) {
                            text += '<option value="'+value.id+'">'+value.flatName+'</option>';
                        });
                        $('#flatID').html(text);
                    }
                }
            );
    }
    function selflat()
    {
        var id = $('#flatID').val();
        $.ajax(
                {
                    url: "{{ url('/flat_details') }}/"+id,
                    type: "GET",
                    cache: false,
                    dataType: "json",
                    success: function(data) {
                        $('#bookingAmountDefault').val(data.bookingAmount);
                        $('#flatPrice').val(data.price);
                    }
                }
            );
    }

    $("#bookingAmount").dblclick(function(){
        $("#bookingAmount").val($('#bookingAmountDefault').val());
        myfun();
    });
    $("#bookingAmount , #flatPrice").keyup(function(){
        myfun();
    });
    function myfun()
    {
        var flatPrice = $('#flatPrice').val();
        var bookingAmount = $("#bookingAmount").val();
        var installmentAmount = flatPrice - bookingAmount;
        $("#totalInstallment").val(installmentAmount);
    }
    $('#numOfinstallment').keyup(function()
    {
        var numOfIns = $(this).val();
        var totalInsAmnt = $("#totalInstallment").val();
        var perinsAmnt = totalInsAmnt / numOfIns;
        $('#perinstallmentamount').val(Math.ceil(perinsAmnt));
    });
</script>
@endsection