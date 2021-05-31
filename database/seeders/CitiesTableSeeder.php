<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
        	[
	        	'name' => "Redding",
	        	'longitude' => "-122.3511032",
	        	'latitude' => "40.5630873",
	        ],
	        [
	        	'name' => "San Fernando",
	        	'longitude' => "-118.4406894",
	        	'latitude' => "34.2668701",
	        ],
	        [
	        	'name' => "Pacoima",
	        	'longitude' => "-118.4321461",
	        	'latitude' => "34.259143",
	        ],
	        [
	        	'name' => "Goshen",
	        	'longitude' => "-119.4279868",
	        	'latitude' => "36.3505094",
	        ],
	        [
	        	'name' => "Earlimart",
	        	'longitude' => "-119.2733638",
	        	'latitude' => "35.8837559",
	        ],
	        [
	        	'name' => "Corning",
	        	'longitude' => "-122.1811459",
	        	'latitude' => "39.9283454",
	        ],
	        [
	        	'name' => "Sacramento",
	        	'longitude' => "-121.4726349",
	        	'latitude' => "38.5249356",
	        ],
	        [
	        	'name' => "Delano",
	        	'longitude' => "-119.2460904",
	        	'latitude' => "35.7721409",
	        ],
	        [
	        	'name' => "Bell Gardens",
	        	'longitude' => "-118.1659478",
	        	'latitude' => "33.9679139",
	        ],
	        [
	        	'name' => "Dorris",
	        	'longitude' => "-121.9179973",
	        	'latitude' => "41.9662705",
	        ],
	        [
	        	'name' => "Lodi",
	        	'longitude' => "-121.2648943",
	        	'latitude' => "38.127219",
	        ],
	        [
	        	'name' => "San Diego",
	        	'longitude' => "-117.0315259",
	        	'latitude' => "32.5466894",
	        ],
	        [
	        	'name' => "Bakersfield",
	        	'longitude' => "-118.9686128",
	        	'latitude' => "35.3682594",
	        ],
	        [
	        	'name' => "Orland",
	        	'longitude' => "-122.1938054",
	        	'latitude' => "39.747006",
	        ],
	        [
	        	'name' => "Lakewood",
	        	'longitude' => "-118.1251665",
	        	'latitude' => "33.8692945",
	        ],
	        [
	        	'name' => "Fresno",
	        	'longitude' => "-119.791047",
	        	'latitude' => "36.734242",
	        ],
	        [
	        	'name' => "Huntington Park",	
	        	'longitude' => "-118.2268496",
	        	'latitude' => "33.9747984",
	        ],
	        [
	        	'name' => "Turlock (708, Lander Ave. Turlock)",
	        	'longitude' => "-120.8487557",
	        	'latitude' => "37.4863196",
	        ],
	        [
	        	'name' => "Selma (2813, Whitson St Selma)",
	        	'longitude' => "-119.6246395",
	        	'latitude' => "36.5761836",
	        ],
	        [
	        	'name' => "Atwater (1155, Bellivue Rd Atwater)",
	        	'longitude' => "-120.6044561",
	        	'latitude' => "37.3612621",
	        ],
	        [
	        	'name' => "Dinuba",
	        	'longitude' => "-119.3722987",
	        	'latitude' => "36.5454971",
	        ],
	        [
	        	'name' => "Reedley",
	        	'longitude' => "-119.4652769",
	        	'latitude' => "36.6034558",
	        ],
	        [
	        	'name' => "San Ysidro, (9777 Via De La Amista San Ysidro)",
	        	'longitude' => "-116.9390644",
	        	'latitude' => "32.5513657",
	        ],
	        [
	        	'name' => "Lodi (219, E. Pine St. Lodi)",	
	        	'longitude' => "-121.2684819",
	        	'latitude' => "38.1341593",
	        ],
	        [
	        	'name' => "Madera (208, C St Madera)",	
	        	'longitude' => "-120.0562548",
	        	'latitude' => "36.9618961",
	        ],
	        [
	        	'name' => "Madera (1484, Fresno St Madera)",
	        	'longitude' => "-120.0549522",
	        	'latitude' => "36.9790758",
	        ],
	        [
	        	'name' => "San Ysidro, (5922 Rail Court San Ysidro)",	
	        	'longitude' => "-117.0287584",
	        	'latitude' => "32.5445997",
	        ],
	        [
	        	'name' => "Manteca",
	        	'longitude' => "-121.2084156",
	        	'latitude' => "37.7972336",
	        ],
	        [
	        	'name' => "Tulare",
	        	'longitude' => "-119.3382614",
	        	'latitude' => "36.2240713",
	        ],
	        [
	        	'name' => "Visalia",
	        	'longitude' => "-119.2963267",
	        	'latitude' => "36.3572333",
	        ],
	        [
	        	'name' => "Stockton",
	        	'longitude' => "-121.271712",
	        	'latitude' => "37.9555228",
	        ],
	        [
	        	'name' => "Visalia",
	        	'longitude' => "-119.3102645",
	        	'latitude' => "36.342125",
	        ],
	        [
	        	'name' => "San Ysidro, (123 Main St San Ysidro)",	
	        	'longitude' => "-117.0435088",
	        	'latitude' => "32.5525287",
	        ],
	        [
	        	'name' => "Lindsay",
	        	'longitude' => "-119.0903769",
	        	'latitude' => "36.2028063",
	        ],
	        [
	        	'name' => "Selma (2415, Mc Call Ave Lindsay)",
	        	'longitude' => "-119.6109651",
	        	'latitude' => "36.5700168",
	        ],
	        [
	        	'name' => "Modesto",
	        	'longitude' => "-120.9806902",
	        	'latitude' => "37.6090308",
	        ],
	        [
	        	'name' => "Fresno",
	        	'longitude' => "-119.7970768",
	        	'latitude' => "36.7321985",
	        ],
	        [
	        	'name' => "Olympia",
	        	'longitude' => "-118.1762093",
	        	'latitude' => "34.0193514",
	        ],
	        [
	        	'name' => "Orosi",
	        	'longitude' => "-119.28822",
	        	'latitude' => "36.544602",
	        ],
	        [
	        	'name' => "Atwater (242, E. Bellevue Rd. Atwater)",
	        	'longitude' => "-120.5944459",
	        	'latitude' => "37.3601662",
	        ],
	        [
	        	'name' => "Merced",
	        	'longitude' => "-120.4878267",
	        	'latitude' => "37.3014061",
	        ],
	        [
	        	'name' => "Huntington Park",
	        	'longitude' => "-118.228196",
	        	'latitude' => "33.9747754",
	        ],
	        [
	        	'name' => "Medford",
	        	'longitude' => "-122.8957228",
	        	'latitude' => "42.324145",
	        ],
	        [
	        	'name' => "Grants Pass",	
	        	'longitude' => "-123.3588892",
	        	'latitude' => "42.4204072",
	        ],
	        [
	        	'name' => "Salem",
	        	'longitude' => "-122.9981384",
	        	'latitude' => "44.9512608",
	        ],
	        [
	        	'name' => "Tigard",
	        	'longitude' => "-122.7660119",
	        	'latitude' => "45.4343038",
	        ],
	        [
	        	'name' => "Hillsboro",
	        	'longitude' => "-122.9742695",
	        	'latitude' => "45.5194858",
	        ],
	        [
	        	'name' => "Hood River",
	        	'longitude' => "-121.5241161",
	        	'latitude' => "45.7001024",
	        ],
	        [
	        	'name' => "The Dalles"	,
	        	'longitude' => "-121.215307",
	        	'latitude' => "45.618383",
	        ],
	        [
	        	'name' => "Woodburn (479, North Front Street Woodburn)",
	        	'longitude' => "-122.8558417",
	        	'latitude' => "45.1433424",
	        ],
	        [
	        	'name' => "Redmond",
	        	'longitude' => "-121.1820811",
	        	'latitude' => "44.2542606",
	        ],
	        [
	        	'name' => "Portland",
	        	'longitude' => "-122.4976092",
	        	'latitude' => "45.5184152",
	        ],
	        [
	        	'name' => "Madras",
	        	'longitude' => "-121.1308788",
	        	'latitude' => "44.6353843",
	        ],
	        [
	        	'name' => "Klamath Falls",	
	        	'longitude' => "-121.7653418",
	        	'latitude' => "42.2195541",
	        ],
	        [
	        	'name' => "Springfield",
	        	'longitude' => "-123.0103282",
	        	'latitude' => "44.0462583",
	        ],
	        [
	        	'name' => "Woodburn (297, N Front ST Woodburn)",	
	        	'longitude' => "-122.8569549",
	        	'latitude' => "45.1422611",
	        ],
	        [
	        	'name' => "Roseburg",
	        	'longitude' => "-123.331673",
	        	'latitude' => "43.2184428",
	        ],
	        [
	        	'name' => "Eugene",
	        	'longitude' => "-123.113204",
	        	'latitude' => "44.0524798",
	        ],
	        [
	        	'name' => "Wenatchee",
	        	'longitude' => "-120.3033287",
	        	'latitude' => "47.4094117",
	        ],
	        [
	        	'name' => "Quincy",
	        	'longitude' => "-119.852804",
	        	'latitude' => "47.2321629",
	        ],
	        [
	        	'name' => "Vancouver",
	        	'longitude' => "-122.6617795",
	        	'latitude' => "45.6787875",
	        ],
	        [
	        	'name' => "Mattawa",
	        	'longitude' => "-119.9032995",
	        	'latitude' => "46.7376568",
	        ],
	        [
	        	'name' => "Wapato",
	        	'longitude' => "-120.419448",
	        	'latitude' => "46.445847",
	        ],
	        [
	        	'name' => "Toppenish",
	        	'longitude' => "-120.3236346",
	        	'latitude' => "46.3745599",
	        ],
	        [
	        	'name' => "Milton-Freewater",	
	        	'longitude' => "-118.3878728",
	        	'latitude' => "45.9615715",
	        ],
	        [
	        	'name' => "Walla Walla",	
	        	'longitude' => "-118.3475982",
	        	'latitude' => "46.0616699",
	        ],
	        [
	        	'name' => "Royal City",
	        	'longitude' => "-119.6302202",
	        	'latitude' => "46.8995466",
	        ],
	        [
	        	'name' => "Chelan",
	        	'longitude' => "-120.016425",
	        	'latitude' => "47.840166",
	        ],
	        [
	        	'name' => "Mabton",
	        	'longitude' => "-119.9968257",
	        	'latitude' => "46.214238",
	        ],
	        [
	        	'name' => "Grandview",
	        	'longitude' => "-119.9009949",
	        	'latitude' => "46.2551123",
	        ],
	        [
	        	'name' => "Moses Lake",	
	        	'longitude' => "-119.2807573",
	        	'latitude' => "47.1304004",
	        ],
	        [
	        	'name' => "Yakima, WA, USA",
	        	'longitude' => "-120.5058987",
	        	'latitude' => "46.6020711",
	        ],
	        [
	        	'name' => "Compton",
	        	'longitude' => "-118.2200712",
	        	'latitude' => "33.8958492",
	        ],
	        [
	        	'name' => "Bellflower",
	        	'longitude' => "-118.1170117",
	        	'latitude' => "33.8816818",
	        ],
	        [
	        	'name' => "Oceanside",
	        	'longitude' => "-117.3794834",
	        	'latitude' => "33.1958696",
	        ],
	        [
	        	'name' => "Pixley",
	        	'longitude' => "-119.2917785",
	        	'latitude' => "35.9685648",
	        ],
	        [
	        	'name' => "Tipton, CA, USA",
	        	'longitude' => "-119.3120577",
	        	'latitude' => "36.0593973",
	        ],
	        [
	        	'name' => "Kingsburg, CA, USA",
	        	'longitude' => "-119.5540175",
	        	'latitude' => "36.5138398",
	        ],
	        [
	        	'name' => "Parlier, CA, USA",	
	        	'longitude' => "-119.5270734",
	        	'latitude' => "36.6116174",
	        ],
	        [
	        	'name' => "Chowchilla, CA, USA",	
	        	'longitude' => "-120.2601754",
	        	'latitude' => "37.1229997",
	        ],
	        [
	        	'name' => "Livingston, CA, USA",
	        	'longitude' => "-120.7235329",
	        	'latitude' => "37.3868826",
	        ],
	        [
	        	'name' => "Woodland, CA, USA",	
	        	'longitude' => "-121.7732971",
	        	'latitude' => "38.67851570000001",
	        ],
	        [
	        	'name' => "Dunnigan, CA, USA",	
	        	'longitude' => "-121.9695801",
	        	'latitude' => "38.88523780000001",
	        ],
	        [
	        	'name' => "Williams",
	        	'longitude' => "-122.1494187",
	        	'latitude' => "39.1546137",
	        ],
	        [
	        	'name' => "Willows, CA, USA",	
	        	'longitude' => "-122.1935931",
	        	'latitude' => "39.5243265",
	        ],
	        [
	        	'name' => "Red Bluff, CA, USA",	
	        	'longitude' => "-122.2358302",
	        	'latitude' => "40.1784886",
	        ],
	        [
	        	'name' => "Anderson, CA, USA",	
	        	'longitude' => "-122.2977815",
	        	'latitude' => "40.448208",
	        ],
	        [
	        	'name' => "Mt Shasta",
	        	'longitude' => "-122.3105666",
	        	'latitude' => "41.3098746",
	        ],
	        [
	        	'name' => "Weed, CA, USA",	
	        	'longitude' => "-122.3861269",
	        	'latitude' => "41.42264979999999",
	        ],
	        [
	        	'name' => "Yreka, CA, USA",	
	        	'longitude' => "-122.6344708",
	        	'latitude' => "41.7354186",
	        ],
	        [
	        	'name' => "Ashland, OR, USA",	
	        	'longitude' => "-122.7094767",
	        	'latitude' => "42.1945758",
	        ],
	        [
	        	'name' => "Cottage Grove, OR, USA",	
	        	'longitude' => "-123.0595246",
	        	'latitude' => "43.797623",
	        ],
	        [
	        	'name' => "Eugene",
	        	'longitude' => "-123.0867536",
	        	'latitude' => "44.0520691",
	        ],
	        [
	        	'name' => "Wilsonville, OR, USA",	
	        	'longitude' => "-122.7726501",
	        	'latitude' => "45.3029903",
	        ],
	        [
	        	'name' => "Tualatin, OR, USA",	
	        	'longitude' => "-122.7821817",
	        	'latitude' => "45.3779988",
	        ],
	        [
	        	'name' => "Gresham, OR, USA",	
	        	'longitude' => "-122.4347608",
	        	'latitude' => "45.5098502",
	        ],
	        [
	        	'name' => "Biggs Junction, OR, USA",
	        	'longitude' => "-120.8328408",
	        	'latitude' => "45.669846",
	        ],
	        [
	        	'name' => "Goldendale, WA, USA",
	        	'longitude' => "-120.8217312",
	        	'latitude' => "45.8206794",
	        ],
	        [
	        	'name' => "Santa Clarita",	
	        	'longitude' => "-118.5627013",
	        	'latitude' => "34.419837",
	        ]
        ];
        
	    foreach ($cities as $key => $city) {
	    	City::create([
	    		'name' => $city['name'],
	    		'longitude' => $city['longitude'],
	    		'latitude' => $city['latitude'],
	    	]);
	    }
    }
}
