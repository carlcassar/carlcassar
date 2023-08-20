<?php

test('the privacy policy is accessible', function () {
    $response = $this->get('privacy-policy');

    $response->assertStatus(200);
});
