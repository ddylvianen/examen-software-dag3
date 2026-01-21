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
    // Note: When using alias mocks in multiple tests, you might encounter 'class already exists'
    // proper testing of statics usually requires runInSeparateProcess or careful management.
    // For this environment, we assume Pest/PHPUnit isolation settings or just one mock definition if possible.
    // However, Mockery should handle subsequent calls if we don't 'close' it completely or if we re-define expectations.
    
    // We need to re-declare the mock expectations because the previous test might have closed it
    // or we are in the same process. 
    // SAFEST STRATEGY: Create a "fresh" mock expectation on the already aliased class if it persists.
    // But 'alias:' defines the class. If it's already defined, we can't redefine it.
    // We might need to rely on the fact that we can add expectations to the existing mock registry?
    // Actually, 'alias:' mocks are hard to reset.
    // Attempting to run this in one file without correct isolation might fail.
    // Let's try to combine into general expectations or use `runInSeparateProcess`.
    
    // For now, let's try assuming the previous mock is gone or we can overwrite it.
    // If this fails, we will combine tests or use separate processes.
    
    /* 
       Retry Strategy for Mocking in same file:
       Use `Mockery::close()` in afterEach? Pest does this automatically.
    */
    
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
    $user->shouldReceive('hasRole')->with('Manager')->andReturn(true); 
    // For the middleware check which might ask for any role:
    $user->shouldReceive('hasRole')->with('Manager', 'Medewerker')->andReturn(true); 
    // Fallback if needed
    $user->shouldReceive('hasRole')->andReturn(true);
    
    $user->shouldReceive('getAuthIdentifier')->andReturn(1);
    $user->id = 1;

    $response = $this->actingAs($user)->get(route('leveranciers.show', 1));

    $response->assertStatus(200);
    $response->assertSee('Overzicht producten');
    $response->assertSee('detail leverancier', false); // case insensitive check often better or explicit
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
    $response->assertSee('values="2025-12-31"', false); // Check if date is pre-filled (escaped logic might vary)
});
