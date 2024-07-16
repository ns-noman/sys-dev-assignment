<?php

namespace App\Http\Controllers;

use App\Models\FlatSale;
use App\Models\Client;
use App\Models\Flat;
use App\Models\Project;
use App\Models\Collections;
use App\Models\Documents;
use DateTime;
use Illuminate\Http\Request;

class FlatSaleController extends Controller
{
    public function index()
    {
        $data =  FlatSale::orderBy('id','desc')->get();
        return view('admin.flatSale.index',compact('data'));
    }

    public function create()
    {
        $clients = Client::orderBy('name','asc')->get();
        $projects = Project::orderBy('name','asc')->get();
        return view('admin.flatSale.create',compact('clients','projects'));
    }
    public function resaleCreate($id)
    {
        $FlatSale =  FlatSale::find($id);
        $clients = Client::where('id','!=',$FlatSale->clientID)->get();
        $projects = Project::find($FlatSale->projectID);
        $flats = Flat::find($FlatSale->flatID);
        $prevClientTotalPaid = Collections::where('projectID',$FlatSale->projectID)->where('flatID',$FlatSale->flatID)->where('clientID',$FlatSale->clientID)->sum('amount');
        

        return view('admin.flatSale.resaleCreate',compact('clients','projects','flats','prevClientTotalPaid','FlatSale'));
    }
    public function project_flats($id)
    {
        return $flats = Flat::where('projectID','=',$id)
                ->where('status','=',0)->orderBy('flatName','asc')->get();
    }
    public function flat_details($id)
    {
        return $flat_details = Flat::find($id);
    }

    public function store(Request $request)
    {
        $userID = session()->get('userData')[0]->id;
        $name = session()->get('userData')[0]->name;

        $clientName = Client::find($request->clientID)->name;
        $projectName = Project::find($request->projectID)->name;
        $flatName = Flat::find($request->flatID)->flatName;
        $images =$request->images;
        //Storing Flat Sale
        $data = 
        [
            'clientID'=>$request->clientID,
            'clientName'=>$clientName,
            'projectID'=>$request->projectID,
            'projectName'=>$projectName,
            'flatID'=>$request->flatID,
            'flatName'=>$flatName,
            'bookingAmount'=>$request->bookingAmount,
            'totalPrice'=>$request->flatPrice,
            'installmentTotal'=>$request->totalInstallment,
            'numOfInstallment'=>$request->numOfinstallment,
            'perInstallment'=>$request->perinstallmentamount,
            'date'=>$request->contractDate,
            'instStartingDate'=>$request->insStartingDate,
            'note'=>$request->note,
            'createdByID'=>$userID,
            'createdByName'=>$name,
        ];
        $flatSale = FlatSale::create($data);
        //Storing Flat Sale End

        //Documents Upload
        $flatSale = $flatSale->id;
        $i = 0;
        foreach($images as $img)
        {
            $imagesDoc = 'doc'. time(). $i .'.'.$img->getClientOriginalExtension();
            $img->move(public_path('upload/'), $imagesDoc);
            $data = 
            [
                'saleID'=>$flatSale,
                'image'=>$imagesDoc
            ];
            Documents::create($data);
            $i++;
        }
        //End

        //Updatig flat Status
        Flat::find($request->flatID)->update(
            [
                'status'=>1
            ]
        );
        //End

        //Updating Resale
        if(isset($request->oldSaleID)){
            FlatSale::find($request->oldSaleID)->update([
                'resale'=>1
                ]);
        }
        //Updating Resale End
        //Booking Money As Collection
        $data = 
        [
            'clientID'=>$request->clientID,
            'projectID'=>$request->projectID,
            'flatID'=>$request->flatID,
            'date'=>$request->contractDate,
            'amount'=>$request->bookingAmount,
            'transactionMethod'=>$request->transactionMethod,
            'note'=>$request->note,
            'createdByID'=>$userID,
            'createdByName'=>$name,
            'status'=>0,
        ];
        Collections::create($data);
        //Booking Money As Collection End

        return redirect('flatSales');
    }

    public function proImgDel($id)
    {
        $image = Documents::find($id)->image;
        Documents::destroy($id);
        unlink(public_path('upload/').$image);
        return redirect()->back();
    }
    public function show($id)
    {
        $data = Documents::where('saleID',$id)->get();
        return view('admin.flatSale.view-img',compact('data'));
    }

