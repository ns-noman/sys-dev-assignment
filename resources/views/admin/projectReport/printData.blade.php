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
    <title>Project Report</title>
    {{-- <link rel="stylesheet" href="{{ asset('public/dist/css/myTable/myTable.css') }}"> --}}
    <style>
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th, td {
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 5px;
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
                    <h4>Project Report</h4>
                    <p><h2>{{ $projects->name }}</h2></p>
                    <p>{{ $projects->address }}</p>
                    {{-- <p class="p-0 m-0">{{ $companyData->address }}</p>
                    <p>{{ $companyData->phone }}, {{ $companyData->companyEmail }}</p> --}}
                </div>
                <script>              
                    // window.print();
                </script>
                <div class="top-right d-flex justify-content-right">
                    <p><b>Date:{{ date('Y-m-d') }}</b></p>
                </div>
            </div>
            <div class="row">
                <div class="ml-0 justify-content-center">
                    <table style="margin-left:-20px!important; width:100%">
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
                        <tbody>
                            @foreach ($projectDetails as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->flatName }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->contact_no }}</td>
                                    <td class="text-right">{{ $item->totalPrice }}</td>
                                    <td class="text-right">{{ $item->additional }}</td>
                                    <td class="text-right">{{ $item->discount }}</td>
                                    <td class="text-right">{{ $item->collections }}</td>
                                    <td class="text-right">{{ ($item->totalPrice + $item->additional - $item->discount)- $item->collections }}</td>
                                    <td class="text-right">{{ $item->lastPaymentDate }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row d-flex justify-content-between mt-5">
                <div class="top-left">
                    {{-- <p><b>Payment Received In: </b>{{  $Installment->transactionMethod }}</p> --}}
                </div>
                <div class="mr-2 top-right mt-5" style="border-top: 1px solid black">
                    <p class="text-center m-0"><b>Authorized Signature</b></p>
                </div>
                <div class="mr-2 top-right mt-5" style="border-top: 1px solid black">
                    <p class="text-center m-0"><b> Director Signature</b></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

