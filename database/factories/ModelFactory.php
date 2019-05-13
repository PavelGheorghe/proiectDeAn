<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->safeEmail,
        'password'          => bcrypt(str_random(10)),
        'remember_token'    => str_random(10),
    ];
});

$factory->define(App\Models\LondonBroker::class, function (Faker\Generator $faker) {
    return [
        'reference_number' => $faker->randomNumber(),
        'name'             => $faker->name,
        'address'          => $faker->streetAddress,
        'note'             => str_random(10),
    ];
});

$factory->define(App\Models\Coverholder::class, function (Faker\Generator $faker) {
    return [
        'name'            => $faker->name,
        'pin'             => str_random(),
        'street'          => $faker->streetAddress,
        'note'            => $faker->sentence,
    ];
});

$factory->define(App\Models\BusinesClass::class, function (Faker\Generator $faker) {
    return [
        'name'            => $faker->name,
    ];
});

$factory->define(App\Models\Risks::class, function (Faker\Generator $faker) {
    return [
        'risk_code'            => str_random(10),
        'description'          => $faker->sentence,
        'bussines_classes_id'  => factory(App\Models\BusinesClass::class)->create()->id,
        'first_year'           => $faker->year,
        'last_year'            => $faker->year,
        'class_of_business'    => $faker->word,
    ];
});

$factory->define(App\Models\Company::class, function (Faker\Generator $faker) {
    return [
        'name'          => 'BSS-Company' . str_random(10),
        'piva'          => 'piva-' . str_random(5),
        'street'        => $faker->streetAddress,
        'note'          => $faker->sentence,
    ];
});

// Assign companies to binders when creating them
// factory(AreaBinder::class, 5)->create()->each(function($binder) {
//     $binder->companies()->save(factory(Company::class)->make());
// });
$factory->define(App\Models\AreaBinder::class, function (Faker\Generator $faker) {
    return [
        'label'                             => 'BSS-Binder_' . str_random(6),
        'is_main'                           => $faker->randomElement(App\Models\AreaBinder::getMainConstants()),
        'group_id'                          => null,
        'placement_type'                    => $faker->randomElement(App\Models\AreaBinder::getPlacementTypesConstants()),
        'umr'                               => $faker->randomElement([str_random(3), null]),
        'agreement_nr'                      => $faker->randomElement([str_random(3), null]),
        'section_nr'                        => $faker->randomNumber(),
        'inception_date'                    => $faker->dateTimeThisYear('-1 month'),
        'expiration_date'                   => $faker->dateTimeThisYear('+1 month'),
        'competence'                        => $faker->randomElement(App\Models\AreaBinder::getCompetenceConstants()),
        'year_of_account'                   => $faker->numberBetween(1000, 9999),
        'london_broker_id'                  => factory(App\Models\LondonBroker::class)->create()->id,
        'coverholder_id'                    => factory(App\Models\Coverholder::class)->create()->id,
        'risk_id'                           => factory(App\Models\Risks::class)->create()->id,
        'insurance_type'                    => $faker->randomElement(App\Models\AreaBinder::getInsuranceTypesConstants()),
        'delegated_authority'               => $faker->numberBetween(1000, 9999),
        'agreed_tpa_fee'                    => $faker->numberBetween(1, 99),
        'tpa_invoicing_method_opening'      => $faker->numberBetween(1, 99),
        'tpa_invoicing_method_closing'      => $faker->numberBetween(1, 99),
        'note'                              => $faker->sentence,
    ];
});


$factory->define(App\Models\Guarantee::class, function (Faker\Generator $faker) {
    return [
        'policy_type'       => 'PolicyType-' . str_random(5),
        'section_name'      => $faker->word,
        'guarantee_name'    => $faker->word,
    ];
});

$factory->define(App\Models\Broker::class, function (Faker\Generator $faker) {
    return [
        'type'       => $faker->randomElement(App\Models\Broker::getTypesConstants()),
        'name'       => 'BrokerName-' . str_random(5),
        'address'    => $faker->address,
        'note'       => $faker->sentence,
    ];
});

$factory->define(App\Models\PolicyType::class, function (Faker\Generator $faker) {
    return [
        'type'              => $faker->word,
        'insured_type'      => $faker->word,
        'note'              => $faker->sentence,
    ];
});
