<?php

namespace App\Console\Commands;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;
define("SERVER", "https://app.droidsend.com");
define("API_KEY", "5e22f5534a2f552f6f6a38f77a2d7b8967433b01");

define("USE_SPECIFIED", 0);
define("USE_ALL_DEVICES", 1);
define("USE_ALL_SIMS", 2);

class SMSGateWayNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sms {number?} {msg?} {sale?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send sms through sms gateway droidsms';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $number = $this->argument('number');
        $msg = $this->argument('msg');
       $this->sendSingleMessage("+258$number","$msg");
    }

      /**
 * @param string     $number      The mobile number where you want to send message.
 * @param string     $message     The message you want to send.
 * @param int|string $device      The ID of a device you want to use to send this message.
 * @param int        $schedule    Set it to timestamp when you want to send this message.
 * @param bool       $isMMS       Set it to true if you want to send MMS message instead of SMS.
 * @param string     $attachments Comma separated list of image links you want to attach to the message. Only works for MMS messages.
 * @param bool       $prioritize  Set it to true if you want to prioritize this message.
 *
 * @return array     Returns The array containing information about the message.
 * @throws Exception If there is an error while sending a message.
 */
function sendSingleMessage($number, $message, $device = 36, $schedule = null, $isMMS = false, $attachments = null, $prioritize = false)
{
    $url = SERVER . "/services/send.php";
    $postData = array(
        'number' => $number,
        'message' => $message,
        'schedule' => $schedule,
        'key' => API_KEY,
        'devices' => $device,
        'type' => $isMMS ? "mms" : "sms",
        'attachments' => $attachments,
        'prioritize' => $prioritize ? 1 : 0
    );
    return $this->sendRequest($url, $postData)["messages"][0];
}

function sendRequest($url, $postData)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    $response = curl_exec($ch);
    $sale = $this->argument('sale');
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }
    curl_close($ch);
    if ($httpCode == 200)  {
        $json = json_decode($response, true);


        // Transaction::create(['title'=>'Pedido', 'reference'=>Carbon::now(), 'amount'=>0, 'payment_method_id'=>1, 'type'=>1, 'client_id'=>$sale['client']['id'], 'user_id'=>$sale['user_id'], 'sale_id'=>$sale['id'],'type'=>'entrada']);


        if ($json == false) {
            if (empty($response)) {
                throw new Exception("Missing data in request. Please provide all the required information to send messages.");
            } else {
                throw new Exception($response);
            }
        } else {
            if ($json["success"]) {
                return $json["data"];
            } else {
                throw new Exception($json["error"]["message"]);
            }
        }
    } else {
        throw new Exception("HTTP Error Code : {$httpCode}");
    }
}
}
