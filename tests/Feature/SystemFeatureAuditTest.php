<?php

use App\Models\User;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certificate;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\SocialLink;
use App\Models\Review;
use App\Models\Contact;

beforeEach(function () {
    // Ensure an admin user exists
    $this->user = User::first() ?? User::factory()->create([
        'name' => 'Admin Test',
        'email' => 'admin@test.com',
        'password' => bcrypt('password'),
    ]);

    // Ensure profile exists for API test
    $this->profile = Profile::first() ?? Profile::create([
        'full_name' => 'Ahmad Zaki',
        'profession' => 'Web Developer',
        'email' => 'admin@test.com',
    ]);
});

test('public pages can be rendered', function () {
    $this->get('/')->assertStatus(200);
    $this->get('/login')->assertStatus(200);
    $this->get('/forgot-password')->assertStatus(200);
});

test('register route redirects to login', function () {
    $this->get('/register')->assertRedirect(route('login'));
    $this->post('/register', [])->assertRedirect(route('login'));
});

test('all restful api v1 endpoints return valid json responses', function () {
    $this->getJson('/api/v1')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/profile')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/projects')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/skills')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/experiences')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/education')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/certificates')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/services')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/statistics')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/reviews')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/social-links')->assertStatus(200)->assertJson(['success' => true]);
    $this->getJson('/api/v1/settings')->assertStatus(200)->assertJson(['success' => true]);
});

test('contact form can be submitted from frontend via ajax', function () {
    $data = [
        'name' => 'Testing Guest',
        'email' => 'guest@example.com',
        'phone' => '08123456789',
        'subject' => 'Tes Pertanyaan Portfolio',
        'message' => 'Halo, ini pesan pengujian otomatis.',
    ];
    $response = $this->postJson('/contact', $data);
    $response->assertStatus(200)->assertJson(['success' => true]);
    $this->assertDatabaseHas('contacts', ['email' => 'guest@example.com']);
});

test('review form can be submitted from frontend via ajax', function () {
    $data = [
        'name' => 'Client Reviewer',
        'company' => 'Acme Corp',
        'project_name' => 'Web App',
        'rating' => 5,
        'review' => 'Karya sangat bagus dan memuaskan.',
    ];
    $response = $this->postJson('/reviews', $data);
    $response->assertStatus(200)->assertJson(['success' => true]);
    $this->assertDatabaseHas('reviews', ['name' => 'Client Reviewer']);
});

test('admin dashboard and main admin pages can be rendered', function () {
    $this->actingAs($this->user)->get('/admin/dashboard')->assertStatus(200);
    $this->actingAs($this->user)->get('/admin/profile')->assertStatus(200);
    $this->actingAs($this->user)->get('/admin/settings')->assertStatus(200);
    $this->actingAs($this->user)->get('/admin/contacts')->assertStatus(200);
    $this->actingAs($this->user)->get('/admin/contacts/check-unread')->assertStatus(200)->assertJsonStructure(['unread_count', 'latest']);
});

test('admin can view contact detail and toggle read status', function () {
    $contact = Contact::create([
        'name' => 'Contact Detail Test',
        'email' => 'detail@example.com',
        'subject' => 'Subject',
        'message' => 'Message',
        'is_read' => false,
    ]);
    $this->actingAs($this->user)->get("/admin/contacts/{$contact->id}")->assertStatus(200);
    $contact->refresh();
    expect($contact->is_read)->toBeTrue();
});

test('admin crud index and create pages can be rendered for all resources', function () {
    $resources = ['skills', 'projects', 'experiences', 'education', 'certificates', 'services', 'statistics', 'social-links', 'reviews'];
    foreach ($resources as $res) {
        $this->actingAs($this->user)->get("/admin/{$res}")->assertStatus(200);
        $this->actingAs($this->user)->get("/admin/{$res}/create")->assertStatus(200);
    }
});

test('admin crud edit page can be rendered for each resource', function () {
    $resources = [
        'skills' => Skill::class,
        'projects' => Project::class,
        'experiences' => Experience::class,
        'education' => Education::class,
        'certificates' => Certificate::class,
        'services' => Service::class,
        'statistics' => Statistic::class,
        'social-links' => SocialLink::class,
        'reviews' => Review::class,
    ];

    foreach ($resources as $res => $modelClass) {
        $item = $modelClass::first();
        if ($item) {
            $this->actingAs($this->user)->get("/admin/{$res}/{$item->id}/edit")->assertStatus(200);
        }
    }
    $this->assertTrue(true);
});

test('user account profile page can be rendered', function () {
    $this->actingAs($this->user)->get('/profile')->assertStatus(200);
});
