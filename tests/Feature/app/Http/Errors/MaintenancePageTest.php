<?php

declare(strict_types=1);

afterEach(function (): void {
    app()->maintenanceMode()->deactivate();
});

test('displays the maintenance page when the application is down', function (): void {
    app()->maintenanceMode()->activate([]);

    $response = $this->get('/');

    $response->assertStatus(503)
        ->assertSee(__('We are not down, we are just tuning things up.'))
        ->assertSee(__('Try again'));
});

test('displays the maintenance page translated to catalan', function (): void {
    app()->setLocale('ca');
    app()->maintenanceMode()->activate([]);

    $response = $this->get('/');

    $response->assertStatus(503)
        ->assertSee('No hem caigut, només estem posant-ho tot a punt.')
        ->assertSee('Torna-ho a provar');
});
