<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\subcategories;
use App\Models\blogs;
use App\Models\user;
use App\Models\cases;
use App\Models\sitesettings;
use App\Models\contactus;
use DB;
use Mail;
use Validator;
use Illuminate\Validation\Rule;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function profile()
    {
        $data = DB::table('countries')->get();
       return view('admin.profile')->with(array('countries'=>$data));
    }
    public function createcategory(Request $request)
    {
        $image = $request->file('icon');
        $blogimage = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $blogimage);
        $name = $request->name;
        $url = $this->slugify($name);
        $category = new categories;
        $category->name = $name;
        $category->image = $blogimage;
        $category->url = $url;
        $category->mettatittle = $name;
        $category->metadescription = $name;
        $category->status = 1;
        $category->save();
        DB::statement("INSERT INTO `siteurls` (`url`, `modalname`)VALUES ('$url', 'categories')");
        return redirect()->back()->with('message', 'Category Successfully Inserted');
    }
    public function categories()
    {
        $data = categories::where('status' ,1)->get();
        return view('admin.all-categories')->with(array('data'=>$data));
    }
    public function editcategory($id)
    {
        $data = categories::where('id' ,$id)->get()->first();
        return view('admin.edit-category')->with(array('data'=>$data));
    }
    public function updatecategory(Request $request)
    {
        $url = $this->slugify($request->name);
        $savedurl = DB::table('siteurls')->where('url', $url)->where('modalname' , 'categories')->first();
        if(empty($savedurl))
        {
            DB::statement("INSERT INTO `siteurls` (`url`, `modalname`)VALUES ('$url', 'categories')");
        }
        if(!empty($request->file('icon'))){
        $image = $request->file('icon');
        $blogimage = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $blogimage);
        $data = array('url'=>$url,'image'=>$blogimage,'name'=>$request->name,'mettatittle'=>$request->name,'metadescription'=>$request->name);
        }else{
            $data = array('url'=>$url,'name'=>$request->name,'mettatittle'=>$request->name,'metadescription'=>$request->name);
        }
        $id =  $request->id;
        categories::where('id', $id)->update($data);
        return redirect()->back()->with('message', 'Category Updated Successfully');
    }
    public function addsubcategory()
    {
        $data = categories::where('status' , 1)->get();
        return view('admin.add-sub-category')->with(array('data'=>$data));
    }
    public function createsubcategory(Request $request)
    {
        $image = $request->file('icon');
        $blogimage = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $blogimage);
        $name = $request->name;
        $url = $this->slugify($name);
        $category = new subcategories;
        $category->name = $name;
        $category->image = $blogimage;
        $category->url = $url;
        $category->parentcategory = $request->parentcategory;
        $category->mettatittle = $name;
        $category->metadescription = $name;
        $category->status = 1;
        $category->save();
        DB::statement("INSERT INTO `siteurls` (`url`, `modalname`)VALUES ('$url', 'subcategories')");
        return redirect()->back()->with('message', 'Sub Category Successfully Inserted');
    }
    public function subcategories()
    {
        $data = subcategories::where('status' ,1)->get();
        return view('admin.all-subcategories')->with(array('data'=>$data));
    }
    public function editsubcategory($id)
    {
        $data = subcategories::where('id' ,$id)->get()->first();
        $categories = categories::where('status' ,1)->get();
        return view('admin.edit-sub-category')->with(array('data'=>$data,'categories'=>$categories));
    }
    public function updatesubcategory(Request $request)
    {
        $url = $this->slugify($request->name);
        $savedurl = DB::table('siteurls')->where('url', $url)->where('modalname' , 'subcategories')->first();
        if(empty($savedurl))
        {
            DB::statement("INSERT INTO `siteurls` (`url`, `modalname`)VALUES ('$url', 'subcategories')");
        }
        if(!empty($request->file('icon'))){
        $image = $request->file('icon');
        $blogimage = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $blogimage);
        $data = array('url'=>$url,'parentcategory'=>$request->parentcategory,'image'=>$blogimage,'name'=>$request->name,'mettatittle'=>$request->name,'metadescription'=>$request->name);
        }else{
            $data = array('url'=>$url,'parentcategory'=>$request->parentcategory,'name'=>$request->name,'mettatittle'=>$request->name,'metadescription'=>$request->name);
        }
        $id =  $request->id;
        subcategories::where('id', $id)->update($data);
        return redirect()->back()->with('message', 'Sub Category Updated Successfully');
    }
    public function addnewcase()
    {
        $subcategory = subcategories::where('status' , 1)->get();
        $parentcategory = categories::where('status' , 1)->get();
        return view('admin.add-case')->with(array('subcategory'=>$subcategory,'parent'=>$parentcategory));
    }
    public function messages()
    {
        $data = contactus::all();
        return view('admin.contact-messages')->with(array('data'=>$data));
    }
    public function message($id)
    {
        $data = contactus::where('id' , $id)->get()->first();
        return view('admin.view-message')->with(array('data'=>$data));
    }
    public function createblog(Request $request)
    {
        $url = $this->slugify($request->title);
        $image = $request->file('image');
        $blogimage = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $blogimage);
        $saveblog = new blogs;
        $saveblog->image = $blogimage;
        $saveblog->url = $url;
        $saveblog->tittle = $request->title;
        $saveblog->blog = $request->blog;
        $saveblog->status = 1;
        $saveblog->deletestatus = 1;
        $saveblog->blogshortdescription = $request->blogshortdescription;
        $saveblog->mettatittle = $request->title;
        $saveblog->metadescription = $request->blogshortdescription;
        $saveblog->save();
        DB::statement("INSERT INTO `siteurls` (`url`, `modalname`)VALUES ('$url', 'singleblog')");
        return redirect()->back()->with('message', 'Service Successfully Inserted');
    }
    public function updateblog(Request $request)
    {
        $id =  $request->id;
        $tittle = $request->title;
        $url = $this->slugify($request->title);
        $savedurl = DB::table('siteurls')->where('url', $url)->first();
        if(empty($savedurl))
        {
            DB::statement("INSERT INTO `siteurls` (`url`, `modalname`)VALUES ('$url', 'singleblog')");
        }
        $blog = $request->blog;
        $blogurl = $url;
        $blogshortdescription = $request->blogshortdescription;
        $data = array('blogshortdescription'=>$blogshortdescription,'url'=>$blogurl,"tittle"=>$tittle,"blog"=>$blog);
        blogs::where('id', $id)->update($data);
        return redirect()->back()->with('message', 'Updated Successfully');
    }
    public function updateblogimage(Request $request)
    {
        $id =  $request->id;
        $image = $request->file('image');
        $blogimage = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $blogimage);
        $data = array('image'=>$blogimage);
        blogs::where('id', $id)->update($data);
        return redirect()->back()->with('message', 'Updated Successfully');
    }
    public function blogs(Request $request)
    {
        $data = blogs::where('deletestatus' ,1)->get();
        return view('admin.all-blogs')->with(array('data'=>$data));
    }
    public function changetopublish($one , $two)
    {
        if($two == 1)
        {
            $data = array('status'=>0);
        }else{
            $data = array('status'=>1);
        }
        blogs::where('id', $one)->update($data);
    }
    public function deleteblog($id)
    {
        $data = array('deletestatus'=>0);
        blogs::where('id', $id)->update($data);
        return redirect()->back()->with('message', 'Delete Successfully');
    }
    public function editblog($id)
    {
        $data = blogs::where('id' ,$id)->get()->first();
        return view('admin.edit-blog')->with(array('data'=>$data));
    }
    public function users()
    {
        $data = user::all();
        return view('admin.users')->with(array('data'=>$data));
    }
    public function cases()
    {
        $data = cases::where('status' , 1)->get();
        return view('admin.all-cases')->with(array('data'=>$data));
    }
    public function changetopublishcase($one , $two)
    {
        if($two == 1)
        {
            $data = array('published'=>0);
        }else{
            $data = array('published'=>1);
        }
        cases::where('id', $one)->update($data);
    }
    public function websitesettings()
    {
        $data = DB::table('sitesettings')->get()->first();
        return view('admin.site-settings')->with(array('data'=>$data));
    }
    public function updatefootertext(Request $request)
    {
        $english = $request->english;
        $data = array('footertextenglish'=>$english);
        sitesettings::where('id', 1)->update($data);
        return redirect()->back()->with('message', 'Updated Successfully');
    }
    public function updatecaseguide(Request $request)
    {
        $english = $request->caseguide;
        $data = array('caseguide'=>$english);
        sitesettings::where('id', 1)->update($data);
        return redirect()->back()->with('message', 'Updated Successfully');
    }
    public function updatecontactdetails(Request $request)
    {
        $phonenumber = $request->phonenumber;
        $email = $request->email;
        $address = $request->address;
        $whatsappnumber = $request->whatsappnumber;
        $data = array('address'=>$address,"phoneno"=>$phonenumber,"email"=>$email,"whatsappnumber"=>$whatsappnumber);
        sitesettings::where('id', 1)->update($data);
        return redirect()->back()->with('message', 'Updated Successfully');
    }
    public function updatesocialmedialinks(Request $request)
    {
        $facebook = $request->facebook;
        $twitter = $request->twitter;
        $instagram = $request->instagram;
        $linkdlin = $request->linkdlin;
        $data = array('facebook'=>$facebook,"twitter"=>$twitter,"instagram"=>$instagram,"linkdlin"=>$linkdlin);
        sitesettings::where('id', 1)->update($data);
        return redirect()->back()->with('message', 'Updated Successfully');
    }
    public function deletecategory($id)
    {
        $data = DB::table('cases')->where('categories' , $id)->get();
        if (!empty($data)) {
            foreach ($data as $r ) {
                $chahgestatus = array('status'=>0);
                cases::where('id', $r->id)->update($chahgestatus);
                DB::table('siteurls')->where('url' , $r->url)->where('modalname' , 'case')->delete();
            }
        } 
        $data2 = DB::table('subcategories')->where('parentcategory' , $id)->get();
        if (!empty($data2)) {
            foreach ($data2 as $r ) {
                $changestatuscities = array('status'=>0);
                subcategories::where('id', $r->id)->update($changestatuscities);
                DB::table('siteurls')->where('url' , $r->url)->where('modalname' , 'subcategories')->delete();
            }
        }
        $changestatuscategory = array('status'=>0);
        categories::where('id', $id)->update($changestatuscategory);
        $category = categories::where('id' , $id)->get()->first();
        DB::table('siteurls')->where('url' , $category->url)->where('modalname' , 'categories')->delete();
        return redirect()->back()->with('message', 'Delete Category Successfully');
    }
    public function deletesubcategory($id)
    {
        $data = DB::table('cases')->where('subcategories' , $id)->get();
        if (!empty($data)) {
            foreach ($data as $r ) {
                $chahgestatus = array('status'=>0);
                cases::where('id', $r->id)->update($chahgestatus);
                DB::table('siteurls')->where('url' , $r->url)->where('modalname' , 'case')->delete();
            }
        } 
        $changestatuscategory = array('status'=>0);
        subcategories::where('id', $id)->update($changestatuscategory);
        $category = subcategories::where('id' , $id)->get()->first();
        DB::table('siteurls')->where('url' , $category->url)->where('modalname' , 'subcategories')->delete();
        return redirect()->back()->with('message', 'Delete Category Successfully');
    }
    public function editcase($id)
    {
        $case = cases::where('id' , $id)->get()->first();
        $subcategory = subcategories::where('status' , 1)->get();
        $parentcategory = categories::where('status' , 1)->get();
        return view('admin.edit-case')->with(array('case'=>$case,'subcategory'=>$subcategory,'parent'=>$parentcategory));
    }
    public function deleteuser($id)
    {
        DB::table('users')->where('id' , $id)->delete();
        return redirect()->back()->with('message', 'Delete User Successfully');
    }
}