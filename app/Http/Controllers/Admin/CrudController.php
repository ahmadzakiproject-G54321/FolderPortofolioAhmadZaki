<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\Statistic;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CrudController extends Controller
{
    private array $resources = [
        'skills' => [
            'title' => 'Skills', 'model' => Skill::class,
            'fields' => [
                'category'=>['label'=>'Kategori','type'=>'text','rules'=>'required|string|max:100'],
                'skill_name'=>['label'=>'Nama Skill','type'=>'text','rules'=>'required|string|max:100'],
                'level'=>['label'=>'Level (%)','type'=>'number','rules'=>'required|integer|min:0|max:100'],
                'icon'=>['label'=>'Icon','type'=>'text','rules'=>'nullable|string|max:100'],
                'is_active'=>['label'=>'Aktif','type'=>'checkbox'],
            ]
        ],
        'projects' => [
            'title'=>'Projects', 'model'=>Project::class,
            'fields'=>[
                'title'=>['label'=>'Judul','type'=>'text','rules'=>'required|string|max:255'],
                'slug'=>['label'=>'Slug','type'=>'text','rules'=>'required|string|max:255|unique:projects,slug'],
                'thumbnail'=>['label'=>'Thumbnail','type'=>'file','rules'=>'nullable|image|max:2048'],
                'description'=>['label'=>'Deskripsi','type'=>'textarea','rules'=>'required|string'],
                'technology'=>['label'=>'Teknologi','type'=>'text','rules'=>'nullable|string|max:255'],
                'github_url'=>['label'=>'GitHub URL','type'=>'url','rules'=>'nullable|url|max:255'],
                'demo_url'=>['label'=>'Demo URL','type'=>'url','rules'=>'nullable|url|max:255'],
                'featured'=>['label'=>'Project Unggulan','type'=>'checkbox'],
                'status'=>['label'=>'Status','type'=>'select','options'=>['Published'=>'Published','Draft'=>'Draft'],'rules'=>'required|in:Published,Draft'],
            ]
        ],
        'experiences'=>[
            'title'=>'Experience','model'=>Experience::class,
            'fields'=>[
                'company'=>['label'=>'Perusahaan','type'=>'text','rules'=>'required|string|max:255'],
                'position'=>['label'=>'Posisi','type'=>'text','rules'=>'required|string|max:255'],
                'employment_type'=>['label'=>'Tipe Pekerjaan','type'=>'text','rules'=>'nullable|string|max:100'],
                'location'=>['label'=>'Lokasi','type'=>'text','rules'=>'nullable|string|max:255'],
                'start_date'=>['label'=>'Tanggal Mulai','type'=>'date','rules'=>'required|date'],
                'end_date'=>['label'=>'Tanggal Selesai','type'=>'date','rules'=>'nullable|date'],
                'description'=>['label'=>'Deskripsi','type'=>'textarea','rules'=>'nullable|string'],
                'technologies'=>['label'=>'Teknologi','type'=>'text','rules'=>'nullable|string|max:255'],
                'is_current'=>['label'=>'Masih Bekerja','type'=>'checkbox'],
            ]
        ],
        'education'=>[
            'title'=>'Education','model'=>Education::class,
            'fields'=>[
                'education_level'=>['label'=>'Jenjang Pendidikan','type'=>'select','options'=>['SMA/SMK'=>'SMA/SMK','Kuliah'=>'Kuliah'],'rules'=>'required|in:SMA/SMK,Kuliah'],
                'institution'=>['label'=>'Institusi','type'=>'text','rules'=>'required|string|max:255'],
                'degree'=>['label'=>'Gelar / Jenjang','type'=>'text','rules'=>'required|string|max:255'],
                'major'=>['label'=>'Jurusan','type'=>'text','rules'=>'required|string|max:255'],
                'start_year'=>['label'=>'Tahun Mulai','type'=>'number','rules'=>'required|integer|min:1900|max:2100'],
                'end_year'=>['label'=>'Tahun Selesai','type'=>'number','rules'=>'nullable|integer|min:1900|max:2100'],
                'gpa'=>['label'=>'Nilai / IPK','type'=>'number','step'=>'0.01','rules'=>'nullable|numeric|min:0|max:100'],
                'description'=>['label'=>'Deskripsi','type'=>'textarea','rules'=>'nullable|string'],
            ]
        ],
        'certificates'=>[
            'title'=>'Certificates','model'=>Certificate::class,
            'fields'=>[
                'title'=>['label'=>'Judul','type'=>'text','rules'=>'required|string|max:255'],
                'issuer'=>['label'=>'Penerbit','type'=>'text','rules'=>'required|string|max:255'],
                'issue_date'=>['label'=>'Tanggal Terbit','type'=>'date','rules'=>'nullable|date'],
                'certificate_image'=>['label'=>'Gambar Sertifikat','type'=>'file','rules'=>'nullable|image|max:4096'],
                'certificate_file'=>['label'=>'File Sertifikat','type'=>'file','rules'=>'nullable|mimes:pdf|max:8192'],
                'credential_url'=>['label'=>'Credential URL','type'=>'url','rules'=>'nullable|url|max:255'],
            ]
        ],
        'services'=>[
            'title'=>'Services','model'=>Service::class,
            'fields'=>[
                'title'=>['label'=>'Judul','type'=>'text','rules'=>'required|string|max:255'],
                'icon'=>['label'=>'Icon','type'=>'text','rules'=>'nullable|string|max:100'],
                'description'=>['label'=>'Deskripsi','type'=>'textarea','rules'=>'nullable|string'],
                'is_active'=>['label'=>'Aktif','type'=>'checkbox'],
            ]
        ],
        'statistics'=>[
            'title'=>'Statistics','model'=>Statistic::class,
            'fields'=>[
                'title'=>['label'=>'Judul','type'=>'text','rules'=>'required|string|max:255'],
                'number'=>['label'=>'Angka','type'=>'number','rules'=>'required|integer'],
                'suffix'=>['label'=>'Suffix','type'=>'text','rules'=>'nullable|string|max:20'],
                'icon'=>['label'=>'Icon','type'=>'text','rules'=>'nullable|string|max:100'],
            ]
        ],
        'social-links'=>[
            'title'=>'Social Links','model'=>SocialLink::class,
            'fields'=>[
                'platform'=>['label'=>'Platform','type'=>'text','rules'=>'required|string|max:100'],
                'icon'=>['label'=>'Icon','type'=>'text','rules'=>'nullable|string|max:100'],
                'url'=>['label'=>'URL / Email','type'=>'text','rules'=>'required|string|max:255'],
                'is_active'=>['label'=>'Aktif','type'=>'checkbox'],
            ]
        ],
        'reviews'=>[
            'title'=>'Penilaian Klien','model'=>Review::class,
            'fields'=>[
                'name'=>['label'=>'Nama Klien','type'=>'text','rules'=>'required|string|max:255'],
                'company'=>['label'=>'Perusahaan / Jabatan','type'=>'text','rules'=>'nullable|string|max:255'],
                'project_name'=>['label'=>'Nama Proyek','type'=>'text','rules'=>'nullable|string|max:255'],
                'rating'=>['label'=>'Rating Bintang (1-5)','type'=>'number','rules'=>'required|integer|min:1|max:5'],
                'review'=>['label'=>'Ulasan / Testimoni','type'=>'textarea','rules'=>'required|string'],
                'is_approved'=>['label'=>'Tampilkan di Web','type'=>'checkbox'],
            ]
        ],
    ];

    private function formView(string $resource): string
    {
        return match ($resource) {
            'skills' => 'admin.crud.skills.form',
            'projects' => 'admin.crud.projects.form',
            'experiences' => 'admin.crud.experiences.form',
            'education' => 'admin.crud.education.form',
            'certificates' => 'admin.crud.certificates.form',
            'services' => 'admin.crud.services.form',
            'statistics' => 'admin.crud.statistics.form',
            'social-links' => 'admin.crud.social-links.form',
            'reviews' => 'admin.crud.form',
            default => abort(404),
        };
    }

    private function config(string $resource): array
    {
        abort_unless(isset($this->resources[$resource]), 404);
        return $this->resources[$resource];
    }

    public function index(string $resource)
    {
        $config=$this->config($resource);
        $items=$config['model']::orderBy('sort_order')->orderBy('id')->paginate(10)->withQueryString();
        return view('admin.crud.index', compact('resource','config','items'));
    }

    public function create(string $resource)
    {
        $config=$this->config($resource);
        return view($this->formView($resource), compact('resource','config'));
    }

    public function store(Request $request, string $resource)
    {
        $config=$this->config($resource);
        $data=$this->validated($request,$config);
        if (in_array('sort_order', (new $config['model'])->getFillable(), true)) {
            $data['sort_order'] = ((int) $config['model']::max('sort_order')) + 1;
        }
        $this->handleFiles($request,$config,$data);
        $config['model']::create($data);
        if ($resource === 'statistics') {
            $this->syncStatisticToProfile($data);
        }
        return redirect()->route('admin.crud.index',$resource)->with('success',$config['title'].' berhasil ditambahkan.');
    }

    public function edit(string $resource, int $id)
    {
        $config=$this->config($resource);
        $item=$config['model']::findOrFail($id);
        return view($this->formView($resource), compact('resource','config','item'));
    }

    public function update(Request $request, string $resource, int $id)
    {
        $config=$this->config($resource);
        $item=$config['model']::findOrFail($id);
        $data=$this->validated($request,$config,$item->id);
        $this->handleFiles($request,$config,$data,$item);
        $item->update($data);
        if ($resource === 'statistics') {
            $this->syncStatisticToProfile($data);
        }
        return redirect()->route('admin.crud.index',$resource)->with('success',$config['title'].' berhasil diperbarui.');
    }

    public function destroy(string $resource, int $id)
    {
        $config=$this->config($resource);
        $item=$config['model']::findOrFail($id);
        foreach ($config['fields'] as $name=>$field) {
            if (($field['type'] ?? '')==='file' && $item->{$name}) Storage::disk('public')->delete($item->{$name});
        }
        $item->delete();
        return back()->with('success',$config['title'].' berhasil dihapus.');
    }

    private function validated(Request $request, array $config, ?int $id = null): array
    {
        $modelClass = $config['model'] ?? null;

        // Auto-normalize URLs and scheme prefixes
        if ($modelClass === SocialLink::class) {
            $rawUrl = trim((string) $request->input('url', ''));
            $platform = strtolower(trim((string) $request->input('platform', '')));

            if ($rawUrl !== '') {
                // If it starts with mailto:
                if (str_starts_with(strtolower($rawUrl), 'mailto:')) {
                    $email = trim(substr($rawUrl, 7));
                    $request->merge(['url' => 'mailto:' . $email]);
                }
                // If user entered an email address or platform is email
                elseif (filter_var($rawUrl, FILTER_VALIDATE_EMAIL) || str_contains($platform, 'email')) {
                    $cleaned = preg_replace('/^mailto:/i', '', $rawUrl);
                    $request->merge(['url' => 'mailto:' . trim($cleaned)]);
                }
                // If phone / WhatsApp format
                elseif (str_contains($platform, 'whatsapp') || str_contains($platform, 'wa')) {
                    if (str_starts_with(strtolower($rawUrl), 'wa.me/')) {
                        $request->merge(['url' => 'https://' . $rawUrl]);
                    } elseif (preg_match('/^[0-9+ ]+$/', $rawUrl)) {
                        $cleanDigits = preg_replace('/[^0-9]/', '', $rawUrl);
                        if (str_starts_with($cleanDigits, '0')) {
                            $cleanDigits = '62' . substr($cleanDigits, 1);
                        }
                        $request->merge(['url' => 'https://wa.me/' . $cleanDigits]);
                    } elseif (!preg_match('~^[a-zA-Z][a-zA-Z0-9+.-]*://~', $rawUrl) && !str_starts_with(strtolower($rawUrl), 'tel:')) {
                        $request->merge(['url' => 'https://' . ltrim($rawUrl, '/')]);
                    }
                }
                // If starts with tel:
                elseif (str_starts_with(strtolower($rawUrl), 'tel:')) {
                    $request->merge(['url' => $rawUrl]);
                }
                // If domain without scheme (e.g. github.com/user, linkedin.com/in/user)
                elseif ((str_contains($rawUrl, '.') || str_contains($rawUrl, '/')) && !preg_match('~^[a-zA-Z][a-zA-Z0-9+.-]*://~', $rawUrl)) {
                    $request->merge(['url' => 'https://' . ltrim($rawUrl, '/')]);
                }
            }
        } elseif ($modelClass === Project::class) {
            foreach (['github_url', 'demo_url'] as $urlKey) {
                $val = trim((string) $request->input($urlKey, ''));
                if ($val !== '' && (str_contains($val, '.') || str_contains($val, '/')) && !preg_match('~^[a-zA-Z][a-zA-Z0-9+.-]*://~', $val)) {
                    $request->merge([$urlKey => 'https://' . ltrim($val, '/')]);
                }
            }
        } elseif ($modelClass === Certificate::class) {
            $val = trim((string) $request->input('credential_url', ''));
            if ($val !== '' && (str_contains($val, '.') || str_contains($val, '/')) && !preg_match('~^[a-zA-Z][a-zA-Z0-9+.-]*://~', $val)) {
                $request->merge(['credential_url' => 'https://' . ltrim($val, '/')]);
            }
        }

        $rules = [];
        $attributes = [];

        foreach ($config['fields'] as $name => $field) {
            if (isset($field['rules'])) {
                $rules[$name] = $field['rules'];
            }
            if (($field['type'] ?? '') === 'checkbox') {
                $rules[$name] = 'nullable|boolean';
            }
            if ($name === 'slug' && $id) {
                $rules[$name] = ['required', 'string', 'max:255', Rule::unique('projects', 'slug')->ignore($id)];
            }
            if (isset($field['label'])) {
                $attributes[$name] = $field['label'];
            }
        }

        if ($modelClass === SocialLink::class) {
            $rules['url'] = [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $val = trim((string) $value);
                    if (str_starts_with(strtolower($val), 'mailto:')) {
                        $email = substr($val, 7);
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $fail('Format alamat email tidak valid.');
                        }
                        return;
                    }
                    if (str_starts_with(strtolower($val), 'tel:')) {
                        return;
                    }
                    if (filter_var($val, FILTER_VALIDATE_EMAIL)) {
                        return;
                    }
                    if (!filter_var($val, FILTER_VALIDATE_URL) && !\Illuminate\Support\Str::isUrl($val)) {
                        $fail('Format ' . $attribute . ' harus berupa URL web yang valid (contoh: https://...) atau alamat email.');
                    }
                },
            ];
        }

        if ($modelClass === Education::class) {
            $isSchool = $request->input('education_level') === 'SMA/SMK';
            $rules['education_level'] = ['required', 'in:SMA/SMK,Kuliah'];
            $rules['degree'] = $isSchool
                ? ['nullable', 'string', 'max:255']
                : ['required', 'string', 'max:255'];
            $rules['gpa'] = $isSchool
                ? ['nullable', 'numeric', 'min:0', 'max:100']
                : ['nullable', 'numeric', 'min:0', 'max:4'];
        }

        $messages = [
            'required' => ':Attribute wajib diisi.',
            'url' => 'Format :attribute harus berupa URL yang valid (contoh: https://...).',
            'email' => 'Format :attribute harus berupa alamat email yang valid.',
            'image' => 'File :attribute harus berupa file gambar.',
            'mimes' => 'Format file :attribute tidak sesuai ketentuan (:values).',
            'max' => 'Ukuran atau panjang :attribute melebihi batas maksimal (:max).',
            'min' => 'Nilai atau panjang :attribute kurang dari batas minimal (:min).',
            'integer' => ':Attribute harus berupa angka bulat.',
            'numeric' => ':Attribute harus berupa angka.',
            'in' => 'Pilihan :attribute tidak valid.',
            'unique' => ':Attribute sudah digunakan, silakan gunakan nilai lain.',
        ];

        $data = $request->validate($rules, $messages, $attributes);

        foreach ($config['fields'] as $name => $field) {
            if (($field['type'] ?? '') === 'checkbox') {
                $data[$name] = $request->boolean($name);
            }
        }

        return $data;
    }

    private function handleFiles(Request $request,array $config,array &$data,$item=null):void
    {
        foreach($config['fields'] as $name=>$field) {
            if(($field['type']??'')!=='file' || !$request->hasFile($name)) continue;
            if($item && $item->{$name}) Storage::disk('public')->delete($item->{$name});
            $data[$name]=$request->file($name)->store($this->folder($name),'public');
        }
    }

    private function folder(string $field):string
    {
        return match($field){
            'thumbnail'=>'projects',
            'certificate_image'=>'certificates/images',
            'certificate_file'=>'certificates/files',
            default=>'uploads',
        };
    }

    private function syncStatisticToProfile(array $data): void
    {
        $profile = Profile::first();
        if (!$profile) return;

        $title = strtolower($data['title'] ?? '');
        $num = (int)($data['number'] ?? 0);

        if (str_contains($title, 'pengalaman') || str_contains($title, 'experience') || str_contains($title, 'tahun')) {
            $profile->update(['experience_years' => $num]);
        } elseif (str_contains($title, 'api')) {
            $profile->update(['rest_api_count' => $num]);
        }
    }
}
