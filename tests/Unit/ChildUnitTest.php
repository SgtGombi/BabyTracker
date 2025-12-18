<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\user\ChildController;

class ChildUnitTest extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

    public function test_child_create_happy_path()
    {
        // arrange: mock authenticated user
        $user = new \stdClass();
        $user->id = 42;

        Auth::shouldReceive('guard')->with('web')->andReturnSelf();
        Auth::shouldReceive('user')->andReturn($user);

        $payload = [
            'first_name' => 'Bela',
            'last_name' => 'Kis',
            'nickname' => 'B',
            'age_months' => 5,
            'gender' => 'boy',
            'height' => 60,
            'weight' => '6.50',
            'note' => 'unit test',
        ];

        // mock Child::create (alias) to return an object
        $childObj = (object) array_merge(['id' => 7], $payload, ['user_id' => $user->id]);
        \Mockery::mock('alias:App\\Models\\Child')
            ->shouldReceive('create')
            ->once()
            ->andReturn($childObj);

        // act
        $controller = new ChildController();
        $request = Request::create('/user/children', 'POST', $payload);
        $response = $controller->create($request);

        // assert
        $this->assertInstanceOf(\Illuminate\Http\JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->getData()->success);
        $this->assertEquals(7, $response->getData()->child->id);
    }

    public function test_child_create_error_missing_first_name()
    {
        $this->expectException(ValidationException::class);

        $user = new \stdClass();
        $user->id = 1;
        Auth::shouldReceive('guard')->with('web')->andReturnSelf();
        Auth::shouldReceive('user')->andReturn($user);

        $payload = [
            // missing first_name
            'last_name' => 'NoFirst',
            'gender' => 'girl',
        ];

        $controller = new ChildController();
        $request = Request::create('/user/children', 'POST', $payload);

        $controller->create($request);
    }
}
