<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAnAccountValidationsTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_firstname_is_required()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => '',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a firstname error
        $response->assertJsonValidationErrors('firstname');
    }

    public function test_firstname_is_number()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 123,
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a firstname error
        $response->assertJsonValidationErrors('firstname');
    }

    public function test_firstname_max_25()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'johndoejohndoejohndoejohndoejohndoe',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a firstname error
        $response->assertJsonValidationErrors('firstname');
    }

    public function test_surname_is_required()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => '',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a surname error
        $response->assertJsonValidationErrors('surname');
    }

    public function test_surname_is_number()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 123,
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a surname error
        $response->assertJsonValidationErrors('surname');
    }

    public function test_surname_max_25()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'johndoejohndoejohndoejohndoejohndoe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a surname error
        $response->assertJsonValidationErrors('surname');
    }

    public function test_username_is_required()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => '',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a username error
        $response->assertJsonValidationErrors('username');
    }

    public function test_username_is_not_unique()
    {
        //without exception handling
        $this->withExceptionHandling();

        $user = User::factory()->create();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => $user->username,
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a username error
        $response->assertJsonValidationErrors('username');
    }

    public function test_email_is_required()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => '',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a email error
        $response->assertJsonValidationErrors('email');
    }

    public function test_check_email_is_valid()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a email error
        $response->assertJsonValidationErrors('email');
    }

    public function test_email_max_255()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoepjtuebzpwzckcjafijyagmgeqjbarirjkomatsstzqpasyvzfggmoyuxiccgpzkkvzzknrgtfvshsdhbbzihysgqghsboavthiyfbjevooysnwqantxnsvlaodjuveoywvwfasibjsxcmowdnaczjznurotnlezkihrhwhtwgwpkyyoihkeynnlydtcqdwjdenvwidlsujuilpptqkooppnkxcrewxwqrxlcxxlubtgnarrolxqupipdgwhqygs@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a email error
        $response->assertJsonValidationErrors('email');
    }

    public function test_email_is_not_unique()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Creating a user
        $user = User::factory()->create();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => $user->email,
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a email error
        $response->assertJsonValidationErrors('email');  
    }

    public function test_dob_is_required()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a dob error
        $response->assertJsonValidationErrors('dob');
    }

    public function test_gender_is_required()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => '',
            'password' => 'password1234',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a gender error
        $response->assertJsonValidationErrors('gender');
    }

    public function test_password_is_required()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => '',
            'password_confirmation' => 'password1234',
        ]);

        //Checking for a password error
        $response->assertJsonValidationErrors('password');
    }

    public function test_password_is_number()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 12345678,
            'password_confirmation' => 12345678,
        ]);

        //Checking for a password error
        $response->assertJsonValidationErrors('password');
    }

    public function test_password_min_8()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'passwor',
            'password_confirmation' => 'passwor',
        ]);

        //Checking for a password error
        $response->assertJsonValidationErrors('password');
    }

    public function test_password_max_255()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'sddfdlfckdfkdsnfkdmfkdfmsdkfmdskpjtuebzpwzckcjafijyagmgeqjbarirjkomatsstzqpasyvzfggmoyuxiccgpzkkvzzknrgtfvshsdhbbzihysgqghsboavthiyfbjevooysnwqantxnsvlaodjuveoywvwfasibjsxcmowdnaczjznurotnlezkihrhwhtwgwpkyyoihkeynnlydtcqdwjdenvwidlsujuilpptqkooppnkxcrewxwqrxlcxxlubtgnarrolxqupipdgwhqygsdddsds',
            'password_confirmation' => 'sddfdlfckdfkdsnfkdmfkdfmsdkfmdskpjtuebzpwzckcjafijyagmgeqjbarirjkomatsstzqpasyvzfggmoyuxiccgpzkkvzzknrgtfvshsdhbbzihysgqghsboavthiyfbjevooysnwqantxnsvlaodjuveoywvwfasibjsxcmowdnaczjznurotnlezkihrhwhtwgwpkyyoihkeynnlydtcqdwjdenvwidlsujuilpptqkooppnkxcrewxwqrxlcxxlubtgnarrolxqupipdgwhqygsdddsds',
        ]);

        //Checking for a password error
        $response->assertJsonValidationErrors('password');
    }

    public function test_password_is_not_confirmed()
    {
        //without exception handling
        $this->withExceptionHandling();

        //Sending a post request to the register route
        $response = $this->json('POST', '/register', [
            'firstname' => 'John',
            'surname' => 'Doe',
            'username' => 'JohnDoe',
            'email' => 'johndoe@test.com',
            'dob' => '1986-01-11',
            'gender' => 'Male',
            'password' => 'password1234',
            'password_confirmation' => '',
        ]);

        //Checking for a password error
        $response->assertJsonValidationErrors('password');
    }
}
