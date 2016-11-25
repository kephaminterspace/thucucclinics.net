<?php
if($_GET['email'] && $_GET['name']) {
    $t = time();
    $arr = array(
        'properties' => array(
            array(
                'property' => 'tc_email',
                'value' => $_GET['email']
            ),
            array(
                'property' => 'firstname',
                'value' => $_GET['name']
            ),
            array(
                'property' => 'lastname',
                'value' => ''
            ),
            array(
                'property' => 'phone',
                'value' => $_GET['phone']
            ),
            array(
                'property' => 'dichvu',
                'value' => $_GET['dichvu']
            ), array(
                'property' => 'aff_source',
                'value' => $_GET['aff_source']
            ),
            array(
                'property' => 'aff_sid',
                'value' => $_GET['aff_sid']
            ),
            array(
                'property' => 'identifier',
                'value' => $t . '_' . $_GET['email']
            ),
            array(
                'property' => 'hs_lead_status',
                'value' => "NEW"
            )
        )
    );

    $post_json = json_encode($arr);
    $endpoint = "https://api.hubapi.com/contacts/v1/contact/?hapikey=773a6f77-c531-4211-9031-2143ac5a88c5";
    $ch = @curl_init();
    @curl_setopt($ch, CURLOPT_POST, true);
    @curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
    @curl_setopt($ch, CURLOPT_URL, $endpoint);
    @curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = @curl_exec($ch);
    $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_errors = curl_error($ch);
    @curl_close($ch);

    if ($status_code == 200) {
        $msg = 'success';
    } else {
        $msg = 'error';
    }
    echo $msg;
}
