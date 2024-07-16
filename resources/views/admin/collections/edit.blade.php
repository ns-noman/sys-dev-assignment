@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row m-0">
        <div class="col-lg-12 m-0">
            <div class="card m-1">
                <div class="card-title">
                    <h4 class="p-3">Collections</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ url('collections/'.$collections->id) }}" method="POST">
                            @csrf()
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="top-left">
                                        <label>Project Name</label>
                                        <select class="normalize" name="projectID" id="projectID" required>
                                            <option value="" selected>Select Project</option>
                                            @foreach ($projects as $project)
                                                <option @if ($collections->projectID == $project->id)
                                                    selected
                                                @endif value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="top-left">
                                    <label>Flat Name</label>
                                    <select class="form-control" required name="flatID" id="flatID">
                                        <option value=''>Select Flat</option>
                                        @foreach ($flats as $flat)
                                            <option @if ($collections->flatID == $flat->id)
                                                selected
                                            @endif value="{{ $flat->id }}">{{ $flat->flatName }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="top-left">
                                    <label>Client</label>
                                        <select class="form-control" required name="client"  id="client">
                                            <option value=''>Select Client</option>
                                            @foreach ($clients as $client)
                                            <option @if ($collections->clientID == $client->clientID)
                                                selected
                                            @endif value="{{ $client->clientID }}">{{ $client->clientName }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="top-left">
                                    <label>Amount</label>
                                        <input class="form-control" type="number" value="{{ $collections->amount }}" id="amount" name="amount"placeholder="0.00">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="top-left">
                                    <label>Date</label>
                                        <input class="form-control" value="{{ $collections->date }}" type="date" id="date" name="date" placeholder="Date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="top-left">
                                    <label>Transaction Method</label>
                                        <input class="form-control" value="{{ $collections->transactionMethod }}" type="text" id="transactionMethod" name="transactionMethod" placeholder="Transaction Method" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="top-left">
                                    <label>Note</label>
                                        <input class="form-control" value="{{ $collections->note }}" type="text" id="note" name="note" placeholder="Note">
                                    </div>
                                </div>
                                <div class="col-md-6 m-0 p-0">
                                    <div class="top-left">
                                        <button type="submit" class="btn m-0 btn-outline-primary ml-2 mt-3">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
$(document).ready(function(){
    $('#projectID').change(function(){
        var projectID = $('#projectID').find('option:selected').val();
        var flatID = $('#flatID').find('option:selected').val();
        $.ajax({
                url: "{{ url('loadFlats') }}/"+projectID,
                method: "GET",
                dataType: "json",
                success: function(data){
                    var output = '<option value="">Select Flat</option>';
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
                    var output = '<option value="">Select Client</option>';
                    $.each(data,function(key,value)
                    {
                        output += '<option value="'+value.clientID+'">'+value.clientName+'</option>';
                    });
                    $('#client').html(output);
                }
            });
    });
});

</script>
@endsection