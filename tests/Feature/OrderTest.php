<?php

namespace Tests\Feature;

use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Feature test to make sure that export order list page shown successfully.
     *
     * @return void
     */
    public function test_user_can_view_export_order_list()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_process_order_export()
    {
        $response = $this->get('/export');

        $response->assertStatus(200);
    }
}
