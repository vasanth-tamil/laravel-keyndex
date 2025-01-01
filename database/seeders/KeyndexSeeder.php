<?php

namespace Database\Seeders;

use App\Enums\PageContentTypeEnum;
use App\Models\keyndexTemplate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeyndexSeeder extends Seeder
{
    public function run(): void
    {
        $baseStructure = [
            "title" => "Welcome to the my webpage",
            "subTitle" => "Sample description home automation in this information inversion in to meaning."
        ];

        keyndexTemplate::create([
            'identifier' => 'hero2',
            'title' => 'Section Hero2',
            'structure' => json_encode([
                'title' => 'Welcome to my webpage',
                'subTitle' => 'Sample description home automation in this information inversion into meaning.',
            ]),
            'default_content' => null,
            'content_type' => 'json',
            'version' => 1,
            'status' => true
        ]);

    }
}
