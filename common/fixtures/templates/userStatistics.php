<?php
    /**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'user_id' => $faker->numberBetween(1,21),
    'tasks_done' => $faker->numberBetween(1,21),
    'tasks_failed' => $faker->numberBetween(1,21),
    'reviews_done' => $faker->numberBetween(1,21),
    'reviews_received' => $faker->numberBetween(1,21),
    'rating' => $faker->randomFloat(2, 0, 5)
];
