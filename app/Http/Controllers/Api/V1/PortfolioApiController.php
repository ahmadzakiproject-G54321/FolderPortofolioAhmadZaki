<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\Statistic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfolioApiController extends Controller
{
    /**
     * Helper standard JSON response
     */
    private function jsonResponse(bool $success, string $message, mixed $data = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * API Root / Index
     */
    public function index(): JsonResponse
    {
        return $this->jsonResponse(true, 'Ahmad Zaki Portfolio REST API v1', [
            'api_name' => 'Ahmad Zaki Portfolio API',
            'version' => '1.0.0',
            'author' => 'Ahmad Zaki',
            'profession' => 'Web Developer | PHP, Laravel & Backend Specialist',
            'status' => 'operational',
            'endpoints' => [
                'profile' => url('/api/v1/profile'),
                'projects' => url('/api/v1/projects'),
                'project_detail' => url('/api/v1/projects/{slug}'),
                'skills' => url('/api/v1/skills'),
                'experiences' => url('/api/v1/experiences'),
                'education' => url('/api/v1/education'),
                'certificates' => url('/api/v1/certificates'),
                'services' => url('/api/v1/services'),
                'statistics' => url('/api/v1/statistics'),
                'reviews' => url('/api/v1/reviews'),
                'social_links' => url('/api/v1/social-links'),
                'settings' => url('/api/v1/settings'),
                'send_contact' => [
                    'url' => url('/api/v1/contacts'),
                    'method' => 'POST',
                    'payload' => ['name', 'email', 'phone', 'subject', 'message'],
                ],
            ],
        ]);
    }

    /**
     * Get Profile Info
     */
    public function profile(): JsonResponse
    {
        $profile = Profile::first();

        if (!$profile) {
            return $this->jsonResponse(false, 'Data profil belum tersedia.', null, 404);
        }

        $data = [
            'full_name' => $profile->full_name,
            'first_name' => $profile->first_name,
            'initials' => $profile->initials,
            'profession' => $profile->profession,
            'profile_photo_url' => $profile->profile_photo_url,
            'short_description' => $profile->short_description,
            'about' => $profile->about,
            'career_objective' => $profile->career_objective,
            'experience_years' => (int) $profile->experience_years,
            'rest_api_count' => (int) $profile->rest_api_count,
            'contact' => [
                'email' => $profile->email,
                'phone' => $profile->phone,
                'whatsapp' => $profile->whatsapp,
                'address' => $profile->address,
                'maps_url' => $profile->maps_iframe_url,
            ],
            'social_media' => [
                'github' => $profile->github,
                'linkedin' => $profile->linkedin,
                'instagram' => $profile->instagram,
            ],
            'languages' => $profile->languages_list ?? [],
            'resume_download_url' => !empty($profile->resume_file) && (file_exists(public_path('storage/' . $profile->resume_file)) || \Illuminate\Support\Facades\Storage::disk('public')->exists($profile->resume_file))
                ? asset('storage/' . $profile->resume_file)
                : null,
        ];

        return $this->jsonResponse(true, 'Data profil berhasil diambil.', $data);
    }

    /**
     * Get Projects List
     */
    public function projects(Request $request): JsonResponse
    {
        $query = Project::query()->where('status', 'Published')->latest();

        if ($request->boolean('featured')) {
            $query->where('featured', true);
        }

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('technology', 'like', "%{$search}%");
            });
        }

        $projects = $query->get()->map(function ($project) {
            $tags = !empty($project->technology)
                ? array_values(array_filter(array_map('trim', explode(',', $project->technology))))
                : [];

            return [
                'id' => $project->id,
                'title' => $project->title,
                'slug' => $project->slug,
                'thumbnail_url' => $project->thumbnail_url,
                'description' => $project->description,
                'technologies' => $tags,
                'github_url' => $project->github_url,
                'demo_url' => $project->demo_url,
                'is_featured' => (bool) $project->featured,
                'created_at' => $project->created_at ? $project->created_at->toIso8601String() : null,
            ];
        });

        return $this->jsonResponse(true, 'Data proyek berhasil diambil.', [
            'total' => $projects->count(),
            'projects' => $projects,
        ]);
    }

    /**
     * Get Project Detail by Slug
     */
    public function projectDetail(string $slug): JsonResponse
    {
        $project = Project::where('slug', $slug)
            ->where('status', 'Published')
            ->first();

        if (!$project) {
            return $this->jsonResponse(false, 'Proyek tidak ditemukan.', null, 404);
        }

        $tags = !empty($project->technology)
            ? array_values(array_filter(array_map('trim', explode(',', $project->technology))))
            : [];

        $data = [
            'id' => $project->id,
            'title' => $project->title,
            'slug' => $project->slug,
            'thumbnail_url' => $project->thumbnail_url,
            'description' => $project->description,
            'technologies' => $tags,
            'github_url' => $project->github_url,
            'demo_url' => $project->demo_url,
            'is_featured' => (bool) $project->featured,
            'created_at' => $project->created_at ? $project->created_at->toIso8601String() : null,
        ];

        return $this->jsonResponse(true, 'Detail proyek berhasil diambil.', $data);
    }

    /**
     * Get Skills List
     */
    public function skills(Request $request): JsonResponse
    {
        $skills = Skill::where('is_active', true)->orderBy('sort_order')->get();

        if ($request->boolean('grouped', true)) {
            $grouped = $skills->groupBy('category')->map(function ($items, $category) {
                return [
                    'category' => $category,
                    'count' => $items->count(),
                    'skills' => $items->map(function ($s) {
                        return [
                            'id' => $s->id,
                            'name' => $s->skill_name,
                            'level' => (int) $s->level,
                            'icon' => $s->icon,
                        ];
                    }),
                ];
            })->values();

            return $this->jsonResponse(true, 'Data keahlian berhasil diambil.', [
                'total_skills' => $skills->count(),
                'categories' => $grouped,
            ]);
        }

        return $this->jsonResponse(true, 'Data keahlian berhasil diambil.', [
            'total' => $skills->count(),
            'skills' => $skills,
        ]);
    }

    /**
     * Get Work Experiences
     */
    public function experiences(): JsonResponse
    {
        $experiences = Experience::orderByDesc('start_date')->get()->map(function ($exp) {
            $techs = !empty($exp->technologies)
                ? array_values(array_filter(array_map('trim', explode(',', $exp->technologies))))
                : [];

            return [
                'id' => $exp->id,
                'company' => $exp->company,
                'position' => $exp->position,
                'employment_type' => $exp->employment_type,
                'location' => $exp->location,
                'start_date' => $exp->start_date,
                'end_date' => $exp->end_date,
                'is_current' => (bool) $exp->is_current,
                'description' => $exp->description,
                'technologies' => $techs,
            ];
        });

        return $this->jsonResponse(true, 'Data pengalaman kerja berhasil diambil.', [
            'total' => $experiences->count(),
            'experiences' => $experiences,
        ]);
    }

    /**
     * Get Education History
     */
    public function education(): JsonResponse
    {
        $education = Education::orderByDesc('start_year')->get()->map(function ($edu) {
            return [
                'id' => $edu->id,
                'education_level' => $edu->education_level,
                'institution' => $edu->institution,
                'degree' => $edu->degree,
                'major' => $edu->major,
                'start_year' => (int) $edu->start_year,
                'end_year' => $edu->end_year ? (int) $edu->end_year : null,
                'gpa' => $edu->gpa !== null ? (float) $edu->gpa : null,
                'description' => $edu->description,
            ];
        });

        return $this->jsonResponse(true, 'Data riwayat pendidikan berhasil diambil.', [
            'total' => $education->count(),
            'education' => $education,
        ]);
    }

    /**
     * Get Certificates
     */
    public function certificates(): JsonResponse
    {
        $certificates = Certificate::orderByDesc('issue_date')->get()->map(function ($cert) {
            return [
                'id' => $cert->id,
                'title' => $cert->title,
                'issuer' => $cert->issuer,
                'issue_date' => $cert->issue_date,
                'image_url' => $cert->certificate_image_url,
                'file_url' => $cert->certificate_file_url,
                'credential_url' => $cert->credential_url,
            ];
        });

        return $this->jsonResponse(true, 'Data sertifikat berhasil diambil.', [
            'total' => $certificates->count(),
            'certificates' => $certificates,
        ]);
    }

    /**
     * Get Services
     */
    public function services(): JsonResponse
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get()->map(function ($srv) {
            return [
                'id' => $srv->id,
                'title' => $srv->title,
                'icon' => $srv->icon ?: 'bi bi-code-slash',
                'description' => $srv->description,
            ];
        });

        return $this->jsonResponse(true, 'Data layanan berhasil diambil.', [
            'total' => $services->count(),
            'services' => $services,
        ]);
    }

    /**
     * Get Statistics
     */
    public function statistics(): JsonResponse
    {
        $statistics = Statistic::orderBy('sort_order')->get();
        $completedProjects = Project::where('status', 'Published')->count();
        $approvedReviews = Review::where('is_approved', true)->count();

        $stats = $statistics->map(function ($stat) use ($completedProjects, $approvedReviews) {
            $t = strtolower($stat->title);
            $num = (int) $stat->number;

            if (str_contains($t, 'project') || str_contains($t, 'proyek')) {
                $num = $completedProjects;
            } elseif (str_contains($t, 'client') || str_contains($t, 'happy') || str_contains($t, 'klien') || str_contains($t, 'puas')) {
                $num = $approvedReviews;
            }

            return [
                'id' => $stat->id,
                'title' => $stat->title,
                'number' => $num,
                'suffix' => $stat->suffix ?? '',
                'icon' => $stat->icon,
            ];
        });

        return $this->jsonResponse(true, 'Data statistik hero berhasil diambil.', [
            'statistics' => $stats,
        ]);
    }

    /**
     * Get Approved Client Reviews
     */
    public function reviews(): JsonResponse
    {
        $reviews = Review::where('is_approved', true)->orderBy('sort_order')->latest()->get()->map(function ($rev) {
            return [
                'id' => $rev->id,
                'name' => $rev->name,
                'company' => $rev->company,
                'project_name' => $rev->project_name,
                'rating' => (int) $rev->rating,
                'review' => $rev->review,
                'created_at' => $rev->created_at ? $rev->created_at->toIso8601String() : null,
            ];
        });

        return $this->jsonResponse(true, 'Data ulasan klien berhasil diambil.', [
            'total' => $reviews->count(),
            'reviews' => $reviews,
        ]);
    }

    /**
     * Get Social Links
     */
    public function socialLinks(): JsonResponse
    {
        $links = SocialLink::where('is_active', true)->orderBy('sort_order')->get()->map(function ($link) {
            return [
                'id' => $link->id,
                'platform' => $link->platform,
                'icon' => $link->icon,
                'url' => $link->url,
            ];
        });

        return $this->jsonResponse(true, 'Data media sosial berhasil diambil.', [
            'total' => $links->count(),
            'social_links' => $links,
        ]);
    }

    /**
     * Get Website Public Settings
     */
    public function settings(): JsonResponse
    {
        $setting = Setting::current();

        return $this->jsonResponse(true, 'Pengaturan website berhasil diambil.', [
            'site_name' => $setting->site_name,
            'logo_url' => $setting->logo_url,
            'favicon_url' => $setting->favicon_url,
            'admin_favicon_url' => $setting->admin_favicon_url,
            'colors' => [
                'primary' => $setting->primary_color ?: '#2563EB',
                'secondary' => $setting->secondary_color ?: '#1E293B',
            ],
            'footer_text' => $setting->footer_text,
        ]);
    }

    /**
     * Send Contact Message via API
     */
    public function sendContact(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'message.required' => 'Pesan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return $this->jsonResponse(false, $validator->errors()->first(), [
                'errors' => $validator->errors(),
            ], 422);
        }

        $contact = Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'is_read' => false,
        ]);

        return $this->jsonResponse(true, 'Pesan Anda telah berhasil dikirim melalui API.', [
            'id' => $contact->id,
            'name' => $contact->name,
            'subject' => $contact->subject,
            'created_at' => $contact->created_at->toIso8601String(),
        ], 201);
    }
}
