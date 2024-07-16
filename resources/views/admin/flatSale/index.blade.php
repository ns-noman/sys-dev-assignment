
@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card m-2 p-1">
            <h4>Flat Sales</h4>
            <div class="bootstrap-data-table-panel">
                <div class="table-responsive">
                    <a href="{{ url('flatSales/create') }}"class="btn btn-primary mb-3">New Sales</a>
                    <table id="example1" class="table table-striped table-bordered table-centre">
                        <thead>
                            <tr>
                                <th>Srl</th>
                                <th>Client Name</th>
                                <th>Project Name</th>
                                <th>Flat Name</th>
                                <th>Booking Amount</th>
                                <th>Flat Price</th>
                                <th>Total Installment Amount</th>
                                <th>Num Of Installment</th>
                                <th>Per installment Amount</th>
                                <th>Date</th>
                                <th>Inst Starting Date</th>
                                <th>Note</th>
                                <th>Created By</th>
                                <th>Resale</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->clientName }}</td>
                                    <td>{{ $item->projectName }}</td>
                                    <td>{{ $item->flatName }}</td>
                                    <td>{{ $item->bookingAmount }}</td>
                                    <td>{{ $item->totalPrice }}</td>
                                    <td>{{ $item->installmentTotal }}</td>
                                    <td>{{ $item->numOfInstallment }}</td>
                                    <td>{{ $item->perInstallment }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->instStartingDate }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td>{{ $item->createdByName }}</td>
                                    <td>
                                        @if ($item->resale==0)
                                        <a href="{{url('resaleCreate/'. $item->id) }}" class="btn btn-info">Resale</a>
                                        @else
                                            <button class="btn btn-danger" type="button">Resold</button>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{url('flatSales/'. $item->id.'/edit') }}" class="btn btn-info">
                                                <i class="fa-solid fa-pen-to-square"></i></a>
                                            <a target="_blank" href="{{ route('flatSales.show',$item->id) }}" class="btn btn-warning">
                                                <i class="fa-solid fa-image"></i>
                                            </a>
                                            <form action="{{url('flatSales/'. $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


