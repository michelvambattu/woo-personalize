<?php
function get_azure_personalize_recommendations($user_id) {
    $options = get_option('personalize_recommendations_options');
    $url = 'https://YOUR_RESOURCE_NAME.cognitiveservices.azure.com/personalizer/v1.0/rank';

    $data = [
        'contextFeatures' => [],
        'actions' => [],
        'excludedActions' => [],
        'eventId' => uniqid(),
        'timestamp' => date('Y-m-d\TH:i:s\Z'),
    ];

    $headers = [
        'Content-Type: application/json',
        'Ocp-Apim-Subscription-Key: ' . $options['azure_subscription_key'],
    ];

    $response = wp_remote_post($url, [
        'body' => json_encode($data),
        'headers' => $headers,
    ]);

    if (is_wp_error($response)) {
        return [];
    }

    $body = wp_remote_retrieve_body($response);
    $result = json_decode($body, true);

    return $result['ranking'];
}
?>
