<?php
    namespace App\Models;

    class Listing {
        public static function all() {
            return [
                [
                    'id' => 1,
                    'title' => 'Listing One',
                    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam 
                    minima et illo reprehenderit quas possimus voluptas repudiandae 
                    cum expedita, eveniet aliquid, quam illum quarat consequatur! 
                    Expedita ab consecetur tenetur delensiti'
                ],
                [
                    'id' => 2,
                    'title' => 'Listing Two',
                    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam 
                    minima et illo reprehenderit quas possimus voluptas repudiandae 
                    cum expedita, eveniet aliquid, quam illum quarat consequatur! 
                    Expedita ab consecetur tenetur delensiti'
                ]
                ];
        }

        public static function find($id) {
            $listings = self::all();

            foreach($listings as $listing) {
                if($listing['id'] == $id) {
                    return $listing;
                }
            }
        }
    }