<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\City;
use App\Models\ProjectCategory;
use App\Models\Page;
use App\Models\Variable;
use App\Models\User;


class ProjectControllers extends Controller {

    use \TraitsFunc;

    public function index()
    {   
        $data['data'] = (object) Project::dataList(1);
        $data['categories'] = ProjectCategory::dataList(1)['data'];
        $data['cities'] = City::dataList(1)['data'];
        $data['pages'] = Page::dataList(1,[8])['data'];
        return view('Project.Views.index')->with('data',(object) $data);
    }

    public function project($id){
        $id = (int) $id;
        $blogObj = Project::getOne($id);
        if(!$blogObj){
            return redirect('404');
        }
        $data['mobile'] = Variable::getVar('رقم الواتس اب:');
        $data['data'] = Project::getData($blogObj);
        $data['user'] = User::getData(User::getOne($blogObj->created_by));
        return view('Project.Views.project')->with('data',(object) $data);
    }

    public function shareProject($id , $service){
        $id = (int) $id;
        $service = (string) $service;
        $blog = Project::getOne($id);
        $servicesArray = ['whatsapp','twitter'];
        $url = '';
        if(in_array($service, $servicesArray)){
            $url =  \Share::page(\URL::to('/projects/'.$id))->$service()->getRawLinks();
        }else{
            return redirect()->back();
        }
        return redirect()->to($url);
    }

}
