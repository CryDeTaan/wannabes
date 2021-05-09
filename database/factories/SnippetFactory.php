<?php

namespace Database\Factories;

use App\Models\Snippet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SnippetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Snippet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = Str::title($this->faker->sentence(2));
        $excerpt = Str::ucfirst($this->faker->sentence(3));

        $markdown =
            "# {$title} \n" .
            "## {$excerpt} \n\n" .
            $this->faker->paragraph();

        return [
            'title'     => $title,
            'excerpt'   => $excerpt,
            'markdown'  => $markdown,
        ];
    }
}
