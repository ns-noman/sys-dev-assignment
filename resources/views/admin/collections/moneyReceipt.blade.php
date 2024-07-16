<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css"
        integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://www.dafontfree.net/embed/bmV3Ym9yb3VnaC1yZWd1bGFyJmRhdGEvMjkvbi8xNDk4MTQvTkVXQk9ST1UuVFRG"
        rel="stylesheet" type="text/css" />
    <title>Invoice</title>
    <style>
        hr {
            border-top: 0px solid;
            border: 3px solid #115083;
            margin-left: -56px;
            margin-right: -56px;
        }
        table {
            width: 100%
        }

        table,
        th,
        td {
            border: 2px solid rgb(0, 0, 0);
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            font-weight: bold;
            text-align: center;
            width:50%;
        }

        .compref {
            font-family: 'Newborough';

            @font-face {
                font-family: "Newborough";
                src: url("NEWBOROU.eot?") format("eot"), url("NEWBOROU.woff") format("woff"), url("NEWBOROU.ttf") format("truetype"), url("NEWBOROU.svg#Newborough") format("svg");
                font-weight: normal;
                font-style: normal;
            }
        }

        .comsuff {
            font-family: 'Playfair Display';
        }

        .com {
            font-size: 65px;
            color: red;
            margin-left:10px;
        }

        .receiptHead {
            width: 100%;
            text-align: center;
            border-bottom: 4px solid #065e79;
            margin-left: -100px;
            margin-right: -100px;
            line-height: 0.1em;
        }

        .receiptHead,
        .recSpan {
            background: #fff;
            padding: 0 10px;
            color: red;
            font-family: 'Times New Roman';
            font-size: 35px;
        }
        .address,
        .phone {
            font-size: 23px;
            color: #065e79;
        }
        .timesnewroman {
            font-family: 'Times New Roman';
        }
    </style>
    <script>
        window.print();
    </script>
</head>

<body class="timesnewroman m-0 p-0">
    <div class="container-fluid">
        <div class="p-0 mx-2">
            <div class="row">
                <div class="col-3 p-0">
                    <div>
                        <img style="height: 220px; width:250px" src="{{ asset('public/upload/' . $companyData->logo) }}"
                            alt="logo" class="img-fluid" width="160px">
                    </div>
                </div>
                <div class="col-9 flex justify-content-center text-center p-0 m-0">
                    <H2 class="text-red com text-left"><span class="compref">A.H.N.</span> <span
                            class="comsuff">Builder's Limited</span></H2>
                    <p class="address" style="margin-left: 0px; padding-left: 0px;"><strong>Address: Holding# 200/122, Rose Valley, Mujahidnagar, South<br>Rayerbag, Kadomtoli, Dhaka-1362(DSCC).</strong>
                    <br/>
                        <i class="fa-solid fa-phone-volume pt-0 mt-0" style="color: #21d8fd;"></i>
                        <strong>{{ $companyData->phone }}</strong>
                    <br/>
                        <strong>E-mail: {{ $companyData->companyEmail }}</strong>
                    </p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col d-flex justify-content-center">
                    <h2 class="receiptHead"><span class="recSpan"><strong>PAYMENT RECEIPT</strong></span></h2>
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-between" style="font-size: 25px">
                <div class="top-left">
                    <p><b>Invoice No: #{{ $collections->id }}</b></p>
                </div>
                <div class="top-right">
                    <p><b>Date:{{ $date }}</b></p>
                </div>
            </div>
            <div class="row mt-2 d-flex justify-content-between" style="font-size: 25px">
                <div class="top-left">
                    <h1><strong>{{ $flatDetails->clientName }}</strong></h1>
                    <h3>Email: {{ $client->email }}</h3>
                    <h3>Phone: {{ $client->contact_no }}</h3>
                </div>
            </div>
            <div class="row d-flex justify-content-between" style="font-size: 25px; margin-top: 40px;">
                <div class="top-left" style="width: 50%">
                    <H2 style=" color: #283747;"><b>{{ $flatDetails->projectName }}</b></H2>
                    <p>{{ $flatDetails->address }}</p>
                </div>
                <div class="top-right p-0 m-0" style="width: 20%">
                    <p style="margin-bottom:0px; margin-top:45px;"><b>Purpose: {{ $flatDetails->flatName }}</b></p>
                    <p><b>Value:
                            <?php
                            if ($flatDetails['additional'] > 0) {
                                echo $flatDetails->totalPrice + $flatDetails['additional'] . '/-(+' . $flatDetails['additional'] . ')';
                            } elseif ($flatDetails['additional'] > 0) {
                                echo $flatDetails->totalPrice + $flatDetails[''] . '/-(-' . $flatDetails['additional'] . ')';
                            } else {
                                echo $flatDetails->totalPrice;
                            }
                            ?></strong>/-
                        </b></p>
                </div>
            </div>
            <div class="row p-0 mt-2">
                <div class="col-12 p-0 m-0">
                    <p class="p-0 m-0" style="font-size: 30px">
                        Amount Received from <strong>{{ $flatDetails->clientName }}</strong> of BDT =
                        <strong class="text-uppercase">{{ $collections->amount }}/-({{ $currencyInWord }} only)</strong> as Installment.
                    </p>
                </div>
            </div>
            <div class="row mt-4 timesnewroman" style="font-size: 25px">
                <div class="col-12  p-0">
                    <table>
                        <thead>
                            <tr style="background-color: gray">
                                <th>Payment</th>
                                <td>Amount</td>
                            </tr>
                            <tr>
                                <th>Current</th>
                                <td>{{ $collections->amount }}/-</td>
                            </tr>
                            <tr>
                                <th>Previous</th>
                                <td>{{ $totalCollectionBeforeThisDate }}/-</td>
                            </tr>
                        </thead>
                    </table>
                    <table class="mt-2">
                        <tbody>
                            <tr>
                                <th>Total Recieved : </th>
                                <td>{{ $collections->amount + $totalCollectionBeforeThisDate }}/-</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="mt-2">
                        <tbody>
                            <tr style="background-color: yellow; color: black;">
                                <th class="text-uppercase" style="text-align: left;">Total recieved amount in word: <span>{{ $currencyInWordTotal }} only.</span></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-3 text-justify" style="font-size: 20px">
                <div class="col-5  p-0">
                    <p>
                        <b>
                            Please keep this receipt for your records. If you have any questions or concerns, feel free
                            to contact us using the contact information provided above.
                        </b>
                    </p>
                </div>
            </div>
            <div class="row d-flex justify-content-between" style="margin-top:10px" style="font-size: 25px">
                <div class="top-left">
                    <h3><b>PAYMENT INFO</b></h3>
                    <p><b>Payment Received In: </b>{{ $collections->transactionMethod }}</p>
                    <p><b>Note: </b>{{ $collections->note }}</p>
                    <p><b>Received By: </b>{{ $collections->createdByName }}</p>
                </div>
                <div class="top-right">
                    <p class="text-center mr-3 pr-3" style="border-top: 1px solid black; margin: 130px 80px 0px 0px !important"><b> Authorized
                        Signature & Date</b>
                    </p>
                </div>
            </div>
            <hr />
            <div class="row mt-2" style="font-size: 25px; color:#065e79">
                <div class="top-left text-left" style="width: 40%">
                    <h4><strong>Website: ahnbuilderslimited.com</strong></h4>
                </div>
                <div class="top-right text-right" style="width: 60%">
                    <h4><strong>Client Login: ahnbuilderslimited.com/soft/client/login</strong></h4>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
