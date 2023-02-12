<?php

return [
    'admin' => [
        'email' => env('ADMIN_EMAIL'),
        'name' => env('ADMIN_USER'),
        'password' => env('ADMIN_PW'),
    ],
    'story_shapes' => [
        [
            'name' => 'man in a hole',
            'description' => 'The main character gets into trouble and then gets out of it again, better for the experience.',
            'image' => 'man_in_a_hole.jpg'
        ],
        [
            'name' => 'boy meets girl',
            'description' => 'The main character gets something wonderful, loses it, then gets it back forever.',
            'image' => 'boy_meets_girl.jpg'
        ],
        [
            'name' => 'from bad to worse',
            'description' => 'Main character starts off poorly, gets worse with no hope of improvement',
            'image' => 'bad_to_worse.jpg'
        ],
        [
            'name' => 'which way is up',
            'description' => 'An ambiguous story where we aren\'t sure whether developments are good or bad.',
            'image' => 'which_way_up.jpg'
        ],
        [
            'name' => 'creation story',
            'description' => 'Incremental gifts from a deity and long-term happiness',
            'image' => 'creation_story.jpg'
        ],
        [
            'name' => 'old testament',
            'description' => 'Receives incremental gifts from a deity, but is punished and suffers a dramatic fall from grace.',
            'image' => 'old_testament.jpg'
        ],
        [
            'name' => 'new testament',
            'description' => 'Same as old testament, but with a happy ending.',
            'image' => 'new_testament.jpg'
        ],
    ],
];
