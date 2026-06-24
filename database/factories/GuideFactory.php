<?php

namespace Database\Factories;

use App\Models\Guide;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Guide>
 */
class GuideFactory extends Factory
{
    protected $model = Guide::class;

    public function definition(): array
    {
        $categories = ['General', 'Laravel', 'PHP', 'Front-end', 'Productividad'];
        $title = fake()->unique()->sentence(4);

        return [
            'title' => $title,
            'description' => fake()->paragraphs(3, true),
            'category' => fake()->randomElement($categories),
            'file_path' => 'guides/' . str($title)->slug() . '.pdf',
            'file_type' => 'application/pdf',
            'visibility' => 'public',
        ];
    }
}
