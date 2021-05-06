<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use razorpay\Api\Api;
use Hash;
use Redirect;
use Session;
use App\CategoryModel;
use App\SubCategoryModel;
use App\AddCart;
use App\AppoinmentModel;
use App\Orders;
use App\PostQuestion;
use App\Bmi;
use Illuminate\Http\Request;
use DB;

class UserApi extends Controller
{

 public function UserApi(){
	 	$useriD=Auth::user()->id;
    $users=DB::select("select * from users where id='".$useriD."'");
    return response(['users'=>$users,'error'=>'0','message'=>'Welcome to BMI Home']);
}

// Add Category ................

public function postCategory(Request $req){
 $data = json_decode(file_get_contents('php://input'), true);

		 $db=new CategoryModel;
     $db->categoryName=$req->input('categoryName');
     $db->addedBy=Auth::user()->id;
     $db->save();
     return redirect::back();
	}

	public function getSubCategory(Request $req){
		 $getSubCategory=DB::select("select * from category");

		 return response(['id'=>$getSubCategory]);
	}

public function postSubCategory(Request $req){
 $data = json_decode(file_get_contents('php://input'), true);
 $db= new SubCategoryModel;
 $db->categoryId = $req->input('categoryId');
 $db->subCategoryName = $req->input('subCategoryName');
 $db->addedBy = Auth::user()->id;
 $db->save();
 return redirect::back();
	}

  public function getProducts(Request $req){

     $userId=Auth::user()->id;
		 // $getSubCategory=DB::select("select id.categoryId from products INNER JOIN category id.categoryId ");
     $getSubCategory=DB::table('products')->select('products.id','products.productName','category.categoryName','products.productPrice','products.productDiscount','products.ProductStatus','products.productImage','products.noOfItem','products.quantity','products.units','products.description','products.benefit','products.info','products.categoryId','products.subCategoryId')
         ->join('category','category.id','=','products.categoryId')->get();


		 return response(['products'=>$getSubCategory,'userId'=>$userId]);
	}

  public function addCart(Request $req){
    $data = json_decode(file_get_contents('php://input'), true);
    $db=new AddCart;
    $usridd=Auth::user()->id;
    $pdId=$data['productId'];
    $pdPrc=$data['productPrice'];
    $pdQnty=$data['quantity'];
    $userI=$data['userId'];


    $db=DB::select('select * from addcart where userId="'.$userI.'" AND productId="'.$pdId.'" AND status="pending"');
    if($db==true){
      $productPrice=$db[0]->productPrice;
      $newProduct=$pdQnty*$pdPrc;
      $updatePrice=$productPrice+$newProduct;
      DB::table('addcart')
           ->where('productId', $pdId)
           ->where('userId', $userI)
           ->where('status', 'pending')
           ->update(['productPrice' => $updatePrice]);
     return response(['message'=>"item Updated"]);
    }else{
      $priceCalculate=$data['quantity']*$data['productPrice'];
      $dbb=new AddCart;
     $dbb->userId= $data['userId'];
     $dbb->categoryId = $data['categoryId'];
     $dbb->subCategoryId = $data['subCategoryId'];
     $dbb->productId = $data['productId'];
     $dbb->quantity = $data['quantity'];
     $dbb->units = $data['units'];
     $dbb->productPrice = $priceCalculate;
     $dbb->save();
     return response(['message'=>"New Item Added"]);
    }
  //   foreach ($db as $sku) {
  //      $productId=($sku->productId);
  //      if($pdId==$productId){
  //        echo"Product update";
  //      }else{
  //        echo "Product Added";
  //      }
  // }



    // $db=AddCart::create($data);
    //return response(['addCart'=>$userData,'message'=>"Added into Cart"]);
  }

