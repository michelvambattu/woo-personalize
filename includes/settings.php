<?php
function personalize_recommendations_settings_init() {
    // Register a new setting for the plugin.
    register_setting('personalize_recommendations', 'personalize_recommendations_options');

    // Add a new settings section.
    add_settings_section(
        'personalize_recommendations_section',
        __('Personalize Settings', 'personalize_recommendations'),
        'personalize_recommendations_section_callback',
        'personalize_recommendations'
    );

    // Add Amazon Personalize fields.
    add_settings_field(
        'amazon_access_key',
        __('Amazon Access Key', 'personalize_recommendations'),
        'amazon_access_key_render',
        'personalize_recommendations',
        'personalize_recommendations_section'
    );

    add_settings_field(
        'amazon_secret_key',
        __('Amazon Secret Key', 'personalize_recommendations'),
        'amazon_secret_key_render',
        'personalize_recommendations',
        'personalize_recommendations_section'
    );

    // Add Azure Personalize fields.
    add_settings_field(
        'azure_subscription_key',
        __('Azure Subscription Key', 'personalize_recommendations'),
        'azure_subscription_key_render',
        'personalize_recommendations',
        'personalize_recommendations_section'
    );
}

add_action('admin_init', 'personalize_recommendations_settings_init');

function personalize_recommendations_section_callback() {
    echo __('Enter your Amazon and Azure credentials below:', 'personalize_recommendations');
}

function amazon_access_key_render() {
    $options = get_option('personalize_recommendations_options');
    ?>
    <input type='text' name='personalize_recommendations_options[amazon_access_key]' value='<?php echo $options['amazon_access_key']; ?>'>
    <?php
}

function amazon_secret_key_render() {
    $options = get_option('personalize_recommendations_options');
    ?>
    <input type='text' name='personalize_recommendations_options[amazon_secret_key]' value='<?php echo $options['amazon_secret_key']; ?>'>
    <?php
}

function azure_subscription_key_render() {
    $options = get_option('personalize_recommendations_options');
    ?>
    <input type='text' name='personalize_recommendations_options[azure_subscription_key]' value='<?php echo $options['azure_subscription_key']; ?>'>
    <?php
}

function personalize_recommendations_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h2>Personalize Recommendations</h2>
        <?php
        settings_fields('personalize_recommendations');
        do_settings_sections('personalize_recommendations');
        submit_button();
        ?>
    </form>
    <?php
}

function personalize_recommendations_menu() {
    add_options_page(
        'Personalize Recommendations',
        'Personalize Recommendations',
        'manage_options',
        'personalize_recommendations',
        'personalize_recommendations_options_page'
    );
}

add_action('admin_menu', 'personalize_recommendations_menu');
?>
