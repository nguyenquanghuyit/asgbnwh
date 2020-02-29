<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tbl_order;
use App\Models\vwCurrentCode;
use Illuminate\Http\Request;


class vwCurrentCodeController extends Controller
{
    public function index()
    {
       $myData=vwCurrentCode::all();
       return $myData;
    }

  /*  public function store()
    {

    }*/

    public function show(Request $noidung)
    {
       $code=$noidung->Code;
       $arr=explode(" ",$code);
       $mang=array();
       $str=array();
       $strOrder=array();
       $strNo=array();

       foreach($arr as $item)
       {
           preg_match("/[A-Za-z0-9]{8,10}/", $item, $match);
           if($match!=null){
               $mydata=vwCurrentCode::where('Code',$match)->get();
               $myOrder=Tbl_order::where('CusomterOrderNo',$match)->get();
               if(sizeof($mydata)>0)
               {
                   array_push($str,$item);
               }
               else if(sizeof($myOrder)>0)
               {
                   array_push($strOrder,$item);
               }
              else
               {
                   array_push($strNo,$item);
               }
           }
       }
       if(count($str)>0)
       {
           array_push($mang,"Code");
           array_push($mang,vwCurrentCode::whereIn('Code',$str)->get());
       }
       if(count($strOrder)>0)
       {
           array_push($mang,"Order");
           array_push($mang,Tbl_order::whereIn('CusomterOrderNo',$strOrder)->get());
       }
       /*if(count($strNo)>0)
       {
           array_push($mang,"No info");
           array_push($mang,$strNo);
       }*/
       return $mang;//response()->json($mang);
    }
}
