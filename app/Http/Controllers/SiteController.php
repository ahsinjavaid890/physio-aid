<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\User; 
use App\Mail\Offers;
use App\Models\categories;
use App\Models\subcategories;
use App\Models\cases;
use App\Models\casecomments;
use App\Models\adminnotifications;
use App\Models\blogs;
use App\Models\contactus;
use App\Models\followusers;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Mail;
class SiteController extends Controller
{
   public function indexview()
   {
      $data = user::where('is_admin' , 2)->where('status' , 0)->where('block' , 0)->limit(6)->get();
      $blogs = blogs::where('status' , 1)->where('deletestatus' , 1)->get();
      return view('frontend.index')->with(array('data'=>$data,'blogs'=>$blogs));
   }
   public function slugify($text)
   {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
          return 'n-a';
        }
        return $text;
   }
   public function checkurl($id)
   {
      $url = DB::table('siteurls')->where('url', $id)->first();
      if(!empty($url))
      {
        $modalname = $url->modalname;
        if($modalname == "messages")
        {
          return view('frontend.chatbox');
        }
        elseif ($modalname == "user-profile") {
           if(Auth::check()){
             $data = DB::table('countries')->get();
             return view('frontend.user-profile')->with(array('countries'=>$data));
           }else{
            return redirect()->route('login');
           }
        }
        elseif ($modalname == "user-dashboard") {
           if(Auth::check()){
            $savedurl = DB::table('siteurls')->where('url', Auth::user()->username)->count();
            if($savedurl == 0)
            {
                $username = Auth::user()->username;
                DB::statement("INSERT INTO `siteurls` (`url`, `modalname`)VALUES ('$username', 'username')");
            }
            // $data = cases::where('users' , Auth::user()->id)->where('status' , 1)->orderby('orderid' , 'DESC')->get();
            return view('frontend.user-dashboard');
          }else{
            return redirect()->route('login');
          }
        }
        elseif ($modalname == "login") {
          return view('auth.login');
        }
        elseif ($modalname == "signup") {
          $data = DB::table('countries')->get();
          return view('auth.register')->with(array('data'=>$data));
        }
        elseif ($modalname == "forgot-password") {
           return view('auth.passwords.email');
        }
        elseif ($modalname == "categories") {
          $parentcategory = categories::where('url' , $id)->get()->first();
          $data = subcategories::where('status' , 1)->where('parentcategory' , $parentcategory->id)->get();
          $categories = categories::where('status' , 1)->get();
          $users = user::all();
          return view('frontend.sub-categories')->with(array('data'=>$data,'parent'=>$parentcategory,'allcategories'=>$categories,'users'=>$users));
        }
        elseif ($modalname == "members-network") {
          $data = User::all();
           $ip_address =  $this->getUserIpAddr();


           // $ip_address =  '182.188.148.57';

          $ipInfo = $this->grabIpInfo($ip_address);
          $ipdata =  json_decode($ipInfo);
          $lattitude =  $ipdata->geo->latitude;
          $longitude =  $ipdata->geo->longitude;
          return view('frontend.members-network')->with(array('data'=>$data,'userlatitide'=>$lattitude,'userlongitude'=>$longitude));
        }
        elseif ($modalname == "add-case") {
          if(Auth::check()){
            $subcategory = subcategories::where('status' , 1)->get();
            $parentcategory = categories::where('status' , 1)->get();
            return view('frontend.add-case')->with(array('subcategory'=>$subcategory,'parent'=>$parentcategory));
          }else{
            return redirect()->route('login');
          }
        }
        elseif ($modalname == "username") {
          $data = DB::table('users')->where('username', $id)->first();
          $cases = cases::where('users' , $data->id)->where('status' , 1)->orderby('orderid' , 'DESC')->get();
          // $categories = categories::where('status' , 1)->where('id' , $data->)->get()->first();
          $casecount = $cases->count();
          return view('frontend.members-profile')->with(array('data'=>$data ,'cases'=>$cases,'casecount'=>$casecount));
        }
        elseif ($modalname == "case") {

          $ip_address =  $this->getUserIpAddr();
          $case = cases::where('url' , $id)->get()->first();
          DB::statement("INSERT INTO `casevisitors` (`ipaddress`, `visitorcase`)VALUES ('$ip_address', '$case->id')");
          // $getcasevisitors =  DB::table('casevisitors')->where('ipaddress', $ip_address)->where('visitorcase', $case->id)->count();


          // if($getcasevisitors == 0)
          // {
          //   DB::statement("INSERT INTO `casevisitors` (`ipaddress`, `visitorcase`)VALUES ('$ip_address', '$case->id')");
          // }
          
          $sendvisitor =  DB::table('casevisitors')->where('ipaddress', $ip_address)->where('visitorcase', $case->id)->count();

          $category = categories::where('id' , $case->categories)->get()->first();
          $allcategories = categories::where('status' , 1)->get();
          $subcategories = subcategories::where('id' , $case->subcategories)->get()->first();
          $user = DB::table('users')->where('id', $case->users)->first();
          $casecomments = casecomments::where('status' , 1)->where('caseid' ,$case->id)->get();
          $totalreviews = $casecomments->count();
            if(!empty($totalreviews)){
            $reviewssum = $casecomments->sum('reviews');
            $star = $reviewssum/$totalreviews;
          }else{
            $star = 0;
          }
          $caseimages = DB::table('caseimages')->where('caseid' , $case->id)->get();
          return view('frontend.case-details')->with(array('subcategories'=>$subcategories,'casecomments'=>$casecomments,'case'=>$case,'category'=>$category,'allcategories'=>$allcategories,'user'=>$user,'star'=>$star,'caseimages'=>$caseimages,'sendvisitor'=>$sendvisitor));
        }
        elseif ($modalname == "contact") {
          return view('frontend.contact');
        }
        elseif ($modalname == "search") {
          $allcategories = categories::where('status' , 1)->get();
          $users = user::all();
          $cases = cases::where('status' , 1)->where('published' , 1)->orderby('orderid' , 'DESC')->get();
          return view('frontend.search')->with(array('allcategories'=>$allcategories,'users'=>$users,'cases'=>$cases));
        }
        elseif ($modalname == "singleblog") {
          $data = DB::table('blogs')->where('url', $id)->first();
          $blogs  = blogs::where('status' , 1)->where('deletestatus', 1)->limit(3)->get();
          return view('frontend.blog')->with(array('blogs'=>$blogs , 'data'=>$data));
        }
        elseif ($modalname == "blogs") {
          $data  = blogs::where('status' , 1)->where('deletestatus', 1)->get();
          return view('frontend.allblogs')->with(array('data'=>$data));
        }
        elseif ($modalname == "caseguide") {
          $data = DB::table('sitesettings')->where('id' , 1)->get()->first();
          return view('frontend.caseguide')->with(array('data'=>$data));
        }
        elseif ($modalname == "subcategories") {
          $subcategories = subcategories::where('url' , $id)->get()->first();
          $parentcategory = categories::where('id' , $subcategories->parentcategory)->get()->first();
          $cases = cases::where('subcategories' , $subcategories->id)->orderby('orderid' , 'DESC')->get();
          $allcategories = categories::where('status' , 1)->get();
          $users = user::all();
          return view('frontend.sub-categories-cases')->with(array('subcategories'=>$subcategories,'parentcategory'=>$parentcategory,'cases'=>$cases,'allcategories'=>$allcategories,'users'=>$users));
        }
        elseif ($modalname == "doctor-profile") {
          return view('frontend.doctor-profile');
        }
        elseif ($modalname == "our-specialists") {
          return view('frontend.our-specialists');
        }
        elseif ($modalname == "our-guide") {
          return view('frontend.our-guide');
        }
        

      }
      else
      {
        return view('errors.404');  
      }
   }
   public function registerdoctor()
   {
      $case = new cases;
      $case->id = $caseid;
      $case->categories = $request->categories;
      $case->subcategories = $request->subcategories;
      $case->users = Auth::user()->id;
      $case->name = $request->tittle;
      $url = $this->slugify($request->tittle);
      $case->url = $caseid.'-'.$url;
      $case->image = $mainimg;
      $case->casedetials = $request->casedetails;
      $case->self = $request->selfcriticism;
      $case->hardware = $request->hardwareused;
      $case->resource1 = $request->resource1;
      $case->resource2 = $request->resource2;
      $case->resource3 = $request->resource3;
      $case->resource4 = $request->resource4;
      $case->status = 1;
      $case->published = 1;
      $case->mettatittle = $request->tittle;
      $case->metadescription = $request->casedetails;
      $case->save();
   } 




































   public function createnewcase(Request $request)
   {
        $caseid = rand('50000' , '50000000');
        $image = $request->file('mainimg');
        $mainimg = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $mainimg);

        $case = new cases;
        $case->id = $caseid;
        $case->categories = $request->categories;
        $case->subcategories = $request->subcategories;
        $case->users = Auth::user()->id;
        $case->name = $request->tittle;
        $url = $this->slugify($request->tittle);
        $case->url = $caseid.'-'.$url;
        $case->image = $mainimg;
        $case->casedetials = $request->casedetails;
        $case->self = $request->selfcriticism;
        $case->hardware = $request->hardwareused;
        $case->resource1 = $request->resource1;
        $case->resource2 = $request->resource2;
        $case->resource3 = $request->resource3;
        $case->resource4 = $request->resource4;
        $case->status = 1;
        $case->published = 1;
        $case->mettatittle = $request->tittle;
        $case->metadescription = $request->casedetails;
        $case->save();

        $url = $caseid.'-'.$url;

        DB::statement("INSERT INTO `siteurls` (`url`, `modalname`)VALUES ('$url', 'case')");
        if($files=$request->file('galaryimages')){
            foreach($files as $file){
                $imagename=rand() . '.' . $file->getClientOriginalName();
                $file->move(public_path('images'),$imagename);
                DB::statement("INSERT INTO `caseimages` (`caseid`, `image`)VALUES ('$caseid', '$imagename')");
            }
        }
        $data = followusers::where('followed' , Auth::user()->id)->get();
        $caseurl = url('')."/".$url;
        foreach ($data as $r) {
          $userdata = user::where('id' , $r->follower)->get()->first();
          $email = $userdata->email;
          $subject = Auth::user()->name." Upload New Case";
          Mail::send(array('html' => 'emails.case'), array('name' => $subject,'casename' => $request->tittle ,'casedetails' => $request->casedetails,'caseurl' => $caseurl ), function($message) use ($email, $subject)
          {
            $message->to($email)->subject($subject);
          });
        }
        return redirect()->back()->with('message', 'Case Added Successfully');
   } 
   public function insertemailfornewsletter(Request $request)
   {
       $email = $request->email;
       $test =  DB::table('newsletters')->where('email', $email)->first();
       if (empty($test)) {
         $subject = "Welcome to Sarck Solution";
         $name = "Sarck Solution";
         Mail::send(array('html' => 'mail.newsubscribe'), array('name' => $name), function($message) use ($email, $subject)
          {
              $message->to($email)->subject($subject);
          });
         $requestquote = new Newsletters;
         $requestquote->email =  $request->email;
         $requestquote->save();
         echo "subscribed";
       }else{
        echo "already";
       }
   }
   public function comment(Request $request)
   {
      $comment = new casecomments;
      $comment->users =  Auth::user()->id;
      $comment->comment =  $request->comment;
      $comment->caseid = $request->caseid;
      $comment->status = 1;
      $comment->reviews = $request->stars;
      $comment->save();
      $casereviewssum = casecomments::where('caseid' , $request->caseid)->sum('reviews');
      $casereviewscount = casecomments::where('caseid' , $request->caseid)->count();
      $insertedreviews = $casereviewssum/$casereviewscount;
      $data = array('rattings'=>$insertedreviews);
      $id =  $request->caseid;
      cases::where('id', $id)->update($data);
      // print_r($casereviewscount);
      return redirect()->back()->with('message', 'Comment Added Successfully');
   }
   public function submitreply($comentid , $reply)
   {
      $user = Auth::user()->id;
      DB::statement("INSERT INTO `casereply` (`casecommentsid`, `reply`, `user`)VALUES ('$comentid', '$reply', '$user')");
      $data = DB::table('casereply')->where('casecommentsid' , $comentid)->get();
      foreach ($data as $p) {
        $image = DB::table('users')->where('id' , $p->user)->get()->first()->profileimage;
        $name = DB::table('users')->where('id' , $p->user)->get()->first()->name;
        $username = DB::table('users')->where('id' , $p->user)->get()->first()->username;
        echo '<div style="display: flex;margin-bottom: 10px;">
              <div style="width: 8%;">
                  <img style="height: 40px;width: 40px;" src="'.url('public/images/').'/'.$image.'">
              </div>
              <div style="width: 92%;" class="right-inner-addon input-container">
              <div style="background-color: #3a3b3c;padding: 15px;border-radius: 10px;color: white;margin: 0px 0px 10px 0px;">
                    <div style="margin: 0px;" class="row">
                            <a href="'.url('').'/'.$username.'">'.$name.'</a>
                    </div>
                    <p style="text-align:justify">'.$p->reply.'</p>
                </div>
              </div>
          </div>';
      }
   }
   public function submitcontactus(Request $request)

   {
        $fname  = $request->fname;
        $lname  = $request->lname;
        $email = $request->email;
        $phone = $request->phone;
        $message = $request->message;
        // $subject = $name." Sent Funding Request Offer";
        // $date  = date('d-m-Y');
        // $requesturl = "fundingrequestsadmin";
        // Mail::send(array('html' => 'mail.offers'), array('name' => $name,'email' => $email,'phone_number' => $phone_number,'country' => $country,'usermessage' => $usermessage,'date' => $date,'requesturl' => $requesturl), function($message) use ($email, $subject)
        // {
        //     $message->to('info@tamwilly.com')->subject($subject);
        // });
       $quote = new contactus;
       $quote->fname =  $fname;
       $quote->email = $email;
       $quote->phone = $phone;
       $quote->lname = $lname;
       $quote->message = $message;
       $quote->save();
       return redirect()->back()->with('message', 'Your Message Submitied. We Will Contact You Soon');
   }

    public function adminnotification($url , $notification , $type)
    {
      $notifye = new adminnotifications;
      $notifye->url = $url;
      $notifye->notification = $notification;
      $notifye->readstatus = 1;
      $notifye->type = $type;
      $notifye->save();
    }
    public function registernewuser(Request $request)
    {
      
      $notifye = new User;
      $notifye->url = $url;
      $notifye->notification = $notification;
      $notifye->readstatus = 1;
      $notifye->type = $type;
      $notifye->save();
      echo $request->firstname;
    }
    public function searchpage($casename , $category , $doctor)
    {
      if($casename != 'null'){
        if($category != 'null'){
          if($doctor != 'null'){
              $data = cases::where('status' , 1)->where('name', 'like', '%'.$casename.'%')->orwhere('casedetials', 'like', '%'.$casename.'%')->where('published' , 1)->where('categories' , $category)->where('users' , $doctor)->orderBy('created_at', 'DESC')->get();
          }else{
            $data = cases::where('status' , 1)->where('name', 'like', '%'.$casename.'%')->orwhere('casedetials', 'like', '%'.$casename.'%')->where('published' , 1)->where('categories' , $category)->orderBy('created_at', 'DESC')->get();
          }
        }else{
          $data = cases::where('status' , 1)->where('name', 'like', '%'.$casename.'%')->orwhere('casedetials', 'like', '%'.$casename.'%')->where('published' , 1)->orderBy('created_at', 'DESC')->get();
        }
      }else if($category != 'null'){
        if($doctor != 'null'){
            $data = cases::where('status' , 1)->where('published' , 1)->where('categories' , $category)->where('users' , $doctor)->orderBy('created_at', 'DESC')->get();
        }else{
          $data = cases::where('status' , 1)->where('published' , 1)->where('categories' , $category)->orderBy('created_at', 'DESC')->get();
        }
      }else{
        $data = cases::where('status' , 1)->where('published' , 1)->where('users' , $doctor)->orderBy('created_at', 'DESC')->get();
      }
      if($data->count() == 1 || $data->count() > 1){
      foreach ($data as $r) {
       $userdata =  DB::table('users')->where('id' , $r->users)->get()->first();
       $categoryname =DB::table('categories')->where('id' , $r->categories)->get()->first()->name;
       $casecomments = DB::table('casecomments')->where('status' , 1)->where('caseid' ,$r->id)->get();
        $totalreviews = $casecomments->count();
          if(!empty($totalreviews)){
          $reviewssum = $casecomments->sum('reviews');
          $star = $reviewssum/$totalreviews;
        }else{
          $star = 0;
        }
        echo '<div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="card case-card">
            <div class="row ">
              <div class="col-md-4">
                  <img src="'.url("public/images").'/'.$r->image.'" class="w-100 h-100 case-image">
                </div>
                <div class="col-md-8 px-3">
                  <div class="card-block px-3 mbb-10">
                  <span class="case-date">'.date('M d Y', strtotime($r->created_at)).'<a href="'.url("").'/'.$userdata->username.'" class="theme-color">By '.$userdata->name.'</a></span>
                    <h4 class="card-title"><a href="'.url("").'/'.$r->url.'">'.Str::limit($r->name, 40).'</a></h4>
                    <ul class="s-none">
                      <li>'.$userdata->state.','.$userdata->country.'</li>
                      <li>'.$categoryname.'</li>
                      <li>
                          <div class="case-ratings">';
                          if($star >= 1 && $star < 2){
                              echo '<i class="fa fa-star"></i>';
                              }elseif ($star >= 2 && $star < 3){
                              echo '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }elseif ($star >= 3 && $star < 4){
                              echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }elseif ($star >= 4 && $star < 5){
                              echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }elseif ($star == 5){
                                echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }
                         echo '</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        </div>';
      }
    }else{
      echo '<div class="col-lg-12 col-md-6 col-sm-6 col-12"><div class="blog-join_us">
                <div class="blog-join_us-content">
                    <h3>No Result Found Search Again</h3>
                    <p><a href="'.url("categories").'">Browse All Categories</a></p>
                </div>
            </div></div>';
    }
    }
    public function sortbyrattings($id)
    {

      $data = cases::where('status' , 1)->where('published' , 1)->where('subcategories' , $id)->orderBy('rattings', 'DESC')->get();
      foreach ($data as $r) {
       $userdata =  DB::table('users')->where('id' , $r->users)->get()->first();
       $categoryname =DB::table('categories')->where('id' , $r->categories)->get()->first()->name;
       $casecomments = DB::table('casecomments')->where('status' , 1)->where('caseid' ,$r->id)->get();
        $totalreviews = $casecomments->count();
          if(!empty($totalreviews)){
          $reviewssum = $casecomments->sum('reviews');
          $star = $reviewssum/$totalreviews;
        }else{
          $star = 0;
        }
        echo '<div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="card case-card">
            <div class="row ">
              <div class="col-md-4">
                  <img src="'.url("public/images").'/'.$r->image.'" class="w-100 h-100 case-image">
                </div>
                <div class="col-md-8 px-3">
                  <div class="card-block px-3 mbb-10">
                  <span class="case-date">'.date('M d Y', strtotime($r->created_at)).'<a href="'.url("").'/'.$userdata->username.'" class="theme-color">By '.$userdata->name.'</a></span>
                    <h4 class="card-title"><a href="'.url("").'/'.$r->url.'">'.Str::limit($r->name, 40).'</a></h4>
                    <ul class="s-none">
                      <li>'.$userdata->state.','.$userdata->country.'</li>
                      <li>'.$categoryname.'</li>
                      <li>
                          <div class="case-ratings">';
                          if($star >= 1 && $star < 2){
                              echo '<i class="fa fa-star"></i>';
                              }elseif ($star >= 2 && $star < 3){
                              echo '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }elseif ($star >= 3 && $star < 4){
                              echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }elseif ($star >= 4 && $star < 5){
                              echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }elseif ($star == 5){
                                echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }
                         echo '</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        </div>';
      }
    }
    public function sortbydate($id)
    {

      $data = cases::where('status' , 1)->where('published' , 1)->where('subcategories' , $id)->orderBy('created_at', 'DESC')->get();
      foreach ($data as $r) {
       $userdata =  DB::table('users')->where('id' , $r->users)->get()->first();
       $categoryname =DB::table('categories')->where('id' , $r->categories)->get()->first()->name;
       $casecomments = DB::table('casecomments')->where('status' , 1)->where('caseid' ,$r->id)->get();
        $totalreviews = $casecomments->count();
          if(!empty($totalreviews)){
          $reviewssum = $casecomments->sum('reviews');
          $star = $reviewssum/$totalreviews;
        }else{
          $star = 0;
        }
        echo '<div class="col-lg-6 col-md-6 col-sm-6 col-12">
          <div class="card case-card">
            <div class="row ">
              <div class="col-md-4">
                  <img src="'.url("public/images").'/'.$r->image.'" class="w-100 h-100 case-image">
                </div>
                <div class="col-md-8 px-3">
                  <div class="card-block px-3 mbb-10">
                  <span class="case-date">'.date('M d Y', strtotime($r->created_at)).'<a href="'.url("").'/'.$userdata->username.'" class="theme-color">By '.$userdata->name.'</a></span>
                    <h4 class="card-title"><a href="'.url("").'/'.$r->url.'">'.Str::limit($r->name, 40).'</a></h4>
                    <ul class="s-none">
                      <li>'.$userdata->state.','.$userdata->country.'</li>
                      <li>'.$categoryname.'</li>
                      <li>
                          <div class="case-ratings">';
                          if($star >= 1 && $star < 2){
                              echo '<i class="fa fa-star"></i>';
                              }elseif ($star >= 2 && $star < 3){
                              echo '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }elseif ($star >= 3 && $star < 4){
                              echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }elseif ($star >= 4 && $star < 5){
                              echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }elseif ($star == 5){
                                echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                              }
                         echo '</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        </div>';
      }
    }
    public function searchcategory($id)
    {
      $data = categories::where('status' , 1)->where('name', 'like', '%'.$id.'%')->get();
      if($data->count() == 1 || $data->count() > 1){
      foreach ($data as $r) {
      $casecount =  DB::table('subcategories')->where('parentcategory' , $r->id)->get()->count();
        echo '<div class="col-md-2 d-flex flex-fill flex-column">
                <div class="service-box2">
                    <img src="'.url("public/images").'/'.$r->image.'" class="service-box2-img" alt="{{ $r->name }}">
                    <a href="'.url("").'/'.$r->url.'" class="link-href"><h3>'.$r->name.'<small class="f-12"> ('.$casecount.')</small></h3></a>
                </div>
            </div>';
      }
    }else{
      echo '<div class="col-lg-12 col-md-6 col-sm-6 col-12"><div class="blog-join_us">
            <div class="blog-join_us-content">
                <h3>No Result Found Search Again</h3>
            </div>
        </div></div>';
    }
    }
    public function searchmembers($doctor , $country)
    {
      if($doctor != 'null' || $country != 'null')
      {
        if($doctor == 'null'){
          $data = User::where('country', 'like', '%'.$country.'%')->get();
        }else{
          $data = User::where('name', 'like', '%'.$doctor.'%')->get();
        }

        if($data->count() == 1 || $data->count() > 1){

    foreach ($data as $r) {
        echo '<div class="col-md-3 col-lg-3 col-sm-6 col-12">
                <div class="docrtors-box1">
                    <img style="height: 200px;" src="'.url("public/images").'/'.$r->profileimage.'" class="img-fluid" alt="#">
                    <a href="'.url("").'/'.$r->username.'"><h4>'.$r->name.'</h4></a>
                    <p>'.$r->country.'</p>
                </div>
            </div>';
      }
    }else{
      echo '<div class="col-lg-12 col-md-6 col-sm-6 col-12"><div class="blog-join_us">
            <div class="blog-join_us-content">
                <h3>No Result Found Search Again</h3>
            </div>
        </div></div>';
    }

      }else{
        echo '<div class="col-lg-12 col-md-6 col-sm-6 col-12"><div class="blog-join_us">
            <div class="blog-join_us-content">
                <h3>No Result Found Search Again</h3>
            </div>
        </div></div>';
      }

    }
    function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
  function grabIpInfo($ip)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.ipgeolocationapi.com/geolocate/" . $ip);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $returnData = curl_exec($curl);
    curl_close($curl);
    return $returnData;
  }
  public function followmember($id)
  {
    if(Auth::check()){
        $subject = Auth::user()->name." Follow You";
        $date  = date('d-m-Y');
        $memberdata = user::where('id' , $id)->get()->first();
        $profilelink = url('')."/".$memberdata->username;
        $email = $memberdata->email;
        Mail::send(array('html' => 'emails.contact'), array('name' => $subject), function($message) use ($email, $subject)
        {
            $message->to($email)->subject($subject);
        });
        $follow = new followusers;
        $follow->follower = Auth::user()->id;
        $follow->followed = $id;
        $follow->save();
        echo "success";
    }else{
      echo "Please Login First";
    }
  }
  public function unfollowmember($id)
  {
      $follower  = Auth::user()->id;
      followusers::where('follower',$follower)->where('followed' , $id)->delete();
      echo "success";
  }
  public function editcase($id)
  {
    $case = cases::where('id' , $id)->get()->first();
    $subcategory = subcategories::where('status' , 1)->get();
    $parentcategory = categories::where('status' , 1)->get();
    return view('frontend.edit-case')->with(array('case'=>$case,'subcategory'=>$subcategory,'parent'=>$parentcategory));
  }
  public function updatecasedetails(Request $request)
  {
    $slugify = $this->slugify($request->tittle);
    $url = $request->id.'-'.$slugify;
    $savedurl = DB::table('siteurls')->where('url', $url)->where('modalname' , 'case')->first();
    if(empty($savedurl))
    {
        DB::statement("INSERT INTO `siteurls` (`url`, `modalname`)VALUES ('$url', 'case')");
    } 
    $data = array('url'=>$url,'name'=>$request->tittle,'categories'=>$request->categories,'subcategories'=>$request->subcategories,'casedetials'=>$request->casedetails,'self'=>$request->selfcriticism,'mettatittle'=>$request->tittle,'metadescription'=>$request->casedetails,'hardware'=>$request->hardware,'resource1'=>$request->resource1,'resource2'=>$request->resource2,'resource3'=>$request->resource3,'resource4'=>$request->resource4);
    $id =  $request->id;
    cases::where('id', $id)->update($data);
    return redirect()->back()->with('message', 'Case Updated Successfully');
  }
  public function deletecase($id)
  {
    DB::table('caseimages')->where('caseid' , $id)->delete();
    casecomments::where('caseid' , $id)->delete();
    cases::where('id',$id)->delete();
    return redirect()->back()->with('message', 'Case Deleted Successfully');
  }
  public function getsubcategory($id)
  {
      $data = DB::table('subcategories')->where('status' , 1)->where('parentcategory' , $id)->get();
      foreach ($data as $r) {
          echo "<option value='".$r->id."'>".$r->name."</option>";
      }
  }
  public function updatecaseimage(Request $request)
  {
    $id =  $request->id;
    $image = $request->file('image');
    $blogimage = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('images'), $blogimage);
    $data = array('image'=>$blogimage);
    cases::where('id', $id)->update($data);
    return redirect()->back()->with('message', 'Updated Successfully');
  }
  public function updatecasegalaryimage(Request $request)
  {
    $id =  $request->id;
    DB::table('caseimages')->where('caseid', $id)->delete();
    if($files=$request->file('galaryimages')){
        foreach($files as $file){
            $imagename=rand() . '.' . $file->getClientOriginalName();
            $file->move(public_path('images'),$imagename);
            DB::statement("INSERT INTO `caseimages` (`caseid`, `image`)VALUES ('$id', '$imagename')");
        }
    }
    return redirect()->back()->with('message', 'Updated Successfully');
  }
  public function showimage($id)
  {
    $data = DB::table('caseimages')->where('id', $id)->get()->first();
    echo '<img style="width:100%;" src="'.url("public/images").'/'.$data->image.'" id="imagepreview" >';
  }
}