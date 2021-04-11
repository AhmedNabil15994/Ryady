<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Models\UserCard;
use App\Models\Project;
use App\Models\Blog;
use App\Models\UserRequest;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $now = now()->format('Y-m-d H:i:s');
            $firstTime = date('Y-m-d H:i:s',strtotime($now.' - 30 minutes'));
            $secondTime = date('Y-m-d H:i:s',strtotime($firstTime.' + 2 hours'));
            
            $notPaidCards = UserCard::NotDeleted()->where('status',2)->where('end_date','>=',now()->format('Y-m-d'))->where('created_at','>=',$firstTime)->where('created_at','<=',$secondTime)->get();

            foreach ($notPaidCards as $userCard) {
                $userObj = User::getOne($userCard->user_id);
                $userCryptedID = encrypt($userObj->id);
                $emailData['firstName'] = $userObj->name_ar;
                $emailData['subject'] = 'دفع العضوية :';
                $emailData['content'] = '<a href="'.\URL::to('/memberships/delayedPayment/'.$userCryptedID).'">دفع العضوية</a>';
                $emailData['to'] = $userObj->email;
                $emailData['template'] = "emailUsers.emailReplied";
                \App\Helpers\MailHelper::SendMail($emailData);
            }

        })->everyThirtyMinutes();

        $schedule->call(function () {
            $now = now()->format('Y-m-d H:i:s');
            
            $blogs = Blog::NotDeleted()->where('status',1)->where('show_images',0)->get();
            foreach ($blogs as $blog) {
                $membership = UserCard::NotDeleted()->where('status',1)->where('user_id',$blog->created_by)->first();
                if($membership != null){
                    $start_date = $membership->start_date;
                    $firstTime = date('Y-m-d H:i:s',strtotime($start_date.' + 1 day'));
                    if($now >= $firstTime){
                        $blog->show_images = 1;
                        $blog->save();
                    }
                }
            }

        })->everyMinute();

        $schedule->call(function () {
            $now = now()->format('Y-m-d H:i:s');
            
            $projects = Project::NotDeleted()->where('status',1)->where('show_images',0)->get();
            foreach ($projects as $project) {
                $membership = UserCard::NotDeleted()->where('status',1)->where('user_id',$project->created_by)->first();
                if($membership != null){
                    $start_date = $membership->start_date;
                    $firstTime = date('Y-m-d H:i:s',strtotime($start_date.' + 1 day'));
                    if($now >= $firstTime){
                        $project->show_images = 1;
                        $project->save();
                    }
                }
            }

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
