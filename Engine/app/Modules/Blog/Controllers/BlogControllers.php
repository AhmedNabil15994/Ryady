<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Page;



class BlogControllers extends Controller {

    use \TraitsFunc;

    public function index()
    {   
        $data['data'] = Blog::dataList(1);
        return view('Blog.Views.index')->with('data',(object) $data);
    }

    public function blogDetails($id){
        $id = (int) $id;
        $blogObj = Blog::getOne($id);
        if(!$blogObj){
            return redirect('404');
        }
        $data['data'] = Blog::getData($blogObj);
        $data['related'] = Blog::dataList(1,null,$blogObj->category_id,[$id],4)->data;
        $data['pages'] = Page::dataList(1,[7])['data'];
        return view('Blog.Views.blogDetails')->with('data',(object) $data);
    }

    public function shareBlog($id , $service){
        $id = (int) $id;
        $service = (string) $service;
        $blog = Blog::getOne($id);
        $servicesArray = ['linkedin','facebook','twitter','reddit'];
        $url = '';
        if(in_array($service, $servicesArray)){
            $url =  \Share::page(\URL::to('/blogs/'.$id))->$service()->getRawLinks();
        }else{
            return redirect()->back();
        }
        return redirect()->to($url);
    }

}
