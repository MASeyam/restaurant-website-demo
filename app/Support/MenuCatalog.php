<?php

namespace App\Support;

class MenuCatalog
{
    /**
     * @return array<string, array<int, array<string, float|string>>>
     */
    public static function sections(): array
    {
        return [
            'Starters' => [
                ['key' => 'beet_carpaccio', 'name' => 'Coal-Roasted Beet Carpaccio', 'desc' => 'Goat cheese mousse, pistachio dust', 'price' => 14.00],
                ['key' => 'crisp_calamari', 'name' => 'Crisp Calamari', 'desc' => 'Lemon aioli, smoked paprika salt', 'price' => 16.00],
                ['key' => 'heirloom_tomato_salad', 'name' => 'Heirloom Tomato Salad', 'desc' => 'Basil oil, whipped feta, sourdough shard', 'price' => 15.00],
            ],
            'Main Course' => [
                ['key' => 'woodfire_chicken_supreme', 'name' => 'Woodfire Chicken Supreme', 'desc' => 'Herb butter, charred greens, potato pave', 'price' => 31.00],
                ['key' => 'saffron_seafood_risotto', 'name' => 'Saffron Seafood Risotto', 'desc' => 'Shrimp, mussels, roasted garlic', 'price' => 36.00],
                ['key' => 'braised_short_rib', 'name' => 'Braised Short Rib', 'desc' => 'Silky mash, glazed carrots, pepper jus', 'price' => 38.00],
            ],
            'Desserts' => [
                ['key' => 'vanilla_bean_panna_cotta', 'name' => 'Vanilla Bean Panna Cotta', 'desc' => 'Berry compote, almond crumble', 'price' => 12.00],
                ['key' => 'dark_chocolate_dome', 'name' => 'Dark Chocolate Dome', 'desc' => 'Hazelnut praline, espresso cream', 'price' => 13.00],
                ['key' => 'burnt_honey_cheesecake', 'name' => 'Burnt Honey Cheesecake', 'desc' => 'Citrus peel, thyme syrup', 'price' => 12.00],
            ],
            'Drinks' => [
                ['key' => 'ember_citrus_fizz', 'name' => 'Ember Citrus Fizz', 'desc' => 'Orange, mint, elderflower tonic', 'price' => 10.00],
                ['key' => 'smoked_berry_mule', 'name' => 'Smoked Berry Mule', 'desc' => 'Ginger, berries, lime, soda', 'price' => 11.00],
                ['key' => 'house_cold_brew_tonic', 'name' => 'House Cold Brew Tonic', 'desc' => 'Local coffee, tonic, vanilla mist', 'price' => 8.00],
            ],
        ];
    }

    /**
     * @return array<string, array<string, float|string>>
     */
    public static function items(): array
    {
        $items = [];

        foreach (self::sections() as $section => $sectionItems) {
            foreach ($sectionItems as $item) {
                $items[$item['key']] = [
                    'key' => $item['key'],
                    'name' => $item['name'],
                    'desc' => $item['desc'],
                    'price' => $item['price'],
                    'section' => $section,
                ];
            }
        }

        return $items;
    }

    /**
     * @return array<string, float|string>|null
     */
    public static function find(string $key): ?array
    {
        return self::items()[$key] ?? null;
    }
}
