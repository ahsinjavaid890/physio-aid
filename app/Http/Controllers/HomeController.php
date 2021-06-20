<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use DB;   
use Auth;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.user-dashboard');
    }
    public function dashboard()
    {
        return view('frontend.user-dashboard');
    }
    public function homedashboard()
    {
        return redirect()->route('user-dashboard');
    }
    public function profile()
    {
        $data = DB::table('countries')->get();
        return view('frontend.user-profile')->with(array('countries'=>$data));
    }
    public function updateuserprofile(Request $request)
    {
        if(!empty($request->file('profileimage'))){
            $profileimage = $request->file('profileimage');
            $image = rand() . '.' . $profileimage->getClientOriginalExtension();
            $profileimage->move(public_path('images'), $image);
            $data = array('name'=>$request->name,'username'=>$request->username,"email"=>$request->email,"country"=>$request->country,"phonenumber"=>$request->phonenumber,"state"=>$request->state,"longitude"=>$request->longitude,"latitude"=>$request->latitude,"reasontojoin"=>$request->reasontojoin,"profileimage"=>$image);
        }else{
            $data = array('name'=>$request->name,'username'=>$request->username,"email"=>$request->email,"country"=>$request->country,"phonenumber"=>$request->phonenumber,"state"=>$request->state,"longitude"=>$request->longitude,"latitude"=>$request->latitude,"reasontojoin"=>$request->reasontojoin);
        }
        $id =  Auth::user()->id;
        user::where('id', $id)->update($data);
        return redirect()->back()->with('message', 'Your Profile Updated Successfully');
    }
    public function updateusersociallinks(Request $request)
    {
        $data = array('facebook'=>$request->facebook,'twitter'=>$request->twitter,"linkdlin"=>$request->linkdlin);
        $id =  Auth::user()->id;
        user::where('id', $id)->update($data);
        return redirect()->back()->with('message', 'Social Media Links Updated Successfully');
    }
    public function updateusersecurity(Request $request)
    {
        $this->validate($request, [
        'oldpassword' => 'required',
        'newpassword' => 'required',
        ]);
        if($request->newpassword == $request->password_confirmed){
        $hashedPassword = Auth::user()->password;
       if (\Hash::check($request->oldpassword , $hashedPassword )) {
         if (!\Hash::check($request->newpassword , $hashedPassword)) {
              $users =User::find(Auth::user()->id);
              $users->password = bcrypt($request->newpassword);
              User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
              session()->flash('message','password updated successfully');
              return redirect()->back();
            }
            else{
                  session()->flash('errorsecurity','New password can not be the old password!');
                  return redirect()->back();
                }
           }
          else{
               session()->flash('errorsecurity','Old password Doesnt matched ');
               return redirect()->back();
             }
        }else{
            session()->flash('errorsecurity','Repeat password Doesnt matched With New Password');
            return redirect()->back();
        }
    }
    // Admin
    public function adminHome()
    {
        return view('admin.dashboard');
    }
    
}