  public function getCart(){
    $userId=Auth::user()->id;
    $shares = DB::table('addcart')->select('products.id','products.productName','category.categoryName','addcart.productPrice','addcart.quantity','products.productImage','products.units')
   ->join('products', 'products.id', '=', 'addcart.productId')
   ->join('category', 'category.id', '=', 'addcart.categoryId')
   ->where('addcart.userId', '=', $userId)
   ->where('addcart.status', '=', "pending")
   ->get();
  // $calculate=DB::select("select * from addcart where userId='".$userId."' AND status='pending'");
   // $total = DB::table('addcart')->sum('productPrice')->where([['userID','=',$userId],['status','=','pending']]);

   $coutPrice=DB::table('addcart')
   ->where('status', 'pending')
   ->where('userId', $userId)
   ->sum(\DB::raw(
       'addcart.productPrice'
   ));


   $deliveryCharges=30;
   $total= $coutPrice+$deliveryCharges;

   if($items =DB::select('select * from addcart where status="pending" AND userId="'.$userId.'"')){;

   foreach ($items as $value) {
     $ax[]= $value->id;
     $productIds[]=$value->productId;
     $categoryId[]=$value->categoryId;

}
 $items_list=implode(",",$ax);
 $product_Ids=implode(",",$productIds);
 $category_Id=implode(",",$categoryId);

   return response(['myCart'=>$shares,'userId'=>$userId,'allProductPrice'=>$coutPrice,'deliveryCharges'=>$deliveryCharges,'totalPrice'=>$total,'cartId'=> $items_list,'productId'=>$product_Ids,'$category_Id'=>$category_Id]);
}else{
  return response(['message'=>"Cart is empty..."]);
}
  }
  public function getModel(Request $req){
    $data = json_decode(file_get_contents('php://input'), true);

      $userId=Auth::user()->id;
      $idd=$data['id'];
      $db=DB::select("select * from products where id='$idd'");
      return response(['modelDetails'=>$db,'userId'=>$userId]);
  }

 public function doctors(){

     $userId=Auth::user()->id;

     $db=DB::select("select * from doctordetail");
     return response(['doctors'=>$db,'userId'=>$userId]);
 }

 public function doctorDetail(Request $req){
     $data = json_decode(file_get_contents('php://input'), true);
     $userId=Auth::user()->id;
     $idd=$data['id'];
     $db=DB::table('doctordetail')
         ->where('id','=',$idd)
         ->get();
     return response(['doctors'=>$db,'userId'=>$userId]);
 }


 public function appoinment(Request $req){
     $data = json_decode(file_get_contents('php://input'), true);
     $db=new AppoinmentModel;
     $db->patientId=("Y".rand(0000,9999));
     $db->userID=$data['userId'];
     $db->doctorId=$data['doctorId'];
     $db->appoinmentDate=$data['appoinmentDate'];
     $db->appoinmentTime=$data['appoinmentTime'];
     $db->save();
     return response(['message'=>"Appoinment Booked"]);
 }
 public function reAppoinment(Request $req){
     $data = json_decode(file_get_contents('php://input'), true);
     $db=new AppoinmentModel;
     $db->patientId=("Y".rand(0000,9999));
     $db->userID=$data['userId'];
     $db->doctorId=$data['doctorId'];
     $db->appoinmentDate=$data['appoinmentDate'];
     $db->appoinmentTime=$data['appoinmentTime'];
     $db->typeoforder="Reordered";
     $db->save();
     return response(['message'=>"Re-Appoinment Booked"]);
 }

public function getBmi(){
  $userId=Auth::user()->id;
  $data=DB::select("select * from bmi where userId='".$userId."'");
  return response(['getBmi'=>$data]);
}

  public function bmi(Request $req){
      $data = json_decode(file_get_contents('php://input'), true);
      $userId=$data['userId'];
      $shares = DB::select("select * from users where id='".$userId."'");
      foreach($shares as $dd){
        $dob=$dd->dob;
      }

      $db=new Bmi;

      $db->userID=$data['userId'];
      $db->userAge=$data['userAge'];
      $db->userDob=  $dob;
      $db->userWeight=$data['userWeight'];
      $db->userHeight=$data['userHeight'];
      $db->save();
      return response(['message'=>"Calculated..."]);
  }

  public function orders(Request $req){
  $data = json_decode(file_get_contents('php://input'), true);
       $userId=$data['userId'];
       $prdId=$data['productId'];
       $ctid=$data['cartId'];
        $db=new Orders;

       $dbb=DB::select("select * from orders where userId='".$userId."'");
       if($dbb==true){
         $addrs=$data['address'];
         $array_of_ids=explode(',', $db->$ctid);
         DB::table('addcart')->whereIn('id', $array_of_ids)->update(array('status' => "paid",'address'=>$addrs));

         DB::table('orders')
              ->where('userId', $userId)
              ->update(['productId' => $prdId]);
         return response(['message'=>"Payment Succefull."]);
       }else{
         $db->userId = $data['userId'];
         $db->cartId = $data['cartId'];
         $db->categoryId = $data['categoryId'];
         $db->productId = $data['productId'];
         $db->address = $data['address'];

        $db->save();
        $addrs=$data['address'];
        $array_of_ids=explode(',', $db->cartId);
       DB::table('addcart')->whereIn('id', $array_of_ids)->update(array('status' => "paid",'address'=>$addrs));


        return response(['message'=>"Payment Succefull."]);
      }
  }


