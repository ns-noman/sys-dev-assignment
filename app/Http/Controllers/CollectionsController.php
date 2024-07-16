<?php

namespace App\Http\Controllers;

use App\Models\Collections;
use App\Models\Project;
use App\Models\Client;
use App\Models\Flat;
use App\Models\Company_datails;
use App\Models\FlatSale;
use App\Models\AdditionalAndDiscount;
use Auth;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('name','asc')->get();
        return view('admin.collections.index',compact('projects'));
    }
    public function findCustomers($fid)
    {
        return $clients = FlatSale::where('flatID',$fid)->select('clientID','clientName')->get();
    }
    public function collectionDetails($pid=null,$fid=null,$cid=null)
    {
        if($pid && $fid && $cid){
            $collections = Collections::where('projectID',$pid)->where('flatID',$fid)->where('clientID',$cid)->get();
        }else{
            $collections = Collections::where('status',0)->get();
        }
        
        if(count($collections)){
            return ['success'=>1,'collections'=>$collections];
        }else{
            return ['success'=>0];
        }
      
    }
    
    
    public function loadFlats($id)
    {   
        return $flats = Flat::where('projectID',$id)->where('status',1)->get();
    }

    public function updateStatus($id)
    {   
        $collections  = Collections::find($id);
        $projectID = $collections->projectID;
        $flatID = $collections->flatID;
        $clientID = $collections->clientID;
        $collections->update(['status'=>1]);
        self::updateFlatCompleteSt($projectID,$flatID,$clientID);
        return true;
    }
    
    public function collectionDelete($id)
    {   
        $collections  = Collections::find($id);
        
        $projectID = $collections->projectID;
        $flatID = $collections->flatID;
        $clientID = $collections->clientID;
        Collections::destroy($id);
        self::updateFlatCompleteSt($projectID,$flatID,$clientID);
        return true;
    }
    public function create()
    {
        $projects = Project::orderBy('name','asc')->get();
        return view('admin.collections.create',compact('projects'));
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
            'amount'=>$request->amount,
            'transactionMethod'=>$request->transactionMethod,
            'note'=>$request->note,
            'createdByID'=>$userID,
            'createdByName'=>$userName,
            'status'=>0,
        ];
        Collections::create($data);
        return redirect('collections');
    }
    
    public function updateFlatCompleteSt($pid,$fid,$cid)
    {
        $flaltPrice = FlatSale::where('projectID',$pid)
                    ->where('flatID',$fid)
                    ->where('clientID',$cid)
                    ->get()->first()->totalPrice;

        $totalCollection = Collections::where('projectID',$pid)
                    ->where('flatID',$fid)
                    ->where('clientID',$cid)
                    ->where('status',1)
                    ->sum('amount');

        $addAndDiscData = AdditionalAndDiscount::where('projectID',$pid)
                    ->where('flatID',$fid)
                    ->where('clientID',$cid)
                    ->where('status',1);

        $additional = $addAndDiscData->sum('additional');
        $discount = $addAndDiscData->sum('discount');
        $due = ($flaltPrice + $additional - $discount) - $totalCollection;
        $deliveryStatus = $due <=0 ? 1 : 0;
        Flat::find($fid)->update(['deliveryStatus'=>$deliveryStatus]);
    }

    public function edit($id)
    {
        $collections = Collections::find($id);
        $flats = Flat::where('projectID',$collections->projectID)->where('status',1)->get();
        $projects = Project::orderBy('name','asc')->get();
        $clients = self::findCustomers($collections->flatID);
        return view('admin.collections.edit',compact('projects','collections','flats', 'clients'));
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
            'amount'=>$request->amount,
            'transactionMethod'=>$request->transactionMethod,
            'note'=>$request->note,
            'createdByID'=>$userID,
            'createdByName'=>$userName,
        ];
        Collections::find($id)->update($data);

        $collections  = Collections::find($id);
        $projectID = $collections->projectID;
        $flatID = $collections->flatID;
        $clientID = $collections->clientID;
        self::updateFlatCompleteSt($projectID,$flatID,$clientID);
        return redirect('collections'); 
    }

    public function collectionMoneyReceipt($id)
    {
        
        $companyData = Company_datails::find(1);

        $collections = Collections::find($id);
        $projectID = $collections->projectID;
        $flatID = $collections->flatID;
        $clientID = $collections->clientID;
        $date = $collections->date;
        $client = Client::find($clientID);
        $totalCollectionBeforeThisDate = Collections::where('projectID',$projectID)->where('flatID',$flatID)->where('clientID',$clientID)->where('date','<=',$date)->where('id','!=',$id)->where('status',1)->sum('amount');
        $flatDetails =  FlatSale::where('projectID',$projectID)->where('flatID',$flatID)->where('clientID',$clientID)->get()[0];
        $totalCollectionBeforeThisDate = Collections::where('projectID',$projectID)->where('flatID',$flatID)->where('clientID',$clientID)->where('date','<=',$date)->where('id','!=',$id)->where('status',1)->sum('amount');
        $address = Project::find($projectID)->address;
        $flatDetails['address'] = $address;
        $additional = AdditionalAndDiscount::where('projectID',$projectID)->where('flatID',$flatID)->where('clientID',$clientID)->sum('additional');
        $discount = AdditionalAndDiscount::where('projectID',$projectID)->where('flatID',$flatID)->where('clientID',$clientID)->sum('discount');
        $flatDetails['additional'] = $additional;
        $flatDetails['discount'] = $discount;
        $currencyInWord = self::getBangladeshCurrency($collections->amount);
        $currencyInWordTotal = self::getBangladeshCurrency($collections->amount + $totalCollectionBeforeThisDate);
        return view('admin.collections.moneyReceipt',compact('companyData','flatDetails','date','totalCollectionBeforeThisDate','collections','client','currencyInWord','currencyInWordTotal'));
    }
    public function getBangladeshCurrency($number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Taka = implode('', array_reverse($str));
        $poysa = ($decimal) ? " and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' poysa' : '';
        return ($Taka ? $Taka . 'taka ' : '') . $poysa ;
    }

}