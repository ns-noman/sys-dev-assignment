<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlatSale;
use App\Models\Company_datails;
use App\Models\Client;
use App\Models\Project;
use App\Models\Flat;
use App\Models\Collections;
use App\Models\AdditionalAndDiscount;
use App\Http\Controllers\InstallmentController;

class flatReport extends InstallmentController
{
    public function index()
    {
        $projects = Project::orderBy('name','asc')->get();
        return view('admin.flatReport.index',compact('projects'));
    }
    public function store(Request $request)
    {
        $pid = $request->projectID;
        $fid = $request->flatID;
        $cid = $request->client;
        $data = self::flatDetails($pid,$fid,$cid);
        $projects =  Project::find($pid);
        $companyData = Company_datails::find(1);
        return view('admin.flatReport.printData',compact('data','companyData','projects'));
    }
    public function flatDetails($pid,$fid,$cid)
    {
        $obj = new InstallmentController();
        $insDetails = $obj->insDetails($pid,$fid,$cid);
        $c = 0;
        foreach($insDetails["installments"] as $value){$c += $value['status'];}

        $collections = Collections::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->where('status',1)->orderBy('date','asc')->get();
        $salesinfo = FlatSale::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->get()[0];
        $salesinfo['paid'] = $c;
        $salesinfo['unpaid'] = count($insDetails['installments']) - $c;

        $flatPrice = $salesinfo->totalPrice;
        $additional = AdditionalAndDiscount::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->where('status',1)->sum('additional');
        $discount = AdditionalAndDiscount::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->where('status',1)->sum('discount');
        $totalCollection = Collections::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->where('status',1)->sum('amount');
        $totalPayable = $flatPrice + $additional;
        $finalDue = ($totalPayable - $totalCollection - $discount) < 0 ? 0 : ($totalPayable - $totalCollection - $discount);
        $finalReport = ['flatPrice'=>$flatPrice,'additional'=>$additional,'discount'=>$discount,'totalCollection'=>$totalCollection,'totalPayable'=>$totalPayable,'finalDue'=>$finalDue];
        
        if(count($collections)){
            return ['success'=>1,'collections'=>$collections,'salesinfo'=>$salesinfo,'finalReport'=>$finalReport];
        }else{
            return ['success'=>0];
        }
    }
}