  public function getOrder(){
    $userId=Auth::user()->id;

    $orderList=DB::select("select * from orders where userId='".$userId."'");
    foreach($orderList as $orderList){
       // $cartId[]=$orderList->productId;
      $idd=$orderList->productId;
    $arr_id=(explode(",",$idd));


foreach($arr_id as $value){

        $data[]=DB::table('products')
                 ->where('id','=',$value)
                 ->get();


}

 for($i=0;$i<count($data);$i++)
 {
   $arr[]=$data[$i][0];
 }
 // echo "<pre>";
 //  print_r($arr);
 // return response(['orderList'=>$orderList,'data'=>$data]);
 $reOrders=DB::table('reOrder')
          ->join('products','products.id','=','reOrder.productId')
          ->where('userId','=',$userId)
          ->get();


        // foreach($arr as $prdct){
        //   foreach($reOrders as $pd){
        //     if($prdct->id==$pd->productId){
        //         echo "Re-Ordered";
        //     }
        //   }
        // }

    return response(["Orders"=>$arr,"reOrders"=>$reOrders]);



  }}


   public function postQuestion(Request $req){
     $data = json_decode(file_get_contents('php://input'), true);
     $db=new PostQuestion;
     $db->userId=$data['userId'];
     $db->questionId=$data['questionId'];
     $db->actionKey=$data['actionKey'];
     $db->healthstatus=Auth::user()->healthStatus;

     $db->save();
     return response(["message"=>"Okay..."]);

   }

   public function getQuestion(){
     $userId=Auth::user()->id;
     $questionBank=DB::select("select * from questionbank");
     return response(['question'=>$questionBank,'userId'=>$userId]);
   }

   public function getSbtReport(){
     $userId=Auth::user()->id;
     $reportYes=DB::table('postquestion')->select('questionbank.question','postquestion.actionKey')
     ->join('questionbank','questionbank.id',"=","postquestion.questionId")
     ->where('postquestion.userId',"=",$userId)
     ->where('postquestion.actionKey',"=","Yes")
     ->get();

     $reportNo=DB::table('postquestion')->select('questionbank.question','postquestion.actionKey')
     ->join('questionbank','questionbank.id',"=","postquestion.questionId")
     ->where('postquestion.userId',"=",$userId)
     ->where('postquestion.actionKey',"=","No")
     ->get();

     $totalYes=DB::table('postquestion')
               ->where('userId','=',$userId)
               ->where('actionKey','=',"yes")
               ->count();

     $totalNo=DB::table('postquestion')
               ->where('userId','=',$userId)
               ->where('actionKey','=',"no")
               ->count();

     $userHealth=DB::table('users')
               ->where('id','=',$userId)
               ->get('healthStatus');


     return response(['yesReport'=>$reportYes,'noReport'=>$reportNo,'totalYes'=>$totalYes,'totalNo'=>$totalNo,'userHealth'=>$userHealth]);
   }

   public function getAppoinment(){
     $userId=Auth::user()->id;
     $appoinmentList=DB::table('bookappoinment')
     ->select('bookappoinment.patientId','doctordetail.id','users.name','doctordetail.doctorName','doctordetail.doctorImage','doctordetail.doctorFee','bookappoinment.appoinmentTime','bookappoinment.appoinmentDate','doctordetail.doctorPosition')
     ->join('doctordetail','doctordetail.id','=','bookappoinment.doctorId')
     ->join('users','users.id','=','bookappoinment.userId')
     ->where('bookappoinment.userId','=',$userId)
     ->get();
     $reAppoinmentList=DB::table('bookappoinment')
     ->select('bookappoinment.patientId','users.name','doctordetail.doctorName','bookappoinment.appoinmentTime','bookappoinment.appoinmentDate')
     ->join('doctordetail','doctordetail.id','=','bookappoinment.doctorId')
     ->join('users','users.id','=','bookappoinment.userId')
     ->where('bookappoinment.userId','=',$userId)
     ->where('typeoforder','=','Reordered')
     ->get();
     return response(['previousAppoinment'=>$appoinmentList,'reAppoinmentList'=>$reAppoinmentList]);
   }


