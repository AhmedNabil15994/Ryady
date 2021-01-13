<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\UserCard;
use App\Models\Membership;
use App\Models\Variable;
use Illuminate\Http\Request;
use DataTables;
use PDF;

class UserCertificatesControllers extends Controller {

    use \TraitsFunc;

    public function index(Request $request)
    {   
        if($request->ajax()){
            $data = UserCard::dataList(1);
            return Datatables::of($data['data'])->make(true);
        }
        $data['title'] = 'شهادات العضوية';
        $data['name'] = 'userCertificate';
        $data['url'] = 'userCertificates';
        $data['memberships'] = Membership::dataList(1)['data'];
        return view('UserCertificate.Views.index')->with('data',(object) $data);
    }

    public function download($id){

        $certificateObj = UserCard::getOne($id);

        $data['title'] = Variable::getVar('العنوان عربي');
        $data['code'] = $certificateObj->code;
        $data['user'] = $certificateObj->name_ar;
        $data['start_date'] = $certificateObj->start_date;
        $data['end_date'] = $certificateObj->end_date;
        $data['date'] = now()->format('Y-m-d');
        $pdf = PDF::loadView('UserCertificate.Views.certificate', $data)->setPaper('a4', 'landscape');
        return $pdf->download('Certification.pdf');
    }

}
