<!-- this file is the configuration file  to load the env credentials  -->
<?php
require_once __DIR__ . '/vendor/autoload.php';
include  __DIR__ . '/utils/location-info.php';

use Square\Environment;
use Dotenv\Dotenv;
use Ramsey\Uuid\Uuid;
// dotenv is used to read from the '.env' file created for credentials
$dotenv = Dotenv::createImmutable((__DIR__));
$dotenv->load();

// Pulled from the .env file and upper cased e.g. SANDBOX, PRODUCTION.
$upper_case_environment = strtoupper($_ENV['ENVIRONMENT']);
$web_payment_sdk_url = $_ENV["ENVIRONMENT"] === Environment::PRODUCTION ? "https://web.squarecdn.com/v1/square.js" : "https://sandbox.web.squarecdn.com/v1/square.js";


?>
<html>

<head>
    <title>My Payment Flow</title>
    <!-- link to the Square web payment SDK library -->
    <script type="text/javascript" src="<?php echo $web_payment_sdk_url ?>"></script>
    <script type="text/javascript">
        window.applicationId =
            "<?php
                echo $_ENV['SQUARE_APPLICATION_ID'];
                ?>";
        window.locationId =
            "<?php
                echo $_ENV['SQUARE_LOCATION_ID'];
                ?>";
        window.currency =
            "<?php
                echo $location_info->getCurrency();
                ?>";
        window.country =
            "<?php
                echo $location_info->getCountry();
                ?>";
        window.idempotencyKey =
            "<?php
                echo Uuid::uuid4();
                ?>";
    </script>