   public function postAgeAndBmi(Request $req){
     $data = json_decode(file_get_contents('php://input'), true);

          $userId=$data['userId'];
          $userDob=$data['userDob'];
          $userWeight=$data['userWeight'];
          $userHeight=$data['userHeight'];

          $bmi= $userWeight/($userHeight/100 * $userHeight/100);

          $bmiValue= round($bmi, 2);
          if($bmiValue<18.5){
            DB::table('users')
                 ->where('id', $userId)
                 ->update(['healthStatus' => "UnderWeight"]);
          }
          else if($bmiValue>18.5 && $bmiValue<25){
            DB::table('users')
                 ->where('id', $userId)
                 ->update(['healthStatus' => "Normal"]);
          }else if($bmiValue>25 && $bmiValue<30){
            DB::table('users')
                 ->where('id', $userId)
                 ->update(['healthStatus' => "OverWeight"]);
          }else if($bmiValue>30){
            DB::table('users')
                 ->where('id', $userId)
                 ->update(['healthStatus' => "Obese"]);
          }



     return response(["message"=>"Okay..."]);
   }


   public function replyAi(){
     $chat=DB::table('aiquestion')
           ->join('aianswer','aianswer.questionId','=','aiquestion.id')
           ->get();
     return response(['chatQ'=>$chat]);
   }

   public function ai(Request $req){
        $data = json_decode(file_get_contents('php://input'), true);

     $question=$data['aiQuestion'];
             $result = DB::table('aiquestion')
             // ->whereLike('aiQuestion', $question)
             ->where('aiQuestion', 'LIKE', "%{$question}%")
             ->get('aiAnswer');
             $otherQuestion=DB::table('aiquestion')->get();

             return response(["Ai"=>$result,'other'=>$otherQuestion]);
           }

   public function basicPackage(){
     $userId=Auth::user()->id;
     $package=DB::table('packagemanage')
     ->where('packageName','=','Basic')
     ->get();
     return response(['userId'=>$userId,'package'=>$package]);
   }

   public function standardPackage(){
     $userId=Auth::user()->id;
     $package=DB::table('packagemanage')
     ->where('packageName','=','Standard')
     ->get();
     return response(['userId'=>$userId,'package'=>$package]);
   }

   public function premiumPackage(){
     $userId=Auth::user()->id;
     $package=DB::table('packagemanage')
     ->where('packageName','=','Premium')
     ->get();
     return response(['userId'=>$userId,'package'=>$package]);
   }

   public function activePackage(Request $req){
     $data = json_decode(file_get_contents('php://input'), true);
     $userId = $data['userId'];
     $packageName = $data['packageName'];
     $packageLimit = $data['packageLimit'];
     DB::table('users')
          ->where('id', $userId)
          ->update(['packageName' => $packageName,'packageLimit'=>$packageLimit]);
    return response(['message'=>"Package activate successfuly"]);



   }


   public function reOrder(Request $req){
     $data = json_decode(file_get_contents('php://input'), true);
     $userId=Auth::user()->id;
     $value=array(
    'userId' => $userId,
    'categoryId' => $data['categoryId'],
    'productId' => $data['id'],
    'noOfItem' => $data['noOfItem'],
    'quantity' => $data['quantity'],
    'type'=>"Re-Ordered",
  );
   DB::table('reOrder')->insert($value);
   return response(['msg'=>"Re-Order successfuly"]);

   }

   public function doctorSearchBox(){
     $doctorCategory=DB::table('doctorCategory')->get();
     return response(['doctorCategory'=>$doctorCategory]);
   }

   public function doctorSearchList(Request $req){
     $data = json_decode(file_get_contents('php://input'), true);
      $searchIdd=$data['doctorCategory'];
      $doctorSearchList=DB::table('doctordetail')
                        ->where('doctorPosition', 'LIKE', "%$searchIdd%")
                        ->get();
       return response(['doctorList'=>$doctorSearchList]);
     }

  public function postFilter(Request $req){
    $data = json_decode(file_get_contents('php://input'), true);
    $filterValue=$data['filterValue'];
   if($filterValue=="asc"){
    $prdct=DB::table('products')->orderBy('productPrice', $filterValue)->get();
    return response(['products'=>$prdct]);
  }elseif($filterValue=="desc"){
    $prdct=DB::table('products')->orderBy('productPrice', $filterValue)->get();
    return response(['products'=>$prdct]);
  }elseif($filterValue=="newproduct"){
    $prdct=DB::table('products')->orderBy('id', 'desc')->get();
    return response(['products'=>$prdct]);
  }elseif($filterValue=="bestSeller"){
    $prdct=DB::table('products')->where('popularity', 'popular')->get();
    return response(['products'=>$prdct]);
     return response(['msg'=>"Polpular Not Found"]);
  }
  }


  public function getFilter(){
    $filterType=DB::table('filtertype')->get();
    return response(['filterType'=>$filterType]);
  }

