<?php

use App\Models\Station;
use Illuminate\Database\Seeder;

class SeedStations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stations = [
            "Cairo",
            "Alexandria",
            "Al J\u012bzah",
            "Ismailia",
            "Port Said",
            "Luxor",
            "S\u016bh\u0101j",
            "Al Man\u015f\u016brah",
            "Suez",
            "Al Miny\u0101",
            "Ib\u2018\u0101d\u012byat Damanh\u016br",
            "Ban\u012b Suwayf",
            "Asy\u016b\u0163",
            "\u0162an\u0163\u0101",
            "Al Fayy\u016bm",
            "Asw\u0101n",
            "Qin\u0101",
            "Mallaw\u012b",
            "Al \u2018Ar\u012bsh",
            "Banh\u0101",
            "Ma\u2018\u015farat Sam\u0101l\u016b\u0163",
            "Kafr ash Shaykh",
            "Jirj\u0101",
            "Mars\u00e1 Ma\u0163r\u016b\u1e29",
            "Isn\u0101",
            "Ban\u012b Maz\u0101r",
            "Al Kh\u0101rijah",
            "B\u016br Saf\u0101jah",
            "A\u0163 \u0162\u016br",
            "S\u012bwah",
            "A\u1e11 \u1e10ab\u2018ah",
            "Al \u2018Alamayn",
            "As Sall\u016bm",
            "Qa\u015fr al Far\u0101firah",
            "Al Qa\u015fr",
            "Al Ghardaqah",
            "Bi\u2019r al \u2018Abd",
            "Rafa\u1e29",
            "Damanh\u016br",
            "Shib\u012bn al Kawm",
            "Damietta",
            "Ash Shaykh Zuwayd",
            "Az Zaq\u0101z\u012bq",
        ];

        foreach ($stations as $station) {
            Station::create([
                'name' => $station
            ]);
        }
    }
}
