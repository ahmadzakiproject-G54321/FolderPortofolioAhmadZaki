<?php

use App\Models\Profile;
use App\Models\Review;
use App\Models\Statistic;
use App\Models\Project;

it('displays homepage with stats, reviews, and interactive google maps', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Proyek Selesai');
    $response->assertSee('Tahun Pengalaman');
    $response->assertSee('Klien Puas');
    $response->assertSee('REST API Dibangun');
    $response->assertSee('id="reviews"', false);
    $response->assertSee('map-interactive-wrap', false);
    $response->assertSee('maps.google.com', false);
});

it('can submit a client review successfully', function () {
    $data = [
        'name' => 'Budi Santoso',
        'company' => 'PT Teknologi Nusantara',
        'project_name' => 'E-Commerce Backend & REST API',
        'rating' => 5,
        'review' => 'Layanan sangat cepat, komunikatif, dan arsitektur kode sangat rapi!',
    ];

    $response = $this->postJson(route('review.store'), $data);

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
    ]);

    $this->assertDatabaseHas('reviews', [
        'name' => 'Budi Santoso',
        'rating' => 5,
        'is_approved' => false,
    ]);
});

it('validates required fields when submitting a review', function () {
    $response = $this->postJson(route('review.store'), [
        'rating' => 6, // invalid rating
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name', 'rating', 'review']);
});

it('generates maps iframe url from profile address and custom embed', function () {
    $profile = Profile::first() ?? new Profile();
    $profile->address = 'Bukittinggi, Sumatera Barat';
    $profile->maps_embed = null;
    
    expect($profile->maps_iframe_url)->toContain('maps.google.com/maps?q=Bukittinggi');

    $profile->maps_embed = '<iframe src="https://www.google.com/maps/embed?pb=custom_embed_test"></iframe>';
    expect($profile->maps_iframe_url)->toBe('https://www.google.com/maps/embed?pb=custom_embed_test');
});

it('displays stats based on actual database counts and admin input', function () {
    // 2 published projects
    Project::create([
        'title' => 'Project A',
        'slug' => 'project-a',
        'description' => 'Test Desc A',
        'status' => 'Published',
        'sort_order' => 1,
    ]);
    Project::create([
        'title' => 'Project B',
        'slug' => 'project-b',
        'description' => 'Test Desc B',
        'status' => 'Published',
        'sort_order' => 2,
    ]);

    // 1 approved review
    Review::create([
        'name' => 'Reviewer One',
        'rating' => 5,
        'review' => 'Good job',
        'is_approved' => true,
        'sort_order' => 1,
    ]);

    Statistic::create([
        'title' => 'Proyek Selesai',
        'number' => 99,
        'suffix' => '+',
        'icon' => 'bi-folder-check',
        'sort_order' => 1,
    ]);
    Statistic::create([
        'title' => 'Tahun Pengalaman',
        'number' => 3,
        'suffix' => '+',
        'icon' => 'bi-briefcase',
        'sort_order' => 2,
    ]);
    Statistic::create([
        'title' => 'Klien Puas',
        'number' => 99,
        'suffix' => '+',
        'icon' => 'bi-emoji-smile',
        'sort_order' => 3,
    ]);
    Statistic::create([
        'title' => 'REST API Dibangun',
        'number' => 20,
        'suffix' => '+',
        'icon' => 'bi-cpu',
        'sort_order' => 4,
    ]);

    $response = $this->get('/');
    $response->assertStatus(200);
    // Dynamic counts
    $response->assertSee('data-count="2"', false); // 2 published projects
    $response->assertSee('data-count="1"', false); // 1 approved review
    $response->assertSee('data-count="3"', false); // 3 years experience from admin
    $response->assertSee('data-count="20"', false); // 20 APIs from admin
});