  public function invoice(Request $req){
    $data = json_decode(file_get_contents('php://input'), true);
    $userId=$data['userId'];
    $productId=$data['productId'];

    $invoice=DB::table('addcart')
             ->select('users.name','products.id','addcart.created_at','products.productName','addcart.productPrice','addcart.quantity','addcart.units','addcart.productPrice','addcart.shippingCharges','addcart.paymentMode','addcart.address','addcart.userId','addcart.productId','products.categoryId')
             ->join('products','products.id','=','addcart.productId')
             ->join('users','addcart.userId','=','users.id')
             ->where('userId','=',$userId)
             ->where('productId','=',$productId)
             ->where('status','=','paid')
             ->get();
    return response(['invoice'=>$invoice]);
    }


   public function appoinmentInvoice(Request $req){

     $data = json_decode(file_get_contents('php://input'), true);
     $userId=$data['userId'];
     $doctorId=$data['doctorId'];
     $patientId=$data['patientId'];
     $appoinmentInvoice=DB::table('bookappoinment')
                        ->select(
                          'bookappoinment.userId',
                          'bookappoinment.patientId',
                          'doctordetail.Id',
                          'doctordetail.appoinmentDate',
                          'doctordetail.appoinmentTime',
                          'doctordetail.created_at',
                          'doctordetail.updated_at',
                          'doctordetail.doctorName',
                          'doctordetail.doctorPosition',
                          'doctordetail.doctorExperience',
                          'doctordetail.doctorImage',
                          'doctordetail.doctorRating',
                          'doctordetail.doctorTimingFrom',
                          'doctordetail.doctorTimingTo',
                          'doctordetail.doctorFee',
                          'doctordetail.aboutDoctor',
                          'doctordetail.doctorEnquiryNumber',
                          'doctordetail.address',
                          'users.name'

                          )
                        ->join('doctordetail','doctordetail.id','=','bookappoinment.doctorId')
                        ->join('users','users.id','=','bookappoinment.userId')
                        ->where('userId','=',$userId)
                        ->where('doctorId','=',$doctorId)
                        ->where('patientId','=',$patientId)
                        ->get();
    return response(['appoinmentInvoice'=>$appoinmentInvoice]);

   }

   public function week(){
     $userId=Auth::user()->id;
     $today =date('Y-m-d H:m:s');
     // $siteViewsDaily = $DB_CON->query("SELECT count(*), date(dt) FROM statistics GROUP BY date(dt) - INTERVAL 7 DAY")->fetchAll();
    //  $weekDate=DB::table('postquestion')
    //            ->where('userId','=',$userId)
    //            ->get('created_at');
    // print_r($weekDate);
    $week=DB::select('select * from postquestion where created_at >=date_sub(curdate(),INTERVAL 7 DAY) and created_at < date_add(curdate(),INTERVAL 1 DAY)');

    // $week=DB::select('select * from postquestion where created_at >=date_sub(curdate(),INTERVAL 7 DAY) and created_at < date_add(curdate(),INTERVAL 1 DAY)');
    $noUnderWeight=DB::table('postquestion')
                  ->where('created_at','>=',DB::raw('date_sub(curdate(),INTERVAL 7 DAY)'))
                  ->where('created_at','<', DB::raw('date_add(curdate(),INTERVAL 1 DAY)'))
                  ->where('actionKey','=','no')
                  ->where('healthstatus','underweight')
                  ->count();
    $yesUnderWeight=DB::table('postquestion')
                  ->where('created_at','>=',DB::raw('date_sub(curdate(),INTERVAL 7 DAY)'))
                  ->where('created_at','<', DB::raw('date_add(curdate(),INTERVAL 1 DAY)'))
                  ->where('actionKey','=','yes')
                  ->where('healthstatus','underweight')
                  ->count();
    $noNormal=DB::table('postquestion')
                  ->where('created_at','>=',DB::raw('date_sub(curdate(),INTERVAL 7 DAY)'))
                  ->where('created_at','<', DB::raw('date_add(curdate(),INTERVAL 1 DAY)'))
                  ->where('actionKey','=','no')
                  ->where('healthstatus','normal')
                  ->count();
    $yesNormal=DB::table('postquestion')
                  ->where('created_at','>=',DB::raw('date_sub(curdate(),INTERVAL 7 DAY)'))
                  ->where('created_at','<', DB::raw('date_add(curdate(),INTERVAL 1 DAY)'))
                  ->where('actionKey','=','yes')
                  ->where('healthstatus','normal')
                  ->count();
    $noOverWeight=DB::table('postquestion')
                  ->where('created_at','>=',DB::raw('date_sub(curdate(),INTERVAL 7 DAY)'))
                  ->where('created_at','<', DB::raw('date_add(curdate(),INTERVAL 1 DAY)'))
                  ->where('actionKey','=','no')
                  ->where('healthstatus','overweight')
                  ->count();
    $yesOverWeight=DB::table('postquestion')
                  ->where('created_at','>=',DB::raw('date_sub(curdate(),INTERVAL 7 DAY)'))
                  ->where('created_at','<', DB::raw('date_add(curdate(),INTERVAL 1 DAY)'))
                  ->where('actionKey','=','yes')
                  ->where('healthstatus','overweight')
                  ->count();
    $noObesity=DB::table('postquestion')
                  ->where('created_at','>=',DB::raw('date_sub(curdate(),INTERVAL 7 DAY)'))
                  ->where('created_at','<', DB::raw('date_add(curdate(),INTERVAL 1 DAY)'))
                  ->where('actionKey','=','no')
                  ->where('healthstatus','Obese')
                  ->count();
    $yesObesity=DB::table('postquestion')
                  ->where('created_at','>=',DB::raw('date_sub(curdate(),INTERVAL 7 DAY)'))
                  ->where('created_at','<', DB::raw('date_add(curdate(),INTERVAL 1 DAY)'))
                  ->where('actionKey','=','yes')
                  ->where('healthstatus','Obese')
                  ->count();


    $userHealth=DB::table('users')
                  ->where('id','=',$userId)
                  ->get('healthStatus');
    return response(['noUnderWeight'=>$noUnderWeight,'yesUnderWeight'=>$yesUnderWeight,'noNormal'=>$noNormal,'yesNormal'=>$yesNormal,'noOverWeight'=>$noOverWeight,'yesOverWeight'=>$yesOverWeight,'noObesity'=>$noObesity,'yesObesity'=>$yesObesity,'userHealth'=>$userHealth]);

   }


