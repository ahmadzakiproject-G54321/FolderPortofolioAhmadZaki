<?php

test('registration screen is disabled and redirects to login', function () {
    $response = $this->get('/register');

    $response->assertRedirect(route('login'));
});

test('new users cannot register publicly and are redirected to login', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertGuest();
    $response->assertRedirect(route('login'));
});
