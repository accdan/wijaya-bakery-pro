<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RateLimitingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login rate limiting blocks after 5 attempts
     */
    public function test_login_rate_limiting_blocks_after_five_attempts(): void
    {
        // Create a test user
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        // Try to login 5 times with wrong password
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/login-user', [
                'username' => $user->username,
                'password' => 'wrongpassword',
            ]);

            $response->assertStatus(302); // Redirect back
        }

        // 6th attempt should be rate limited (429 Too Many Requests)
        $response = $this->post('/login-user', [
            'username' => $user->username,
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(429);
    }

    /**
     * Test register rate limiting blocks after 5 attempts
     */
    public function test_register_rate_limiting_blocks_after_five_attempts(): void
    {
        // Try to register 5 times
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/register-user', [
                'name' => 'Test User ' . $i,
                'username' => 'testuser' . $i,
                'email' => 'test' . $i . '@example.com',
                'no_telepon' => '08123456789' . $i,
                'password' => 'password123',
                'password_confirmation' => 'password123',
            ]);
        }

        // 6th attempt should be rate limited
        $response = $this->post('/register-user', [
            'name' => 'Test User 6',
            'username' => 'testuser6',
            'email' => 'test6@example.com',
            'no_telepon' => '081234567896',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(429);
    }

    /**
     * Test password reset rate limiting blocks after 3 attempts
     */
    public function test_password_reset_rate_limiting_blocks_after_three_attempts(): void
    {
        $user = User::factory()->create();

        // Try password reset 3 times
        for ($i = 0; $i < 3; $i++) {
            $response = $this->post('/forgot-password', [
                'email' => $user->email,
            ]);
        }

        // 4th attempt should be rate limited (stricter than login)
        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response->assertStatus(429);
    }

    /**
     * Test admin login rate limiting
     */
    public function test_admin_login_rate_limiting_blocks_after_five_attempts(): void
    {
        // Try to login to admin 5 times
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/login-admin', [
                'username' => 'admin',
                'password' => 'wrongpassword',
            ]);
        }

        // 6th attempt should be rate limited
        $response = $this->post('/login-admin', [
            'username' => 'admin',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(429);
    }
}
