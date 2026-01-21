<?php

use App\Models\User;
use Mockery\MockInterface;

test('leveranciers index page is displaying correctly', function () {
    // 1. Mock the specific static methods for this test
    // We use 'alias:' to mock public static methods of LeverancierModel
    $m = Mockery::mock('alias:App\Models\LeverancierModel');

    $m->shouldReceive('getallleveranciersbytype')
      ->andReturn([
          (object)[
              'Id' => 1,
              'Naam' => 'Unieke Leverancier',
              'LeverancierType' => 'TypeA',
              'ContactPersoon' => 'Test',
              'Email' => 'Test',
              'Mobiel' => 'Test',
              'LeverancierNummer' => '123'
          ]
      ]);

    $m->shouldReceive('getallleveranciertype')
      ->andReturn([
          (object)['LeverancierType' => 'TypeA']
      ]);

    // 2. Mock User with Role
    // We create a partial mock of User to override hasRole
    $user = Mockery::mock(User::class)->makePartial();
    $user->shouldReceive('hasRole')->andReturn(true); // Always authorized
    $user->shouldReceive('getAuthIdentifier')->andReturn(1); // Required for actingAs
    $user->id = 1;

    // 3. Perform Request
    // We need to disable exception handling to see if middleware blocks us
    $response = $this->actingAs($user)->get(route('leveranciers.index'));

    // 4. Assertions
    $response->assertStatus(200);
    $response->assertSee('Overzicht Leveranciers');
    $response->assertSee('Unieke Leverancier');
    $response->assertSee('TypeA');
});

test('leveranciers show page displays product details and edit icon for manager', function () {
    // 1. Mock LeverancierModel
    $m = Mockery::mock('alias:App\Models\LeverancierModel');
    $m->shouldReceive('GetLeverancierById')->andReturn((object)[
        'LeverancierNaam' => 'Detail Leverancier',
        'LeverancierNummer' => 'L999',
        'LeverancierType' => 'TypeX'
    ]);
    $m->shouldReceive('GetProductPerLeverancierById')->andReturn([
        (object)[
            'Id' => 10,
            'Naam' => 'Product X',
            'SoortAllergie' => 'Geen',
            'Barcode' => '123456',
            'Houdbaarheidsdatum' => '01-01-2030'
        ]
    ]);

    // 2. Mock User as Manager
    $user = Mockery::mock(User::class)->makePartial();
    $user->shouldReceive('hasRole')->andReturn(true);
    $user->shouldReceive('getAuthIdentifier')->andReturn(1);
    $user->id = 1;

    $response = $this->actingAs($user)->get(route('leveranciers.show', 1));

    $response->assertStatus(200);
    $response->assertSee('Overzicht producten');
    $response->assertSee('Product X');
    // Manager sees edit icon
    $response->assertSee('bi-pencil-square');
});

test('leveranciers update page displays form correctly', function () {
    $m = Mockery::mock('alias:App\Models\LeverancierModel');
    $m->shouldReceive('GetProductById')->andReturn((object)[
        'Id' => 10,
        'Houdbaarheidsdatum' => '2025-12-31',
        'LeverancierId' => 1
    ]);

    $user = Mockery::mock(User::class)->makePartial();
    $user->shouldReceive('hasRole')->andReturn(true);
    $user->shouldReceive('getAuthIdentifier')->andReturn(1);
    $user->id = 1;

    $response = $this->actingAs($user)->get(route('leveranciers.update.form', 10));

    $response->assertStatus(200);
    $response->assertSee('Wijzig Product');
    $response->assertSee('2025-12-31'); // Check if date is pre-filled
});
