<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use Reepay\Api\SubscriptionApi;
use Reepay\Api\CustomerApi;
use Reepay\Api\InvoiceApi;
use Reepay\Model\ChangeSubscription;
class Billy{	
	private $apiToken;
    public function __construct($apiToken) {
        $this->apiToken = $apiToken;
    }
    public function request($method, $url, $body = null) {
        try {
            $c = curl_init("https://api.billysbilling.com/v2" . $url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_CUSTOMREQUEST, $method);

            // Set headers
            curl_setopt($c, CURLOPT_HTTPHEADER, array(
                "X-Access-Token: " . $this->apiToken,
                "Content-Type: application/json"
            ));

            if ($body) {
                // Set body
                curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
            }

            // Execute request
            $res = curl_exec($c);
            $status = curl_getinfo($c, CURLINFO_HTTP_CODE);
            $body = json_decode($res);

            if ($status >= 400) {
                throw new Exception("$method: $url failed with $status - $res");
            }

            return $body;
        } catch (Exception $e) {
            print_r($e);
            throw $e;
        }
    }

    // Creates a contact. The server replies with a list of contacts and we
	// return the id of the first contact of the list
	function createContact($organizationId,$clientData) {
	    $contact = array(
	        'organizationId' => $organizationId,
	        'name' => "Ninjas",
	        'countryId' => "DK"
	    );
	    $res = $this->request("POST", "/contacts", array('contact' => $contact));
	    return $res->contacts[0]->id;
	}

	// Creates a product. The server replies with a list of products and we
	// return the id of the first product of the list
	function createProduct($organizationId) {
	    $product = array(
	        'organizationId' => $organizationId,
	        'name' => 'Pens',
	        'prices' => [array(
	            'unitPrice' => 200,
	            'currencyId' => 'DKK'
	        )]
	    );
	    $res = $this->request("POST", "/products", array('product' => $product));
	    return $res->products[0]->id;
	}

	// Creates an invoice, the server replies with a list of invoices and we
	// return the id of the first invoice of the list
	function createInvoice( $organizationId, $contactId, $productId) {
	    $invoice = array(
	        'organizationId' => $organizationId,
	        'invoiceNo' => 991,
	        'entryDate' => '2013-11-14',
	        'contactId' => $contactId,
	        'lines' => [array(
	            'productId' => $productId,
	            'unitPrice' => 200
	        )]
	    );
	    $res = $this->request("POST", "/invoices", array('invoice' => $invoice));
	    return $res->invoices[0]->id;
	}

	// Gets the id of the organization associated with the API token.
	function getOrganizationId() {
	    $res = $this->request("GET", "/organization");
	    return $res->organization->id;
	}

	function getInvoice($invoiceId) {
    	$res = $this->request("GET", "/invoices", $invoiceId);
	    return $res->invoices[0];
	}
}