<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rs\JsonLines\JsonLines;

class Order extends Model
{
    public function get()
    {
        $jsonString = (new JsonLines())->delineFromFile(config('global.order.export_source_file'));
        $data = json_decode($jsonString, true);
        return $data;
    }

    // public function save()
    // {
        // $data = json_encode(array(
        //     'orderID' => $this->id,
        //     'name' => $this->name,
        // ))

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $this->url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        // curl_setopt($ch, CURLOPT_PUT, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    //     return true;
    // }
}
