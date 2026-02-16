<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Log;
use App\Models\Tag;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Logs>
 */
class LogFactory extends Factory
{
    protected $model = Log::class;

   public function definition()
{
    $tagIds = Tag::pluck('id')->all(); // get ids of existing tags

    return [
        'username' => $this->faker->userName(),
        'email' => $this->faker->unique()->safeEmail(),
        'password' => 'password',
        'tag_id' => $this->faker->randomElement($tagIds), // use existing tags
        'referral_code_id' => strtoupper($this->faker->bothify('REF###')),
    ];
}
}
