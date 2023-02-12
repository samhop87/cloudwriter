<?php

return [
    'admin' => [
        'email' => env('ADMIN_EMAIL'),
        'name' => env('ADMIN_USER'),
        'password' => env('ADMIN_PW'),
    ],
    'story_shapes' => [
        [
            'id' => 1,
            'name' => 'man in a hole',
            'description' => 'The main character gets into trouble and then gets out of it again, better for the experience.',
            'image' => 'man_in_a_hole.jpeg'
        ],
        [
            'id' => 2,
            'name' => 'boy meets girl',
            'description' => 'The main character gets something wonderful, loses it, then gets it back forever.',
            'image' => 'boy_meets_girl.jpeg'
        ],
        [
            'id' => 3,
            'name' => 'from bad to worse',
            'description' => 'Main character starts off poorly, gets worse with no hope of improvement',
            'image' => 'bad_to_worse.jpeg'
        ],
        [
            'id' => 4,
            'name' => 'which way is up',
            'description' => 'An ambiguous story where we aren\'t sure whether developments are good or bad.',
            'image' => 'which_way_up.jpeg'
        ],
        [
            'id' => 5,
            'name' => 'creation story',
            'description' => 'Incremental gifts from a deity and long-term happiness',
            'image' => 'creation_story.jpeg'
        ],
        [
            'id' => 6,
            'name' => 'old testament',
            'description' => 'Receives incremental gifts from a deity, but is punished and suffers a dramatic fall from grace.',
            'image' => 'old_testament.jpeg'
        ],
        [
            'id' => 7,
            'name' => 'new testament',
            'description' => 'Same as old testament, but with a happy ending.',
            'image' => 'new_testament.jpeg'
        ],
    ],
];