   public function month(){

     $userId=Auth::user()->id;
     $currentMonth = date('m');
     $month= DB::table("postquestion")
            ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->get();
    $noUnderWeight= DB::table("postquestion")
           ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
           ->whereRaw('actionKey = ?','no')
           ->whereRaw('healthstatus = ?','underweight')
           ->count();
    $yesUnderWeight= DB::table("postquestion")
           ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
           ->whereRaw('healthstatus = ?','underweight')
           ->count();

    $noNormal= DB::table("postquestion")
           ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
           ->whereRaw('actionKey = ?','no')
           ->whereRaw('healthstatus = ?','normal')
           ->count();
    $yesNormal= DB::table("postquestion")
           ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
           ->whereRaw('healthstatus = ?','normal')
           ->count();

    $noOverWeight= DB::table("postquestion")
           ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
           ->whereRaw('actionKey = ?','no')
           ->whereRaw('healthstatus = ?','overweight')
           ->count();
    $yesOverWeight= DB::table("postquestion")
           ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
           ->whereRaw('healthstatus = ?','overweight')
           ->count();

    $noObesity= DB::table("postquestion")
           ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
           ->whereRaw('actionKey = ?','no')
           ->whereRaw('healthstatus = ?','Obese')
           ->count();
    $yesObesity= DB::table("postquestion")
           ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
           ->whereRaw('actionKey = ?','yes')
           ->whereRaw('healthstatus = ?','Obese')
           ->count();

    $userHealth=DB::table('users')
               ->where('id','=',$userId)
               ->get('healthStatus');
    return response(['noUnderWeight'=>$noUnderWeight,'yesUnderWeight'=>$yesUnderWeight,'noNormal'=>$noNormal,'yesNormal'=>$yesNormal,'noOverWeight'=>$noOverWeight,'yesOverWeight'=>$yesOverWeight,'noObesity'=>$noObesity,'yesObesity'=>$yesObesity,'userHealth'=>$userHealth]);
   }

