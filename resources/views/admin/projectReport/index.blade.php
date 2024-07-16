@extends('layouts.master')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Project Report</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="card p-1 m-1"  style="height: 100%;width:100%;">
            <form action="{{ url('projectReport') }}" method="POST" target="blank">
                @csrf
                <div class="row">
                    <div class="col-sm-3">
                        <div class="top-left">
                            <label>Project Name</label>
                            <select class="normalize" name="projectID" id="projectID" required>
                                <option value="">Select Project</option>
                                @foreach ($projects as $project)
                                    <option selected value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1 p-2">
                        <button class="btn btn-danger weight mt-4" type="button" name="refresh" id="refresh"
                            style="padding-bottom: 5px;border-radius: 4px;"><i class="fa fa-refresh" style="font-size:18px;"></i></i>
                        </button>
                    </div>
                    <div class="col-sm-8">
                        <ol class="float-sm-right" style=" margin-top: 32px;">
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
<div class="container-fluid">
    <div class="row">
        <div class="col-12 m-0 p-0">
            <div class="card p-1 m-1">
                <div class="bootstrap-data-table-panel">
                    <div class="table-responsive">
                        <table
                            class="table table-striped table-bordered table-centre">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Flat No</th>
                                    <th>Client Name</th>
                                    <th>Mobile</th>
                                    <th>Price</th>
                                    <th>Additional</th>
                                    <th>Discount</th>
                                    <th>Collections</th>
                                    <th>Dues</th>
                                    <th>Last Payment</th>
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
    $('#projectID').change(function() {
        myfun();
    });
    myfun();
});
function myfun()
{
    var projectID = $('#projectID').find('option:selected').val();
    $.ajax({
            url: "{{ url('projectDetails') }}/"+projectID,
            method: "GET",
            dataType: "json",
            success: function(data){
                    var tBody = '';
                    $.each(data ,function(key, value)
                    {
                        tBody+='<tr>';
                        tBody+='<td>'+(key+1)+'</td>';
                        tBody+='<td>'+value.flatName+'</td>';
                        tBody+='<td>'+(value.name?value.name:'-')+'</td>';
                        tBody+='<td>'+(value.contact_no?value.contact_no:'-')+'</td>';
                        tBody+='<td>'+(value.totalPrice?value.totalPrice:'-')+'</td>';
                        tBody+='<td>'+(isFinite(value.additional)?value.additional:0)+'</td>';
                        tBody+='<td>'+(isFinite(value.discount)?value.discount:0)+'</td>';
                        tBody+='<td>'+(isFinite(value.collections)?value.collections:0)+'</td>';
                        dues = (parseInt(value.totalPrice) + parseInt(value.additional) - parseInt(value.discount)) - (parseInt(value.collections));
                        tBody+='<td>'+(isFinite(dues)?dues:0)+'</td>';
                        tBody+='<td>'+value.lastPaymentDate+'</td>';
                        
                        tBody+='</tr>';
                    });
                    $('#tBody').html(tBody);
                
            }
        });
}
$('#refresh').click(function() {
location.reload();
});
</script>
@endsection