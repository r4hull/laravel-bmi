<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use Redirect;
use App\ProductModel;
use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\QuestionBank;
use DB;
class AdminController extends Controller
{
	use AuthenticatesUsers;

     	 /**
     * Where to redirect users after login.
     *
     * @var string
     */

     public function adminlogin(){

     	 return json_encode(User::All());
     }

     public function adminPost(Request $req){

            return("sussess");
     }

			 public function getProduct(){
				   $category=DB::select("select * from category");
           return view("ecommerce.getProduct",['category'=>$category]);
			 }
			 public function postProduct(Request $req){

				 $db=new ProductModel;
				 $file = $req->file('productImage');
         $file->getClientOriginalExtension();
         $file->getRealPath();
         $file->getSize();
         $file->getMimeType();
				  $db->categoryId = $req->input("categoryId");
					$db->subCategoryId = $req->input("subCategoryId");
					$db->productName = $req->input("productName");
					$db->productPrice = $req->input("productPrice");
					$db->productDiscount = $req->input("productDiscount");
					$db->ProductStatus = $req->input("ProductStatus");
					$db->productImage = url('/productUploads')."/".$file->getClientOriginalName();
					$db->description = $req->input("description");
					$db->noOfItem = $req->input("noOfItem");
					$db->benefit = $req->input("benefit");
					$db->info = $req->input("info");
					$db->quantity = $req->input("quantity");
					$db->units = $req->input("grams");
         //  $data = json_decode(file_get_contents('php://input'), true);
        // $user=ProductModel::create($req->all());
				$destinationPath = base_path().'/public/productUploads';
				$file->move($destinationPath,$file->getClientOriginalName());
				$db->save();
				return redirect::back();
			 }

			 public function getCategory(){
				  $category=DB::select("select * from category");
					 return view("ecommerce.getCategory",['category'=>$category]);
			 }

			 public function getSubCategory(){
				   $category=DB::select("select * from category ")
					 ;
					$subCategory= DB::table('subcategory')
               ->select('category.categoryName','subcategory.subCategoryName')
               ->join('category','category.id','=','subcategory.categoryId')
               ->get();


           return view("ecommerce.getSubCategory",['category'=>$category,'subCategory'=>$subCategory]);
			 }

			 public function listProduct(){

					$products= DB::table('products')
               ->select('products.productName','subcategory.subCategoryName','category.categoryName')
               ->join('category','category.id','=','products.categoryId')
               ->join('subcategory','subcategory.id','=','products.subCategoryId')
               ->get();


           return view("ecommerce.productList",['products'=>$products]);
			 }

             public function doctor(){
							     $doctor=DB::table('doctordetail')->get();
                   return view('consult.doctor',['doctor'=>$doctor]);
						 }
             public function consult(){
                  return view('consult.getConsult');
						 }


             public function getQuestion(){
							 $question=DB::select("select * from questionbank");
							 return view("chatbot.sbt",['question'=>$question]);
						 }
						 public function question(Request $req){
               $file = $req->file('questionImage');
							 $file->getClientOriginalExtension();
							 $destinationPath = base_path().'/public/questionImage';

							 $db=new QuestionBank;
							 $db->question=$req->input('question');
							 $db->questionImage=url('/questionImage')."/".$file->getClientOriginalName();
							 $db->questionCategory=$req->input('questionCategory');
							 $db->save();
							 $file->move($destinationPath,$file->getClientOriginalName());
							 return redirect::back();
						 }


						 public function postDoctor(Request $req){
               $file = $req->file('doctorImage');
							 $file->getClientOriginalExtension();
							 $destinationPath = base_path().'/public/doctorImage';

							 $db=new Doctor;
	             $db->doctorName = $req->input('doctorName');
	             $db->doctorPosition = $req->input('doctorPosition');
	             $db->doctorExperience = $req->input('doctorExperience');
	             $db->doctorImage = url('/doctorImage')."/".$file->getClientOriginalName();
	             $db->doctorRating = $req->input('doctorRating');
	             $db->doctorTimingFrom = $req->input('doctorTimingFrom');
	             $db->doctorTimingTo = $req->input('doctorTimingTo');
	             $db->doctorFee = $req->input('doctorFee');
	             $db->aboutDoctor = $req->input('aboutDoctor');
	             $db->doctorEnquiryNumber = $req->input('doctorEnquiryNumber');
	             $db->appoinmentDate = $req->input('appoinmentDate');
	             $db->appoinmentTime = $req->input('appoinmentTime');
							 $db->save();
							 $file->move($destinationPath,$file->getClientOriginalName());
							 return redirect::back();
						 }


						 public function chatbotQ(){
							 return view('chatbot.chatbotq');
						 }

						 public function aiChat(Request $req){


							 $value=array(
								 'aiQuestion'=>$req->input('aiQuestion'),
								 'aiAction'=>$req->input('aiAction'),
								 'aiAnswer'=>$req->input('aiAnswer'),
							 );
							 DB::table('aiquestion')->insert($value);
							 $db=DB::table('aiquestion')->where('aiQuestion','=',$req->input('aiQuestion'))->get();
							 foreach($db as $d){
								 $valueaia=array(
									 'questionId'=>$d->id,
									 'aiAction'=>$d->aiAction,
									 'aiAnswer'=>$req->input('aiAnswer'),
								 );
								 DB::table('aianswer')->insert($valueaia);

							 }
							 return redirect::back();
						 }

						 public function testChatbot(){
							 return view('chatbot.testchatbot');
						 }

						 public function message(Request $req){

                  $name= $req->value;
									// $result = DB::table('aiquestion')
									// ->whereLike('aiQuestion', $req->value)
									// ->get('aiAnswer');
									$result=DB::table('aiquestion')->where('aiQuestion', 'LIKE', "%$name%")->get('aiAnswer');
                 $value=json_decode($result);
								 echo ($value);

						 }

						 public function package(){
							 $addPackage=DB::table('packagemanage')->get();
							 return view('package.manage',['addPackage'=>$addPackage]);
						 }
						 public function addPackage(Request $req){
							 $value=array(
								 'packageName'=> $req->input('choosePkg'),
								 'packageCost'=> $req->input('packageCost'),
								 'packageLimit'=> $req->input('packageLimit'),
								 'valueone'=> $req->input('valueone'),
								 'valuetwo'=> $req->input('valuetwo'),
								 'valuethree'=> $req->input('valuethree'),
							 );
							 DB::table('packagemanage')->insert($value);
							 return redirect::back();
						 }

						 public function blog(){
							 return view('blog.blog');
						 }

						 public function addPost(Request $req){
							 $value=array(
							 'postName'=>$req->input('postName'),
               'postDetail'=>$req->input('postDetail'),
						   );
							 DB::table('addblog')->insert($value);
							 return redirect::back();
						 }

						 public function faq(){
							 return view('faq.faq');
						 }

						 public function addFaq(Request $req){
							 $value=array(
							 'faqName'=>$req->input('faqName'),
               'faqDetail'=>$req->input('faqDetail'),
						   );
							 DB::table('addfaq')->insert($value);
							 return redirect::back();
						 }

						 public function updateImage(Request $req){

							 $file = $req->file('blogImg');
							 $file->getClientOriginalExtension();
							 $img=url('public/blogImage/'.$file->getClientOriginalName());

							 $destinationPath = public_path('/blogImage/');
               $file->move($destinationPath,$file->getClientOriginalName());


           DB::update('update blogimage set blogImage = ? where id = ?',[$img,1]);

							 return redirect::back();
						 }



}
