<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Statistic;
use App\Models\Review;
use App\Models\SocialLink;

class HomeController extends Controller
{
    public function index()
    {
        // Profile utama
        $profile = Profile::first();
        if (!$profile) {
            $profile = new Profile([
                'full_name' => 'Ahmad Zaki',
                'profession' => 'PHP Laravel Backend Developer',
                'short_description' => 'Ahmad Zaki adalah seorang Software Engineer & Web Developer yang berfokus pada pengembangan backend modern, performa tinggi, dan clean architecture.',
                'address' => 'Pesisir Selatan, Sumatera Barat',
                'email' => 'zaki081261514108@gmail.com',
                'phone' => '081261514108',
                'whatsapp' => '081261514108',
            ]);
        }

        // Skill aktif
        $skills = Skill::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Project yang sudah dipublish
        $projects = Project::where('status', 'Published')
            ->latest()
            ->get();

        // Experience
        $experiences = Experience::orderByDesc('start_date')
            ->get();

        // Education
        $education = Education::orderByDesc('start_year')
            ->get();

        // Certificate
        $certificates = Certificate::orderByDesc('issue_date')
            ->get();

        // Service aktif
        $services = Service::where('is_active', true)
            ->orderByDesc('sort_order')
            ->get();

        // Statistics
        $statistics = Statistic::orderBy('sort_order')->get();

        // Reviews (Penilaian Klien)
        $reviews = Review::where('is_approved', true)
            ->orderBy('sort_order')
            ->latest()
            ->get();

        // Penyesuaian data statistik Hero Section sesuai instruksi:
        // 1. Jumlah project yang selesai: dari data sebenarnya pada database
        // 2. Pengalaman: di-input dari admin ($stat->number)
        // 3. Jumlah client happy: diambil dari penilaian client ($reviews->count())
        // 4. REST API: sesuaikan dengan database ($stat->number)
        $completedProjectsCount = $projects->count();
        $approvedReviewsCount = $reviews->count();

        foreach ($statistics as $stat) {
            $titleLower = strtolower($stat->title);
            if (str_contains($titleLower, 'project') || str_contains($titleLower, 'proyek')) {
                $stat->display_number = $completedProjectsCount;
            } elseif (str_contains($titleLower, 'client') || str_contains($titleLower, 'happy') || str_contains($titleLower, 'klien') || str_contains($titleLower, 'puas')) {
                $stat->display_number = $approvedReviewsCount;
            } elseif (str_contains($titleLower, 'experience') || str_contains($titleLower, 'pengalaman') || str_contains($titleLower, 'tahun')) {
                $stat->display_number = (int)$stat->number;
            } elseif (str_contains($titleLower, 'api')) {
                $stat->display_number = (int)$stat->number;
            } else {
                $stat->display_number = (int)$stat->number;
            }
        }

        $expStat = $statistics->first(function ($s) {
            $t = strtolower($s->title);
            return str_contains($t, 'pengalaman') || str_contains($t, 'experience') || str_contains($t, 'tahun');
        });
        $experienceYears = (int) ($expStat ? $expStat->number : 3);

        $apiStat = $statistics->first(function ($s) {
            $t = strtolower($s->title);
            return str_contains($t, 'api');
        });
        $restApiCount = (int) ($apiStat ? $apiStat->number : 15);

        // Social Links aktif
        $socialLinks = SocialLink::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('frontend.home', compact(
            'profile',
            'skills',
            'projects',
            'experiences',
            'education',
            'certificates',
            'services',
            'statistics',
            'reviews',
            'socialLinks',
            'experienceYears',
            'restApiCount'
        ));
    }

    /**
     * Download Resume / CV PDF
     */
    public function downloadCv()
    {
        $profile = Profile::first();

        if ($profile && !empty($profile->resume_file)) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($profile->resume_file)) {
                $filename = 'CV_' . \Illuminate\Support\Str::slug($profile->full_name ?? 'Ahmad_Zaki', '_') . '.pdf';
                return \Illuminate\Support\Facades\Storage::disk('public')->download($profile->resume_file, $filename);
            }
            if (file_exists(public_path('storage/' . $profile->resume_file))) {
                $filename = 'CV_' . \Illuminate\Support\Str::slug($profile->full_name ?? 'Ahmad_Zaki', '_') . '.pdf';
                return response()->download(public_path('storage/' . $profile->resume_file), $filename);
            }
        }

        return redirect()->route('home')->with('error', 'File CV belum tersedia atau belum diunggah.');
    }
}