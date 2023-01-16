<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use Illuminate\Support\Facades\Http;

uses(\Tests\OverallTestCase::class);

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function fakeGoogleConnection(): array
{
    $googleJson = [
        'scope' => 'https://www.googleapis.com/auth/drive',
        'created' => 1660143327,
        'expires_in' => 3599,
        'token_type' => 'Bearer',
        'access_token' => 'ya29.A0AVA9y1tlMIBA7OO65dTP6kbro6ORDl34wD5YB39gRMd0MNJOSrxeUlIuMuS-sAGYVdBw3cwgh7OCxuoGr0cdcqNVAUnmAxsqLd1bDgDdmJKvTcHKrOAwMGKDMSLiBS7xPyUkq8dHSfwV72Vg4Fm5w6ZUC5ueaCgYKATASATASFQE65dr8FS37biXdbmllXVeQfwXR5g0163',
        'refresh_token' => '1//091biKtK96VrjCgYIARAAGAkSNwF-L9IrScJtOcdjIuegWTNvITPXOnoN9vkXEnsmirGATv7lyd7zcHVuexjnEIaEkG64RPigJS4',
    ];

    Http::preventStrayRequests();

    Http::fake([
        'https://oauth2.googleapis.com/token' => Http::response($googleJson, 200),
    ]);

    return $googleJson;
}

function fakeProjectResponse()
{
    $array = [
        [
            'id' => '1IX-KpPt1ejjBgSfdCm3afCKFCBABZkHd_Pz0p2xt6sA',
            'type' => "application\/vnd.google-apps.document",
            'title' => 'This is a file test',
        ],
        [
            'id' => '1rttU_TD9Y5khQU2Adn-e-YLjG-nIsnJoyNr53IDNc1A',
            'type' => "application\/vnd.google-apps.document",
            'title' => 'Text Document',
        ],
        [
            'id' => '1MXbPvHCzFpxyRwz4MDqgDvy2jCEprcY1',
            'title' => 'subfolder',
            'type' => "application\/vnd.google-apps.folder",
            'content' => [
                [
                    'id' => '1_1csCZjgmLXfXFSDn4l_8HTtt7cqL0PETjYub1qljhY',
                    'type' => "application\/vnd.google-apps.document",
                    'title' => 'Document_1',
                ],
                [
                    'id' => '1E9LKq718f5hQJDvKQbOkq0jyGp2G1Mh6PsOrpFEF4fU',
                    'type' => "application\/vnd.google-apps.document",
                    'title' => 'New text',
                ],
                [
                    'id' => '1LyHDYO0pZ8ThJwlaRReX_K3Zu6vFuBpCu-dNIhIFisI',
                    'type' => "application\/vnd.google-apps.document",
                    'title' => 'this is inside a sub folder',
                ],
                [
                    'id' => '1hqGsd7xzABiHwuNY57KZG1OGR09Z_ub2',
                    'title' => 'FOLDER INSIDE',
                    'type' => "application\/vnd.google-apps.folder",
                    'content' => [
                        [
                            'id' => '1ZNGUOnghPjWmA7naWPtc2f5j7ec8ozoZG2ymzL4IMB4',
                            'type' => "application\/vnd.google-apps.document",
                            'title' => 'this needs to work automatically on submit',
                        ],
                        [
                            'id' => '1r6d-HTsnk5zRSnbuyn8izDTW56eorA_uxb4r8EdC-Ms',
                            'type' => "application\/vnd.google-apps.document",
                            'title' => 'neato!',
                        ],
                        [
                            'id' => '1aXCeTFh9-1Z0CwgFql-ovyXEMbPpPLavMCB98ezhViE',
                            'type' => "application\/vnd.google-apps.document",
                            'title' => 'EVEN deeper',
                        ],
                    ],
                ],
            ],
        ],
    ];
}
