<?php
require 'vendor/autoload.php';

use Aws\PersonalizeRuntime\PersonalizeRuntimeClient;

function get_amazon_personalize_recommendations($user_id) {
    $options = get_option('personalize_recommendations_options');
    $client = new PersonalizeRuntimeClient([
        'region' => 'us-east-1',
        'version' => 'latest',
        'credentials' => [
            'key' => $options['amazon_access_key'],
            'secret' => $options['amazon_secret_key'],
        ],
    ]);

    $result = $client->getRecommendations([
        'campaignArn' => 'YOUR_CAMPAIGN_ARN',
        'userId' => (string) $user_id,
    ]);

    return $result['itemList'];
}
?>
