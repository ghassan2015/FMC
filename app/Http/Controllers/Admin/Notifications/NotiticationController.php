<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Notification as ModelsNotification;
use App\Models\User;
use App\Services\Firebase\FirebaseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\Facades\DataTables;

class NotiticationController extends Controller
{

        public $notifications;
    public function __construct(FirebaseNotification $notifications)
    {
        $this->notifications = $notifications;
    }
    public function index()
    {
        $data['doctors'] = Doctor::query()->get();
        $data['users'] = User::query()->get();
        return view('admin.notifications.index', $data);
    }








    public function store(Request $request)
    {





        $request->validate([
            'nontification_type' => 'required|in:,1,2',
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        $title = $request->title;
        $body  = $request->body;

        $recipients = collect();

        if ($request->nontification_type == '') {
            $users   = User::all();
            $doctors = Doctor::all();
            $recipients = $users->concat($doctors);
            $type = 'all';
        } elseif ($request->nontification_type == '1') {
            $request->validate(['doctor_id' => 'required|array|min:1']);
            $recipients = Doctor::whereIn('id', $request->doctor_id)->get();
            $doctor=Doctor::first();
            $type = 'doctor';
                    event(new SendNotificationEvent($title, $body,$doctor->id));

        } elseif ($request->nontification_type == '2') {
            $request->validate(['user_id' => 'required|array|min:1']);
            $recipients = User::whereIn('id', $request->user_id)->get();
            $type = 'user';
        }

        // تخزين في جدولنا custom_notifications
        foreach ($recipients as $recipient) {
            ModelsNotification::create([
                'title' => $title,
                'body'  => $body,
                'doctor_id' => $type === 'doctor' ? $recipient->id : null,
                'user_id'   => $type === 'user'   ? $recipient->id : null,
                'type'      => $type,
                'notifiable_id' => $recipient->id,
                'notifiable_type'=>$request->nontification_type,

            ]);
        }



        return response()->json([
            'success' => true,
            'message' => __('messages.success_full_process'),
        ]);
    }
}
