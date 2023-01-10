<!-- this file is the configuration file  to load the env credentials  -->
<?php
// fetch the autoload file 

require_once __DIR__ . '/vendor/autoload.php';
// name spaces to be used 
use Dotenv\Dotenv;
use Square\SquareClient;
use Square\Environment;
use Ramsey\Uuid\Uuid;

if(!$element->page_editable){
// dotenv is used to read from the '.env' file created for credentials
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


// The access token to use in all Connect API requests.
// Set your environment as *sandbox* if you're just testing things out.
//load the locations data 
class LocationInfo
{
    // Initialize the Square client.
    var $currency;
    var $country;
    var $location_id;
    var $square_client;

    function __construct()
    {
        $access_token = $_ENV['SQUARE_ACCESS_TOKEN'];

        $this->square_client = new SquareClient([
            'accessToken' => $access_token,
            'environment' => $_ENV['ENVIRONMENT']
        ]);

        $location = $this->square_client->getLocationsApi()->retrieveLocation($_ENV['SQUARE_LOCATION_ID'])->getResult()->getLocation();
        $this->location_id = $location->getId();
        $this->currency = $location->getCurrency();
        $this->country = $location->getCountry();
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getId()
    {
        return $this->location_id;
    }
}

$location_info = new LocationInfo();


// Pulled from the .env file and upper cased e.g. SANDBOX, PRODUCTION.
$upper_case_environment = strtoupper($_ENV['ENVIRONMENT']);
?>
<!-- lets put the place holders  to hold the env values  -->
<input type="hidden" readonly name="web_payment_sdk_url" id="web_payment_sdk_url" value="<?php echo $_ENV["ENVIRONMENT"] === Environment::PRODUCTION ? "https://web.squarecdn.com/v1/square.js" : "https://sandbox.web.squarecdn.com/v1/square.js"; ?>">
<input type="hidden" readonly name="applicationId" id="applicationId" value="<?php echo $_ENV['SQUARE_APPLICATION_ID']; ?>">
<input type="hidden" readonly name="locationId" id="locationId" value="<?php echo $_ENV['SQUARE_LOCATION_ID']; ?>">
<input type="hidden" readonly name="currency" id="currency" value="<?php echo $location_info->getCurrency(); ?>">
<input type="hidden" readonly name="country" id="country" value="<?php echo $location_info->getCountry(); ?>">
<input type="hidden" readonly name="idempotencyKey" id="idempotencyKey" value="<?php echo Uuid::uuid4(); ?>">
<input type="hidden" readonly name="account_id" id="account_id" value="<?php echo isset($_SESSION['email'])? $_SESSION['email']: "uknown"; ?>">

<?php
} else{
// this file used to update square credentials  
include 'settings.php';
}

?>
