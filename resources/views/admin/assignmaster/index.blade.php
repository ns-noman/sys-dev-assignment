@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Assign Master</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Assign Master</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Form</h3>
                            </div>
                            <form action="{{ route('assignmasters.store') }}" method="POST" id="createForm">
                                @csrf()
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-5">
                                            <label>Departments</label>
                                            <select class="form-control" name="department" id="department">
                                                <option value=''>Select Department</option>
                                                @foreach ($department as $item)
                                                    <option value="{{ $item->id }}" dept-name="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-5">
                                            <label>Check List</label>
                                            <select class="form-control" name="checklist" id="checklist">
                                                <option value=''>Select Description</option>
                                                @foreach ($checkList as $item)
                                                    <option value="{{ $item->id }}" description="{{ $item->description }}">{{ $item->description }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-2 mb-7" style="margin-top: 32px;">
                                            <button type="button" class="btn btn-primary btn-add">ADD</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Department</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="item-table">
                                        </tbody>
                                </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </section>
                    <section class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-primary p-0">
                                <div class="card-header">
                                    <h3 class="card-title">Assign Master View</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-lg-5">
                                        <label>Departments</label>
                                        <select class="form-control" name="deptSearch" id="deptSearch">
                                            <option value="0">All Departments</option>
                                            @foreach ($department as $item)
                                                <option value="{{ $item->id }}" dept-name="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Department</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="showTable">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">
    $('.btn-add').on('click', function(){
        var tbody = '';

        departmentID = $('#department').val();
        departmentName = $('#department option:selected').attr('dept-name');
        checklistID = $('#checklist').val();
        description = $('#checklist option:selected').attr('description');
        
        if(!departmentID) return alert("Please Select Department");
        else if(!checklistID) return alert("Please Select Check List"); 

        tbody += '<tr>'
        tbody +=     '<td class="serial"></td>'
        tbody +=     '<td>'+departmentName+'</td>'
        tbody +=     '<td>'+description+'</td>'
        tbody +=     '<td><button  type="button" class="btn btn-primary btn-sm item-delete">'
        tbody +=     '<i class="fa-sharp fa-solid fa-trash"></i></button></td>'
        tbody +=     '<input type="hidden" name="departmentID[]" value="' + departmentID + '" />'
        tbody +=     '<input type="hidden" name="checklistID[]" value="' + checklistID + '" />'
        tbody += '</tr>'

        $('.item-table').append(tbody);
        setSerial();
        $('#checklist').val($('#checklist option:first').val());

    });


    $('.item-table').on('click','.item-delete',function (e){
        e.preventDefault();
        $(this).parents('tr').remove();
        setSerial();
    });

    
    function setSerial(){
        var i = 1;
        $('.serial').each(function(key, element){
            $(element).html(i++);
        });
    }

    $('#createForm').on('submit',function(e){
        e.preventDefault();
        let createForm = document.getElementById("createForm");
        let formData = new FormData(createForm);
        $.ajax({
            url: createForm.getAttribute("action"),
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                showTable();
                $('.item-table').html("");
                $('#deptSearch').val($('#deptSearch option:first').val());
                alert(data.message);
            }   
         });

    });
    $('#deptSearch').on('change',function(e){
        var deptID = $(this).val();
        showTable(deptID);
    });
    showTable();
    function showTable(id = 0){
        $.ajax({
            url: "{{ url('show-master') }}" + '/' + id,
            dataType: 'JSON', 
            type: 'GET',
            success: function(data){
                var tbody = '';
                data.forEach(function callback(value, index){
                    tbody += '<tr>'
                    tbody +=     '<td>'+(index+1)+'</td>'
                    tbody +=     '<td>'+value.name+'</td>'
                    tbody +=     '<td>'+value.description+'</td>'
                    tbody += '<td><div class="d-flex justify-content-center">';
                    tbody += '<button class="btn btn-danger delete" onclick="del('+value.id+')">';
                    tbody += '<i class="fa-solid fa-trash-can"></i>';
                    tbody += '</button>';
                    tbody += '</div>';
                    tbody += '</td>';
                    tbody += '</tr>'
                });
                $("#showTable").html(tbody);
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
                    url: "{{ url('destroy-master') }}/"+id,
                    method: "GET",
                    dataType: "json",
                    success: function(data){
                        showTable();
                        alert(data.message);
                    }
                });
            },
            cancel: function () {
                
            }
        }
    });
}

</script>
@endsection
