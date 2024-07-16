@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="card p-1 m-1"  style="height: 100%;width:100%;">
            <form action="#" method="POST" target="blank">
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
                            <option value='0'>Select Flat</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="top-left">
                        <label>Client</label>
                            <select class="form-control" required name="client"  id="client">
                                <option value='0'>Select Client</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 align-middle">
                        <ol class="float-sm-right align-middle" style=" margin-top: 32px;">
                            <a href="{{ url('collections/create') }}" class="btn btn-info">Add New</a>
                        </ol>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0 m-0">
            <div class="card m-1 p-1">
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-centre">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Payment Amount</th>
                                    <th>Date</th>
                                    <th>Transaction Method</th>
                                    <th>Note</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>

$(document).ready(function(){
    $('#projectID').change(function(){
        var projectID = $('#projectID').find('option:selected').val();
        $.ajax({
                url: "{{ url('loadFlats') }}/"+projectID,
                method: "GET",
                dataType: "json",
                success: function(data){
                    var output = '<option value="0">Select Flat</option>';
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
                    var output = '<option value="0">Select Client</option>';
                    $.each(data,function(key,value)
                    {
                        output += '<option value="'+value.clientID+'">'+value.clientName+'</option>';
                    });
                    $('#client').html(output);
                }
            });
    });

    $('#client').change(function() {
        tableData();
    });

});

function status(id)
{   
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure? you want to Approve!',
        buttons: {
            confirm: function () {
                    $.ajax({
                    url: "{{ url('updateStatus') }}/"+id,
                    method: "GET",
                    dataType: "json",
                    success: function(data){
                        alert("Transaction Approved Successfully!");
                        tableData();
                    }
                });
            },
            cancel: function () {
                
            }
        }
    });

}

function del(id)
{
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure? you want to Delete!',
        buttons: {
            confirm: function () {
                    $.ajax({
                    url: "{{ url('collectionDelete') }}/"+id,
                    method: "GET",
                    dataType: "json",
                    success: function(data){
                        alert("Deleted Successfully!");
                        tableData();
                    }
                });
            },
            cancel: function () {
                
            }
        }
    });
}

tableData();

function tableData()
{
    var projectID = $('#projectID').find('option:selected').val() || "0";
    var flatID = $('#flatID').find('option:selected').val() || "0";
    var clientID = $('#client').find('option:selected').val() || "0";
        $.ajax({
                url: "{{ url('collectionDetails') }}/"+projectID+'/'+flatID+'/'+clientID,
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
                            tBody += '<td>'+value.amount+'</td>';
                            tBody += '<td>'+value.date+'</td>';
                            tBody += '<td>'+value.transactionMethod+'</td>';
                            tBody += '<td>'+value.note+'</td>';
                            tBody += '<td>'+value.createdByName+'</td>';
                            tBody += '<td>';
                                
                            if(value.status==0){
                                if('<?php echo Auth::guard("web")->user()->roleid; ?>'==1){
                                    tBody += '<button onclick="status('+value.id+')" class="btn btn-danger sts">Pending</button>';
                                }else{
                                    tBody += '<button class="btn btn-danger sts">Pending</button>';
                                }
                            }else{
                            tBody += '<button class="btn btn-info">Approved</button>';
                            }
                            tBody += '</td>';
                            tBody += '<td>';
                            tBody += '<div class="d-flex justify-content-center  p-1 m-1">';
                            tBody += '<a href="collections/'+value.id+'/edit"><button class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></button></a>';
                            tBody += '<button class="btn btn-danger delete" onclick="del('+value.id+')">';
                            tBody += '<i class="fa-solid fa-trash-can"></i>';
                            tBody += '</button>';
                            tBody += '<a href="collectionMoneyReceipt/'+value.id+'" class="btn btn-dark mx-1px text-95" target="_blank">';
                            tBody += '<i class="fa-solid fa-file-invoice"></i>'
                            tBody += '</a>'
                            tBody += '</div>';
                            tBody += '</td>';
                            tBody += '</tr>';

                        });
                        $('tBody').html(tBody);
                    }
                    else
                    {
                         $('tBody').html("<b>Sorry no data found...!<b/>");
                    }
                }
            });
}
</script>
@endsection