<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginValidationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_email_is_required()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the login route
        $response = $this->json('POST', '/login', [
            'email' => 'johndoe@test.com',
            'password' => 'password1234',
        ]);

        //Checking for an email error
        $response->assertJsonValidationErrors('email');
    }

    public function test_login_check_if_email_is_valid()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the login route
        $response = $this->json('POST', '/login', [
            'email' => 'johndoe',
            'password' => 'password1234',
        ]);

        //Checking for an email error
        $response->assertJsonValidationErrors('email');
    }

    public function test_login_email_max_255()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the login route
        $response = $this->json('POST', '/login', [
            'email' => 'johndoepjtuebzpwzckcjafijyagmgeqjbarirjkomatsstzqpasyvzfggmoyuxiccgpzkkvzzknrgtfvshsdhbbzihysgqghsboavthiyfbjevooysnwqantxnsvlaodjuveoywvwfasibjsxcmowdnaczjznurotnlezkihrhwhtwgwpkyyoihkeynnlydtcqdwjdenvwidlsujuilpptqkooppnkxcrewxwqrxlcxxlubtgnarrolxqupipdgwhqygs@test.com',
            'password' => 'password1234',
        ]);

        //Checking for an email error
        $response->assertJsonValidationErrors('email');
    }

    public function test_check_if_email_is_valid()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the login route
        $response = $this->json('POST', '/login', [
            'email' => 'johndoe',
            'password' => 'password1234',
        ]);

        //Checking for an email error
        $response->assertJsonValidationErrors('email');
    }

    public function test_login_password_is_required()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the login route
        $response = $this->json('POST', '/login', [
            'email' => 'johndoe@test.com',
            'password' => '',
        ]);

        //Checking for a password error
        $response->assertJsonValidationErrors('password');
    }

    public function test_login_password_min_8()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the login route
        $response = $this->json('POST', '/login', [
            'email' => 'johndoe@test.com',
            'password' => 'passwor'
        ]);

        //Checking for a password error
        $response->assertJsonValidationErrors('password');
    }

    public function test_login_password_max_255()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the login route
        $response = $this->json('POST', '/login', [
            'email' => 'johndoe@test.com',
            'password' => 'sddfdlfckdfkdsnfkdmfkdfmsdkfmdskpjtuebzpwzckcjafijyagmgeqjbarirjkomatsstzqpasyvzfggmoyuxiccgpzkkvzzknrgtfvshsdhbbzihysgqghsboavthiyfbjevooysnwqantxnsvlaodjuveoywvwfasibjsxcmowdnaczjznurotnlezkihrhwhtwgwpkyyoihkeynnlydtcqdwjdenvwidlsujuilpptqkooppnkxcrewxwqrxlcxxlubtgnarrolxqupipdgwhqygsdddsds',
        ]);

        //Checking for a password error
        $response->assertJsonValidationErrors('password');
    }
}