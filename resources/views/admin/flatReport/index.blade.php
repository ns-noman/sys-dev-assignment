@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="card p-1 m-1"  style="height: 100%;width:100%;">
            <form action="{{ url('flatReport') }}" method="POST" target="blank">
                @csrf
                <div class="row">
                    <div class="col-sm-3">
                        <div class="top-left">
                            <label>Project Name</label>
                            <select class="normalize" name="projectID" id="projectID" required>
                                <option value="0" selected>Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="top-left">
                        <label>Flat Name</label>
                        <select class="form-control" required name="flatID" id="flatID">
                            <option value=''>Select Flat</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="top-left">
                        <label>Client</label>
                            <select class="form-control" required name="client"  id="client">
                                <option value=''>Select Client</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1 p-2">
                        <button class="btn btn-danger weight mt-4" type="button" name="refresh" id="refresh"
                            style="padding-bottom: 5px;border-radius: 4px;"><i class="fa fa-refresh" style="font-size:18px;"></i></i>
                        </button>
                    </div>
                    <div class="col-sm-2 align-middle">
                        <ol class="float-sm-right align-middle" style=" margin-top: 32px;">
                            <button type="submit" class="btn align-middle btn-dark mx-1px text-95">Print
                                <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                            </button>
                        </ol>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid" id="flatInfo">
    {{-- style="display:none" --}}
    <div class="row">
        <div class="card p-1 m-1"  style="height: 100%;width:100%;">
            <div class="row">
                <div class="col">
                    <h3>Sale Details</h3>
                </div>
            </div>
            <div class="row" align="center">
                <div class="col-12">
                    <div class="bootstrap-data-table-panel">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-centre">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Flat Name</th>
                                        <th>Client Name</th>
                                        <th>Flat Price</th>
                                        <th>Booking Amount</th>
                                        <th>Per Installment</th>
                                        <th>Paid</th>
                                        <th>Unpaid</th>
                                        <th>Sales Date</th>
                                    </tr>
                                </thead>
                                <tbody id="tBodySales">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0 m-0">
            <div class="card m-1 p-1">
                <h3>Collection Details</h3>
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-centre">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Date</th>
                                    <th>Transaction Method</th>
                                    <th>Note</th>
                                    <th>Collection Amount</th>
                                </tr>
                            </thead>
                            <tbody id="tBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0 m-0">
            <div class="card mx-1 p-1">
                {{-- <h3></h3> --}}
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-centre">
                                <thead id="theadFinalResult">
                                    
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

$(document).ready(function(){
    $('#projectID').change(function(){
        var projectID = $('#projectID').find('option:selected').val();
        $.ajax({
                url: "{{ url('loadFlats') }}/"+projectID,
                method: "GET",
                dataType: "json",
                success: function(data){
                    var output = '<option value="0" selected>Select Flat</option>';
                    $.each(data,function(key,value)
                    {
                        output += '<option value="'+value.id+'">'+value.flatName+'</option>';
                    });
                    $('#flatID').html(output);
                }
            });
    });

    $('#flatID').change(function(){
        var flatID = $('#flatID').find('option:selected').val();
        $.ajax({
                url: "{{ url('findCustomers') }}/"+flatID,
                method: "GET",
                dataType: "json",
                success: function(data){ 
                    var output = '<option value="0" selected>Select Client</option>';
                    $.each(data,function(key,value)
                    {
                        output += '<option value="'+value.clientID+'">'+value.clientName+'</option>';
                    });
                    $('#client').html(output);
                }
            });
    });

    $('#projectID, #flatID, #client').change(function() {
        myfun();
    });
});

function myfun()
{
    var projectID = $('#projectID').find('option:selected').val();
    var flatID = $('#flatID').find('option:selected').val();
    var clientID = $('#client').find('option:selected').val();
    
    if (projectID != 0 & flatID != 0 & clientID != 0){

        $.ajax({
                url: "{{ url('flatDetails') }}/"+projectID+'/'+flatID+'/'+clientID,
                method: "GET",
                dataType: "json",
                success: function(data)
                {
                    if(data.success)
                    {
                        var tBody = '';
                        $.each(data.collections ,function(key, value){
                            tBody += '<tr>';
                            tBody += '<td>'+(key+1)+'</td>';
                            tBody += '<td>'+value.date+'</td>';
                            tBody += '<td>'+value.transactionMethod+'</td>';
                            tBody += '<td>'+value.note+'</td>';
                            tBody += '<td class="text-right">'+value.amount+'</td>';
                            tBody += '</tr>';

                        });

                        $('#tBody').html(tBody);

                        tBodySales = '';
                        tBodySales += '<tr>'
                        tBodySales += '<td>'+data.salesinfo.projectName+'</td>'
                        tBodySales += '<td>'+data.salesinfo.flatName+'</td>'
                        tBodySales += '<td>'+data.salesinfo.clientName+'</td>'
                        tBodySales += '<td>'+data.salesinfo.totalPrice+'</td>'
                        tBodySales += '<td>'+data.salesinfo.bookingAmount+'</td>'
                        tBodySales += '<td>'+data.salesinfo.perInstallment+'</td>'
                        tBodySales += '<td class="text-right">'+data.salesinfo.paid+'</td>'
                        tBodySales += '<td class="text-right">'+data.salesinfo.unpaid+'</td>'
                        tBodySales += '<td>'+data.salesinfo.date+'</td>'
                        tBodySales += '</tr>'
                        $('#tBodySales').html(tBodySales);

                        theadFinalResult = '';
                        theadFinalResult += '<tr><th>Flat Price</th><td class="text-right">'+data.finalReport.flatPrice+'</td></tr>'
                        theadFinalResult += '<tr><th>Additional</th><td class="text-right">'+data.finalReport.additional+'</td></tr>'
                        theadFinalResult += '<tr><th>Total Payable</th><td class="text-right">'+data.finalReport.totalPayable+'</td></tr>'
                        theadFinalResult += '<tr><th>Total Collection</th><td class="text-right">'+data.finalReport.totalCollection+'</td></tr>'
                        theadFinalResult += '<tr><th>Discount</th><td class="text-right">'+data.finalReport.discount+'</td></tr>'
                        theadFinalResult += '<tr><th>Final Due</th><td class="text-right">'+data.finalReport.finalDue+'</td></tr>'
                        $('#theadFinalResult').html(theadFinalResult);
                    }
                    else
                    {
                        alert("No Data Found");
                    }
                }
            });
    }
}

$('#refresh').click(function() {
    location.reload();
});

</script>
@endsection