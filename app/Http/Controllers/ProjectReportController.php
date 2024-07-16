<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Installment;
use App\Models\FlatSale;
use App\Models\Project;
use App\Models\Collections;
use App\Models\Company_datails;
use App\Models\AdditionalAndDiscount;   
use Illuminate\Http\Request;

class ProjectReportController extends Controller
{
    public function index()
    {
        $data =  Flat::orderBy('id','desc')->get();
        $projects =  Project::orderBy('id','desc')->get();
        return view('admin.projectReport.index',compact('data','projects'));
    }
    public function store(Request $request)
    {
        $projectID = $request->projectID;
        $projectDetails = self::projectDetails($projectID);
        $companyData = Company_datails::find(1);
        $projects =  Project::find($projectID);
        return view('admin.projectReport.printData',compact('companyData','projectDetails','projects'));
    }
    
    public function projectDetails($projectID)
    {
        $flats = Flat::leftJoin('flat_sales', 'flats.id', '=', 'flat_sales.flatID')
        ->leftJoin('clients', 'flat_sales.clientID', '=', 'clients.id')
        ->select('clients.name','flats.flatName','flats.id','flat_sales.totalPrice','clients.contact_no','flat_sales.clientID')
        ->where('flat_sales.resale',0)
        ->where('flats.projectID',$projectID)
        ->orWhere('clients.name',null)
        ->where('flats.projectID',$projectID)
        ->orderBy('flats.flatName','asc')
        ->get();

        for($i=0;$i<count($flats);$i++){
            $flats[$i]['collections'] = Collections::where('flatID',$flats[$i]['id'])->where('clientID',$flats[$i]['clientID'])->where('status',1)->sum('amount');
            $flats[$i]['additional'] = AdditionalAndDiscount::where('flatID',$flats[$i]['id'])->where('clientID',$flats[$i]['clientID'])->sum('additional');
            $flats[$i]['discount'] = AdditionalAndDiscount::where('flatID',$flats[$i]['id'])->where('clientID',$flats[$i]['clientID'])->sum('discount');
            $lastPaymentDate = Collections::where('flatID',$flats[$i]['id'])->where('clientID',$flats[$i]['clientID'])->orderBy('id','desc')->get()->first();
            if($lastPaymentDate){
                $flats[$i]['lastPaymentDate'] = $lastPaymentDate->date;
            }else{
                $flats[$i]['lastPaymentDate'] = '-';
            }
        }
        return $flats;
    }
}