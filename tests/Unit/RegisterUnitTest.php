<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\user\RegisterController;

class RegisterUnitTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

    // happy path: sikeres reg. mockeryvel, db kapcsolat nélkül
    public function test_register_happy_path()
    {
        $payload = [
            'first_name' => 'Unit',
            'last_name' => 'Test',
            'email' => 'unit@test',
            'password' => 'erosjelszo',
            'password_confirmation' => 'erosjelszo',
            'phone' => '0620345678',
        ];

        $presence = \Mockery::mock(\Illuminate\Validation\PresenceVerifierInterface::class);
        $presence->shouldReceive('getCount')->andReturn(0);
        $this->app->instance(\Illuminate\Validation\PresenceVerifierInterface::class, $presence);

        \Illuminate\Support\Facades\Hash::shouldReceive('make')->once()->with('erosjelszo')->andReturn('hashed');

        $userObj = new \stdClass();
        $userObj->id = 99;

        \Mockery::mock('alias:App\\Models\\User')
            ->shouldReceive('create')
            ->once()
            ->andReturn($userObj);

        \Illuminate\Support\Facades\Auth::shouldReceive('guard')->with('web')->andReturnSelf();
        \Illuminate\Support\Facades\Auth::shouldReceive('login')->with($userObj)->once();

        $controller = new RegisterController();
        $request = Request::create('/register', 'POST', $payload);

        $response = $controller->register($request);

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals(url('/'), $response->getTargetUrl());
    }
    
    // error path: jelszo hossza tul rovid. sikeres futas.
    public function test_register_error_path()
    {
        $this->expectException(ValidationException::class);

        $payload = [
            'first_name' => 'Bad',
            'last_name' => 'Pass',
            'email' => 'badpass@test',
            'password' => '123',
            'password_confirmation' => '123',
        ];

        $controller = new RegisterController();
        $request = Request::create('/register', 'POST', $payload);

        $controller->register($request);
    }
}
