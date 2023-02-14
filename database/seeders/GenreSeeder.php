<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = collect([
            'fantasy' => [
                'description' => 'Fantasy is a genre of speculative fiction set in a fictional universe, often inspired
                 by real world myth and folklore. Its roots are in oral traditions, which then became literature and
                 drama. From the twentieth century it has expanded further into various media, including film,
                 television, graphic novels, manga, and video games.',
                'image' => 'https://images.unsplash.com/photo-1589989367679-8b2f2f2b2f1f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8ZmFudGFzeXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80',
                'sub_genres' => [
                    'alternate history',
                    'dark fantasy',
                    'epic fantasy',
                    'high fantasy',
                    'urban fantasy',
                    'sword and sorcery',
                    'children\'s fantasy',
                    'comedy fantasy',
                    'contemporary fantasy',
                    'fairytale fantasy',
                    'magical realism',
                    'mythology',
                    'paranormal fantasy',
                    'romance fantasy',
                    'young adult fantasy',
                ],
            ],
            'horror' => [
                'description' => 'Horror is a genre of fiction which is intended to, or has the capacity to frighten,
                 scare, disgust, or startle their readers or viewers by inducing feelings of horror and terror.
                 Horror fiction often overlaps with the fantasy, supernatural fiction, and thriller genres.',
                'image' => 'https://images.unsplash.com/photo-1589989367679-8b2f2f2b2f1f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8ZmFudGFzeXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80',
                'sub_genres' => [
                    'ghost stories',
                    'gothic horror',
                    'haunted house',
                    'horror comedy',
                    'horror of manners',
                    'monster',
                    'occult',
                    'psychological horror',
                    'slasher',
                    'supernatural horror',
                    'vampire',
                    'werewolf',
                    'zombie',
                ],
            ],
            'mystery' => [
                'description' => 'A mystery is a story that revolves around the solution of a crime, puzzle, or
                 conflict. The mystery genre is a popular form of fiction, particularly in detective stories and
                 legal thrillers, but it can also be found in other media such as film, television, and video games.',
                'image' => 'https://images.unsplash.com/photo-1589989367679-8b2f2f2b2f1f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8ZmFudGFzeXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80',
                'sub_genres' => [
                    'cozy mystery',
                    'hardboiled',
                    'historical mystery',
                    'locked room mystery',
                    'medical mystery',
                    'mystery of manners',
                    'mystery thriller',
                    'noir',
                    'paranormal mystery',
                    'police procedural',
                    'psychological mystery',
                    'suspense',
                    'whodunit',
                ],
            ],
            'romance' => [
                'description' => 'Romance is a genre of fiction and, in its broadest sense, any fiction depicting
                 passionate love. However, the genre is usually considered to consist of works in which two people
                 fall in love and attempt to build a relationship. Subgenres of romance novels include historical
                 romance, paranormal romance, romantic suspense, and science fiction romance.',
                'image' => 'https://images.unsplash.com/photo-1589989367679-8b2f2f2b2f1f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8ZmFudGFzeXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80',
                'sub_genres' => [
                    'contemporary romance',
                    'erotic romance',
                    'historical romance',
                    'paranormal romance',
                    'romantic suspense',
                    'romantic comedy',
                    'romantic fantasy',
                    'romantic thriller',
                    'romantic mystery',
                    'romantic western',
                    'romantic science fiction',
                ],
            ],
            'science fiction' => [
                'description' => 'Science fiction is a genre of speculative fiction that typically deals with imaginative
                 and futuristic concepts such as advanced science and technology, spaceflight, time travel, parallel
                 universes, and extraterrestrial life. Science fiction often explores the potential consequences of
                 scientific and other innovations, and has been called a "literature of ideas".',
                'image' => 'https://images.unsplash.com/photo-1589989367679-8b2f2f2b2f1f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8ZmFudGFzeXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80',
                'sub_genres' => [
                    'cyberpunk',
                    'dystopian',
                    'hard science fiction',
                    'soft science fiction',
                    'space opera',
                    'time travel',
                    'utopian',
                    'dying earth',
                    'bio-punk',
                    'alternate history',
                    'generation ship',
                ],
            ],
            'western' => [
                'description' => 'A western is a genre of various arts which tell stories set primarily in the later
                 half of the 19th century in the American Old West, often centering on the life of a nomadic cowboy or
                 gunfighter armed with a revolver and a rifle who rides a horse. Westerns often stress the harshness
                 of the wilderness and frequently set the action in an arid, desolate landscape of deserts and
                 mountains.',
                'image' => 'https://images.unsplash.com/photo-1589989367679-8b2f2f2b2f1f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8ZmFudGFzeXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80',
                'sub_genres' => [
                    'historical western',
                    'neo-western',
                    'western comedy',
                    'western crime',
                    'western drama',
                    'western romance',
                    'western thriller',
                    'western adventure',
                    'western fantasy',
                    'western science fiction',
                ],
            ],
            'thriller' => [
                'description' => 'A thriller is a broad genre of literature, film and television, having numerous
                 subgenres. Thrillers are characterized and defined by the moods they elicit, giving viewers heightened
                 feelings of suspense, excitement, surprise, anticipation and anxiety. Successful examples of thrillers
                 are the films of Alfred Hitchcock.',
                'image' => 'https://images.unsplash.com/photo-1589989367679-8b2f2f2b2f1f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8ZmFudGFzeXxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=80',
                'sub_genres' => [
                    'espionage',
                    'medical thriller',
                    'military thriller',
                    'political thriller',
                    'psychological thriller',
                    'suspense',
                    'action',
                    'crime',
                    'disaster',
                    'legal',
                    'religious',
                    'young adult',
                ]
            ]
        ]);

        foreach ($genres as $genre => $data) {
            $genre = Genre::factory()->create([
                'name' => $genre,
                'description' => $data['description'],
//                'image' => $data['image'],
            ]);

            foreach ($data['sub_genres'] as $sub_genre) {
                $genre->subGenres()->create([
                    'name' => $sub_genre,
                ]);
            }
        }
    }
}
