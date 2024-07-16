<?php

namespace App\Http\Controllers;

use App\Models\AdditionalAndDiscount;
use App\Models\Collections;
use App\Models\Client;
use App\Models\Project;
use App\Models\Flat;
use App\Models\FlatSale;
use Auth;
use Illuminate\Http\Request;

class AdditionalAndDiscountController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('name','asc')->get();
        return view('admin.additionalandiscount.index',compact('projects'));
    }
    public function create()
    {
        $projects = Project::orderBy('name','asc')->get();
        return view('admin.additionalandiscount.create',compact('projects'));
    }
    public function store(Request $request)
    {
        $userID = Auth::guard('web')->user()->id;
        $userName = Auth::guard('web')->user()->name;
        $data = 
        [
            'clientID'=>$request->client,
            'projectID'=>$request->projectID,
            'flatID'=>$request->flatID,
            'date'=>$request->date,
            'additional'=>$request->additional,
            'discount'=>$request->discount,
            'transactionMethod'=>$request->transactionMethod,
            'note'=>$request->note,
            'createdByID'=>$userID,
            'createdByName'=>$userName,
            'status'=>0,
        ];
        AdditionalAndDiscount::create($data);
        return redirect('AdditionalAndDiscount');
    }
    public function status($id)
    {   
        $addDisc = AdditionalAndDiscount::find($id);
        $addDisc->update(['status'=>1]);
        $pid = $addDisc->projectID;
        $fid = $addDisc->flatID;
        $cid = $addDisc->clientID;
        self::updateFlatCompleteSt($pid,$fid,$cid);
        return true;
    }

    public function addAndDiscData($pid,$fid,$cid)
    {
        $addDisc = AdditionalAndDiscount::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->orderBy('id','desc')->get();
        for($i=0;$i<count($addDisc);$i++){
            $projectID = $addDisc[$i]->projectID;
            $flatID = $addDisc[$i]->flatID;
            $clientID = $addDisc[$i]->clientID;
            $addDisc[$i]['projectName'] = Project::find($projectID)->name; 
            $addDisc[$i]['flatName'] = Flat::find($flatID)->flatName; 
            $addDisc[$i]['clientName'] = Client::find($clientID )->name; 
        }
        if(count($addDisc)){
            return ['success'=>1,'addDisc'=>$addDisc];
        }else{
            return ['success'=>0];
        }
      
    }
    public function edit($id)
    {
        $AdditionalAndDiscount = AdditionalAndDiscount::find($id);
        $flats = Flat::where('projectID',$AdditionalAndDiscount->projectID)->where('status',1)->get();
        $projects = Project::orderBy('name','asc')->get();
        $clients = self::findCustomers($AdditionalAndDiscount->flatID);
        return view('admin.additionalandiscount.edit',compact('projects','AdditionalAndDiscount','flats', 'clients'));
    }
    public function findCustomers($fid)
    {
        return $clients = FlatSale::where('flatID',$fid)->select('clientID','clientName')->get();
    }
    public function update(Request $request,$id)
    {
        $userID = Auth::guard('web')->user()->id;
        $userName = Auth::guard('web')->user()->name;
        $data = 
        [
            'clientID'=>$request->client,
            'projectID'=>$request->projectID,
            'flatID'=>$request->flatID,
            'date'=>$request->date,
            'additional'=>$request->additional,
            'discount'=>$request->discount,
            'transactionMethod'=>$request->transactionMethod,
            'note'=>$request->note,
            'createdByID'=>$userID,
            'createdByName'=>$userName,
        ];
        AdditionalAndDiscount::find($id)->update($data);
        $addDisc = AdditionalAndDiscount::find($id);
        if($addDisc->status == 1){
            $pid = $addDisc->projectID;
            $fid = $addDisc->flatID;
            $cid = $addDisc->clientID;
            self::updateFlatCompleteSt($pid,$fid,$cid);
        }
        return redirect('AdditionalAndDiscount');
    }
    public function destroy($id)
    { 
        $addDisc = AdditionalAndDiscount::find($id);
        $pid = $addDisc->projectID;
        $fid = $addDisc->flatID;
        $cid = $addDisc->clientID;

        AdditionalAndDiscount::destroy($id);

        self::updateFlatCompleteSt($pid,$fid,$cid);

        return true;
    }
    public function updateFlatCompleteSt($pid,$fid,$cid)
    {
        $flaltPrice = FlatSale::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->get()[0]->totalPrice;
        $totalCollection = Collections::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->where('status',1)->sum('amount');
        $additional = AdditionalAndDiscount::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->where('status',1)->sum('additional');
        $discount = AdditionalAndDiscount::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->where('status',1)->sum('discount');

        $due = ($flaltPrice + $additional - $discount) - $totalCollection;
        if($due<=0){
            Flat::find($fid)->update(
                [
                    'deliveryStatus'=>1
                ]
            );
        }else{
            Flat::find($fid)->update(
                [
                    'deliveryStatus'=>0
                ]
            );
        }
    }
   
}
