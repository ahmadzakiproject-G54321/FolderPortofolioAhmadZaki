<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\Statistic;
use App\Models\Contact;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $stats=[
            ['label'=>'Projects','count'=>Project::count(),'route'=>'admin.crud.index','resource'=>'projects'],
            ['label'=>'Skills','count'=>Skill::count(),'route'=>'admin.crud.index','resource'=>'skills'],
            ['label'=>'Experience','count'=>Experience::count(),'route'=>'admin.crud.index','resource'=>'experiences'],
            ['label'=>'Education','count'=>Education::count(),'route'=>'admin.crud.index','resource'=>'education'],
            ['label'=>'Certificates','count'=>Certificate::count(),'route'=>'admin.crud.index','resource'=>'certificates'],
            ['label'=>'Services','count'=>Service::count(),'route'=>'admin.crud.index','resource'=>'services'],
            ['label'=>'Statistics','count'=>Statistic::count(),'route'=>'admin.crud.index','resource'=>'statistics'],
            ['label'=>'Social Links','count'=>SocialLink::count(),'route'=>'admin.crud.index','resource'=>'social-links'],
            ['label'=>'Ulasan Klien','count'=>Review::count(),'route'=>'admin.crud.index','resource'=>'reviews'],
            ['label'=>'Messages','count'=>Contact::count(),'route'=>'admin.contacts.index','resource'=>null],
        ];

        $unreadCount = Contact::where('is_read', false)->count();
        $totalMessages = Contact::count();
        $recentMessages = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'unreadCount', 'totalMessages', 'recentMessages'));
    }
}