    public function edit(FlatSale $flatSale)
    {
        $projectID = $flatSale->projectID;
        $flatID = $flatSale->flatID;
        $clientID = $flatSale->clientID;
        $date = $flatSale->date;
        $amount = $flatSale->bookingAmount;

        $clients = Client::orderBy('name','asc')->get();
        $projects = Project::orderBy('name','asc')->get();
        $flats = Flat::where('projectID','=',$flatSale->projectID)
                    ->where('status','=',0)
                    ->orWhere('id','=',$flatSale->flatID)
                    ->get();
       $collections = Collections::where('projectID',$projectID)
                    ->where('flatID',$flatID)
                    ->where('clientID',$clientID)
                    ->where('date',$date)
                    ->where('amount',$amount)
                    ->first();
        $flatSale['transactionMethod'] = $collections->transactionMethod;
        $defaultBookinAmnt = Flat::find($flatSale->flatID)->bookingAmount;
        return view('admin.flatSale.edit',compact('clients','projects','flatSale','flats','defaultBookinAmnt'));
    }

    public function update(Request $request, FlatSale $flatSale)
    {
        $userID = session()->get('userData')[0]->id;
        $name = session()->get('userData')[0]->name;

        $clientName = Client::find($request->clientID)->name;
        $projectName = Project::find($request->projectID)->name;
        $flatName = Flat::find($request->flatID)->flatName;
        $saleID = $flatSale->id;

        // unbooking flat If this is not using again.....
        if($flatSale->flatID != $request->flatID)
        {
            Flat::find($flatSale->flatID)->update(['status'=>0]);
            Flat::find($request->flatID)->update(['status'=>1]);
        }
        Flat::find($flatSale->flatID)->update(
           [ 'bookingAmount'=>$request->bookingAmount,
            'price'=>$request->flatPrice,]
        );


        $images = $request->images;
         //Documents
         if($images){
            $flatSale = $saleID;
            $i = 0;
            foreach($images as $img)
            {
                $imagesDoc = 'doc'. time(). $i .'.'.$img->getClientOriginalExtension();
                $img->move(public_path('upload/'), $imagesDoc);
                $data = 
                [
                    'saleID'=>$flatSale,
                    'image'=>$imagesDoc
                ];
                Documents::create($data);
                $i++;
            }
         }
         //End
         
        //Updating Collections
        
        $Collections = Collections::where('projectID',$flatSale->projectID)
                            ->where('flatID',$flatSale->flatID)
                            ->where('clientID',$flatSale->clientID)
                            ->where('date',$flatSale->date)
                            ->where('amount',$flatSale->bookingAmount)
                            ->get()->first()
                            ->update([
                                'date'=>$request->contractDate,
                                'amount'=>$request->bookingAmount,
                                'transactionMethod'=>$request->transactionMethod,
                                'note'=>$request->note,
                                'createdByID'=>$userID,
                                'createdByName'=>$name
                            ]);

        if(($flatSale->projectID != $request->projectID) || ($flatSale->flatID != $request->flatID) || ($flatSale->clientID != $request->clientID)){

            $collectionData = Collections::where('projectID',$flatSale->projectID)
                                    ->where('flatID',$flatSale->flatID)
                                    ->where('clientID',$flatSale->clientID)->get();
            foreach($collectionData as $value){
                Collections::find($value->id)->update(
                            [
                                'clientID'=>$request->clientID,
                                'projectID'=>$request->projectID,
                                'flatID'=>$request->flatID
                            ]
                        );
            };
        }
        //End Updating Collections
        $data = 
        [
            'clientID'=>$request->clientID,
            'clientName'=>$clientName,
            'projectID'=>$request->projectID,
            'projectName'=>$projectName,
            'flatID'=>$request->flatID,
            'flatName'=>$flatName,
            'bookingAmount'=>$request->bookingAmount,
            'totalPrice'=>$request->flatPrice,
            'installmentTotal'=>$request->totalInstallment,
            'perInstallment'=>$request->perinstallmentamount,
            'date'=>$request->contractDate,
            'instStartingDate'=>$request->insStartingDate,
            'note'=>$request->note,
            'createdByID'=>$userID,
            'createdByName'=>$name,
        ];
        
        $flatSale->update($data);

        return redirect('flatSales');
    }

    public function destroy(FlatSale $flatSale)
    {
        $saleID = $flatSale->id;
        $amount = Collections::where('projectID',$flatSale->projectID)
                    ->where('clientID',$flatSale->clientID)
                    ->where('flatID',$flatSale->flatID)
                    ->get ('amount');
        $numOfSale = FlatSale::where('projectID',$flatSale->projectID)
                        ->where('flatID',$flatSale->flatID)
                        ->count('id');
        
        if(!count($amount)){
            // Unbooking flat....
            if($numOfSale==1){Flat::find($flatSale->flatID)->update(['status'=>0]);}
            
            //deleting sold flat...
            $flatSale->delete();
            
            // Deleting picture...
            $images = Documents::where('saleID', $saleID)->get();
            foreach($images as $value)
            {
                $image = $value->image;
                unlink(public_path('upload/'.$image));
            }
            Documents::where('saleID', $saleID)->delete();
        }
        return redirect('flatSales');
    }
}
