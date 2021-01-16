<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\City;
use App\Models\ProjectCategory;
use App\Models\Page;



class ProjectControllers extends Controller {

    use \TraitsFunc;

    public function index()
    {   
        $data['data'] = (object) Project::dataList(1);
        $data['categories'] = ProjectCategory::dataList(1)['data'];
        $data['cities'] = City::dataList(1)['data'];
        $data['pages'] = Page::dataList(1,[7])['data'];
        return view('Project.Views.index')->with('data',(object) $data);
    }

    public function project($id){
        $id = (int) $id;
        $blogObj = Project::getOne($id);
        if(!$blogObj){
            return redirect('404');
        }
        $data['data'] = Project::getData($blogObj);
        return view('Project.Views.project')->with('data',(object) $data);
    }

}
