<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TravelRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_travel_request()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $data = [
            'requester_name' => 'João Teste',
            'destination' => 'Lisboa',
            'departure_date' => now()->addDays(3)->toDateString(),
            'return_date' => now()->addDays(10)->toDateString(),
        ];

        $response = $this->postJson('/api/requests', $data);
        $response->assertStatus(201)->assertJsonFragment(['destination' => 'Lisboa']);
    }

    public function test_user_cannot_update_own_status()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $request = TravelRequest::factory()->create(['user_id' => $user->id]);

        $response = $this->patchJson("/api/requests/{$request->id}/status", [
            'status' => 'cancelado'
        ]);

        $response->assertStatus(403);
    }
}