     public function year(){
       $userId=Auth::user()->id;
       $year=DB::table('postquestion')
             ->whereYear('created_at', date('Y'))
             ->get();
       $noUnderWeight= DB::table("postquestion")
             ->whereYear('created_at', date('Y'))
             ->whereRaw('actionKey = ?','no')
             ->whereRaw('healthstatus = ?','underWeight')
             ->count();
       $yesUnderWeight= DB::table("postquestion")
             ->whereYear('created_at', date('Y'))
             ->whereRaw('actionKey = ?','yes')
             ->whereRaw('healthstatus = ?','underWeight')
             ->count();

       $noNormal= DB::table("postquestion")
             ->whereYear('created_at', date('Y'))
             ->whereRaw('actionKey = ?','no')
             ->whereRaw('healthstatus = ?','normal')
             ->count();
       $yesNormal= DB::table("postquestion")
             ->whereYear('created_at', date('Y'))
             ->whereRaw('actionKey = ?','yes')
             ->whereRaw('healthstatus = ?','normal')
             ->count();

       $noOverWeight= DB::table("postquestion")
             ->whereYear('created_at', date('Y'))
             ->whereRaw('actionKey = ?','no')
             ->whereRaw('healthstatus = ?','overweight')
             ->count();
       $yesOverWeight= DB::table("postquestion")
             ->whereYear('created_at', date('Y'))
             ->whereRaw('actionKey = ?','yes')
             ->whereRaw('healthstatus = ?','overweight')
             ->count();

       $noObesity= DB::table("postquestion")
             ->whereYear('created_at', date('Y'))
             ->whereRaw('actionKey = ?','no')
             ->whereRaw('healthstatus = ?','Obese')
             ->count();
       $yesObesity= DB::table("postquestion")
             ->whereYear('created_at', date('Y'))
             ->whereRaw('actionKey = ?','yes')
             ->whereRaw('healthstatus = ?','Obese')
             ->count();



       $userHealth=DB::table('users')
             ->where('id','=',$userId)
             ->get('healthStatus');

      return response(['noUnderWeight'=>$noUnderWeight,'yesUnderWeight'=>$yesUnderWeight,'noNormal'=>$noNormal,'yesNormal'=>$yesNormal,'noOverWeight'=>$noOverWeight,'yesOverWeight'=>$yesOverWeight,'noObesity'=>$noObesity,'yesObesity'=>$yesObesity,'userHealth'=>$userHealth]);


     }

     public function getBlog(Request $req){
         $blog=DB::table('addblog')
               ->join('blogimage','blogimage.id','=','addblog.imgg')
               ->get();
         // $blogImage=DB::table('blogimage')->get();
         return response(['blog'=>$blog]);
     }

     public function leaveMessage(Request $req){
       $data = json_decode(file_get_contents('php://input'), true);
       $userId=$data['userId'];
       $email=$data['email'];
       $yourMessage=$data['yourMessage'];
       $value=array(
           'userId' => $userId,
           'email' => $email,
           'yourMessage' => $yourMessage
       );

       DB::table('leavemessage')->insert($value);

       return response(['msg'=>"Thank you!"]);
      }

     public function subscribeEmail(Request $req){
       $data = json_decode(file_get_contents('php://input'), true);
       $userId=$data['userId'];
       $email=$data['email'];
        $value=array(
          'userId'=> $userId,
          'email'=> $email
        );

       DB::table('subscribeemail')->insert($value);
       return response(['msg'=>"Thank you for Subscribe"]);
     }

     public function getFaq(){
       $faq=DB::table('addfaq')->get();
       return response(['faq'=>$faq]);
     }

     public function addCalender(Request $req){

       $data = json_decode(file_get_contents('php://input'), true);
       $dateOfEvent=date('Y-m-d h:i:s', strtotime($data['dateOfEvent']));
       $value=array(
         'userId' => $data['userId'],
         'title' => $data['title'],
         'description' => $data['description'],
         'dateOfEvent' =>$dateOfEvent ,
       );
       DB::table('calenderevent')->insert($value);
       return response(['msg'=>"Event Created"]);
     }

     public function getEvent(){
       $userId=Auth::user()->id;
       $event=DB::table('calenderevent')
              ->where('userId','=',$userId)
              ->get();
      return response(['event'=>$event]);
     }

     public function deliveryStatus(){
         $userId=Auth::user()->id;
         $deliveryStatus=DB::table('addcart')
                         ->select('products.id','products.productImage','products.productName','addcart.deliveryStatus','addcart.created_at')
                         ->join('products','products.id','=','addcart.productId')
                         ->where('userId','=',$userId)
                         ->where('deliveryStatus','=','deliverd')
                         ->get();

          return response(['newNotification'=>$deliveryStatus]);
     }

     public function addChatBot(Request $req){
        $data = json_decode(file_get_contents('php://input'), true);
        $userId = $data['userId'];
        $formvalue = $data['formvalue'];
        $value=array(
              'userId' =>$userId,
              'formvalue' =>$formvalue
            );
        DB::table('getchatbot')->insert($value);
        return response(['msg'=>"ok"]);

     }

