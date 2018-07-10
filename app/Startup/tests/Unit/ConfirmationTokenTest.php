<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConfirmationTokenTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function confirmation_trait_exists()
    {
        //trait_exists
        $user = factory(User::class)->create([
            'id' => 12345,
        ]);

        $this->assertTrue(method_exists($user, 'createConfirmationToken'));
    }

    /**
     * @test
     */
    public function user_can_generate_email_confirmation_token()
    {
        $user = factory(User::class)->create([
            'id' => 12345,
        ]);

        $token = $user->createConfirmationToken();

        $this->assertDatabaseHas('confirmation_tokens', [
            'user_id' => 12345,
            'token' => $token,
        ]);
    }

    /**
     * @test
     */
    public function user_can_only_generate_one_confirmation_token()
    {
        $user = factory(User::class)->create([
            'id' => 12345,
        ]);

        $token1 = $user->createConfirmationToken();
        $token2 = $user->createConfirmationToken();
        $token3 = $user->createConfirmationToken();

        $this->assertDatabaseMissing('confirmation_tokens', [
            'user_id' => 12345,
            'token' => $token1,
        ]);

        $this->assertDatabaseMissing('confirmation_tokens', [
            'user_id' => 12345,
            'token' => $token2,
        ]);

        // should have only last one created
        $this->assertDatabaseHas('confirmation_tokens', [
            'user_id' => 12345,
            'token' => $token3,
        ]);
    }
}
