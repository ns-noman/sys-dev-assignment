<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Custom Style -->

    <link rel="stylesheet" href="{{ asset('public/admin_assets/dist/css/invoicecss.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/dist/css/invcss/style.css') }}"> --}}
    <title>Flat Report</title>
    {{-- <link rel="stylesheet" href="{{ asset('public/dist/css/myTable/myTable.css') }}"> --}}
    <style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th, td {
            /* padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px; */

            padding: 8px;
        }
    </style>

</head>

<body>
    <div class="my-5 page" size="A4">
        <div class="p-5">
            <div class="row">
                <div class="col-3">
                    <div class="logo">
                        <img src="{{ asset('public/upload/'. $companyData->logo) }}" alt="logo" class="img-fluid" width="160px">
                    </div>
                </div>
                <div class="col-6 justify-content-center text-center p-0 m-0">
                    <H2 >{{ $companyData->companyName }}</H2>
                    <h4>Flat Report</h4>
                    <p><h2>{{ $projects->name }}</h2></p>
                    <p>{{ $projects->address }}</p>
                </div>
                <script>              
                    window.print();
                </script>
                <div class="top-right d-flex justify-content-right">
                    <p><b>Date:{{ date('Y-m-d') }}</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col justify-content-center text-center p-0 m-0">
                    {{-- <h5>Flat: {{ $flatDetails['saleInfo']->flatName }}, Price: {{  $flatDetails['saleInfo']->totalPrice }}/- Booking Price: {{ $flatDetails['saleInfo']->bookingAmount }}, Due: {{ $flatDetails['saleInfo']->installmentTotal }}.</h5> --}}
                </div>
            </div>
    <div class="row">
        <div class="p-1 m-1"  style="height: 100%;width:100%;">
            <div class="row">
                <div class="col">
                    <h3>Sale Details</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="bootstrap-data-table-panel">
                        <table>
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
                            <tbody>
                                    <tr>
                                        <td>{{ $data['salesinfo']['projectName'] }}</td>
                                        <td>{{ $data['salesinfo']['flatName'] }}</td>
                                        <td>{{ $data['salesinfo']['clientName'] }}</td>
                                        <td>{{ $data['salesinfo']['totalPrice'] }}</td>
                                        <td>{{ $data['salesinfo']['bookingAmount'] }}</td>
                                        <td>{{ $data['salesinfo']['perInstallment'] }}</td>
                                        <td>{{ $data['salesinfo']['paid'] }}</td>
                                        <td>{{ $data['salesinfo']['unpaid'] }}</td>
                                        <td>{{ $data['salesinfo']['date'] }}</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-0 m-0">
            <div class="m-1 p-1">
                <h3>Collection Details</h3>
                <div class="bootstrap-data-table-panel">
                    <table>
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Date</th>
                                <th>Transaction Method</th>
                                <th>Note</th>
                                <th>Collection Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['collections'] as $collection)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $collection->date }}</td>
                                    <td>{{ $collection->transactionMethod }}</td>
                                    <td>{{ $collection->note }}</td>
                                    <td>{{ $collection->amount  }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            <table class="pr-1" style="width: 100%">
                <thead>
                    <tr><th>Flat Price</th><td class="text-right">{{  $data['finalReport']['flatPrice'] }}</td></tr>
                    <tr><th>Additional</th><td class="text-right">{{  $data['finalReport']['additional'] }}</td></tr>
                    <tr><th>Total Payable</th><td class="text-right">{{  $data['finalReport']['totalPayable'] }}</td></tr>
                    <tr><th>Total Collection</th><td class="text-right">{{  $data['finalReport']['totalCollection'] }}</td></tr>
                    <tr><th>Discount</th><td class="text-right">{{  $data['finalReport']['discount'] }}</td></tr>
                    <tr><th>Final Due</th><td class="text-right">{{  $data['finalReport']['finalDue'] }}</td></tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="row d-flex justify-content-between mt-5">
        <div class="top-left">
        </div>
        <div class="mr-2 top-right mt-5" style="border-top: 1px solid black">
            <p class="text-center m-0"><b> Director Signature</b></p>
        </div>
    </div>
</div>
</div>
</body>
</html>