     public function number(Request $req){
       $data = json_decode(file_get_contents('php://input'), true);
       $mobnumber = $data['mobnumber'];

       $chars = "0123456789";
$otpval = "";
for ($i = 0; $i < 6; $i++)
{
$otpval .= $chars[mt_rand(0, strlen($chars)-1)];
}
$otpValue=bcrypt($otpval);
$mobnmbr=DB::table('users')->get('mobnumber');


foreach($mobnmbr as $nmbr){
  $userMoblieNumber=$nmbr->mobnumber;
  if($userMoblieNumber==$mobnumber){

      DB::table('users')
            ->where('mobnumber',$mobnumber)
            ->update(['password' => $otpValue]);
            $msg="Your Login OTP:".$otpval;
            $tonumber=$mobnumber;
            // $this->send_otp_sms($msg,$tonumber);
            //  return response(['msg'=>"OTP sent successfuly",'otp'=>$otpval]);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=LtZF0JD4fonxwsIWpjB7OeAmiXME82RUV31YTg6ubrCazQSNkyjiy0hs3dR2agMXc6Vt5vTSDIAYFu8r&sender_id=TXTIND&message=".urlencode('Tarawithyou Login Otp : '.$otpval)."&route=v3&numbers=".urlencode($tonumber),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {

return response(['msg'=>"OTP sent successfuly"]);
}
  }
}


    $value=array(
     'mobnumber'=>$mobnumber,
     'password'=>$otpValue,
    );
    DB::table('users')->insert($value);
    $msg="Your Login OTP:".$otpval;
    $tonumber=$mobnumber;
    // $this->send_otp_sms($msg,$tonumber);
    //  return response(['msg'=>"OTP sent successfuly",'otp'=>$otpval]);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=LtZF0JD4fonxwsIWpjB7OeAmiXME82RUV31YTg6ubrCazQSNkyjiy0hs3dR2agMXc6Vt5vTSDIAYFu8r&sender_id=TXTIND&message=".urlencode('Tarawithyou Login Otp : '.$otpval)."&route=v3&numbers=".urlencode($tonumber),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      return response(['msg'=>"OTP sent successfuly"]);
    }
      }




//
// public function send_otp_sms($msg,$tonumber)
// {
// $data = array(
//               'apikey' => "75428ef8-7f1f-4127-8535-686cbf844e6f",
//               'clientid' => "817ec697-4eea-4934-a179-975c558e3e26",
//               'msisdn' => $tonumber,
//               'sid' => "GREATP",
//               'msg' => $msg,
//               'fl' =>"0",
//               "gwid" =>"2"
//           );
//   list($header, $content) = $this->PostRequest("http://sms.orionservices.in/vendorsms/pushsms.aspx",
//       $data
//   );
//   return $content;
// }
//
// public function PostRequest($url, $_data) {
// // convert variables array to string:
//   $data = array();
//   //while(list($n,$v) = each($_data))
// foreach( $_data as $key => $file )
//   {
//       $data[] = "$key=$file";
//   }
//   $data = implode('&', $data);
//   // format --> test1=a&test2=b etc.
//   // parse the given URL
//   $url = parse_url($url);
//   if ($url['scheme'] != 'http') {
//       die('Only HTTP request are supported !');
//   }
//   // extract host and path:
//   $host = $url['host'];
//   $path = $url['path'];
//   // open a socket connection on port 80
//   $fp = fsockopen($host, 80);
//   // send the request headers:
//   fputs($fp, "POST $path HTTP/1.1\r\n");
//   fputs($fp, "Host: $host\r\n");
//   fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
//   fputs($fp, "Content-length: ". strlen($data) ."\r\n");
//   fputs($fp, "Connection: close\r\n\r\n");
//   fputs($fp, $data);
//   $result = '';
//   while(!feof($fp)) {
//       // receive the results of the request
//       $result .= fgets($fp, 128);
//   }
//   // close the socket connection:
//   fclose($fp);
//   // split the result header from the content
//   $result = explode("\r\n\r\n", $result, 2);
//   $header = isset($result[0]) ? $result[0] : '';
//   $content = isset($result[1]) ? $result[1] : '';
//   // return as array:
//   return array($header, $content);
// }

    public function removeNotifi(Request $req){
      $data = json_decode(file_get_contents('php://input'), true);
      $userId = $data['userId'];
      $productId=$data['productId'];
      DB::table('addcart')
           ->where('userId', $userId)
           ->where('productId', $productId)
           ->where('status', 'paid')
           ->update(['deliveryStatus' => "removed"]);
      return response(['msg'=>"Notification removed"]);
    }


   public function getAllReport(){
     $userId=Auth::user()->id;
     $data=DB::table('users')
           ->where('id','=',$userId)
           ->get();

     $typeOfPackage=$data[0]->packageName;
     if($typeOfPackage=="basic"){
       echo "Basic Package Subscribe";
     }else if($typeOfPackage=="standard"){
       echo "Standard Package Subscribe";
     }else if($typeOfPackage=="premium"){
       echo "Premium Package Subscribe";
     }

    }





}
