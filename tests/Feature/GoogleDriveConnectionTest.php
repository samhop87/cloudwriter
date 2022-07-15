<?php

namespace Tests\Feature;

test('redirects to oAuth screen', function () {
    $response = $this->get('/connect');
    $response->assertRedirect();
    $response->assertRedirectContains('https://accounts.google.com/o/oauth2/auth');
});

test('auth code returns access token', function () {
    // MOCK RESPONSE
    $responseJson = fakeGoogleConnection();

//    $response = $this->get(
//        '/api/authorise?code=4%2F0AX4XfWhAIzzycFnXuMX-AmrlEXwicWH3YZAzZGnTAzN9n0rSvlJPbDCVKijtPJdKoIjJtQ&
//        scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive%20https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdocuments');

    $response->assertEquals($responseJson, $response->getContent());
});

