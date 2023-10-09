<?php

namespace App\Http\Controllers;
use App\Jobs\SendNotification;
use App\Models\Company;
use App\Models\Notification;
use App\Models\Role;
use App\Models\User;
use App\Notifications\NotificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    

    public function index(Request $request)
    {
        // Fetch users and companies based on filters
        $role = $request->input('role');
        $name = $request->input('name');
        $email = $request->input('email');
        $roles = Role::all();
        $usersAndCompanies = $this->filterUsersAndCompanies($role, $name, $email);

        return view('notifications.index', compact('usersAndCompanies','roles'));
    }

    public function create($id)
    {
        // Find the recipient (user or company) by ID
        $recipient = User::find($id);

        if (!$recipient) {
            $recipient = Company::find($id);
        }

        return view('notifications.create', compact('recipient'));
    }


    private function filterUsersAndCompanies($role, $name, $email)
    {
        $query = User::query();

        if ($role) {
            $query->where('role_id', $role);
        }

        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($email) {
            $query->where('email', 'like', '%' . $email . '%');
        }

        $users = $query->get();

        // Repeat the same process for the Company model if needed

        return $users;
    }

    public function sendNotifications(Request $request)
{
    

    // Validate the form data
    $request->validate([
        'selectedUsers' => 'required|array',
        'selectedUsers.*' => 'exists:users,id', // Ensure selected users exist in the database
        'notification_subject' => 'required|string|max:255',
        'notification_body' => 'required|string',
    ]);

    // Get the selected user IDs
    $selectedUserIds = $request->input('selectedUsers');

    // Create the notification instance
    $notification = new NotificationEmail($request->input('notification_subject'), $request->input('notification_body'));

    // Find users by their IDs and notify them
    $usersToNotify = User::whereIn('id', $selectedUserIds)->get();
    \Illuminate\Support\Facades\Notification::send($usersToNotify, $notification);

    // Redirect back with a success message
    // return redirect()->back()->with('success', 'Notifications sent successfully');
    return redirect('/admin/notifications')->with('success', 'Notifications sent successfully');
}
}
