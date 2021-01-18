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
        $data['name'] = 'user-certificate';
        $data['url'] = 'userCertificates';
        $data['memberships'] = Membership::dataList(1)['data'];
        return view('UserCertificate.Views.index')->with('data',(object) $data);
    }

    public function download($id){

        $certificateObj = UserCard::getOne($id);
        if($certificateObj == null){
            return redirect('404');
        }
        $certificateObj = UserCard::getData($certificateObj);
        
        $data['title'] = Variable::getVar('العنوان عربي') . ' - ' . 'شهادة عضوية';
        $data['code'] = $certificateObj->code;
        $data['user'] = $certificateObj->name_ar;
        $data['membership_name'] = $certificateObj->membership_name;
        $data['start_date'] = $this->translateDates($certificateObj->start_date);
        $data['end_date'] = $this->translateDates($certificateObj->end_date);

        $pdf = PDF::loadView('UserCertificate.Views.certificate', $data)
                ->setPaper('a4', 'landscape')
                ->setOption('margin-bottom', '0mm')
                ->setOption('margin-top', '0mm')
                ->setOption('margin-right', '0mm')
                ->setOption('margin-left', '0mm');
        return $pdf->download('Certification.pdf');
    }

    public function translateDates($date){
        $arabicMonths = ['يناير','فبراير','مارس','ابريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];
        $dateDay = date('d',strtotime($date));
        $month = date('M',strtotime($date));
        $monthIndex = date('m',strtotime($month)) - 1;
        $dateMonth = $arabicMonths[$monthIndex].' ';

        $dateYear = date('Y',strtotime($date));

        return [$dateDay,$dateMonth,$dateYear];
    }

}
