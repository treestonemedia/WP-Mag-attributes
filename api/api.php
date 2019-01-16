/**
 * Created by PhpStorm.
 * User: info
 * Date: 1/28/2018
 * Time: 8:50 PM.
 */
defined('ABSPATH') or die('Cannot access pages directly.'); //protect from direct access
class magento

    public $sessionId;

 public function connect()
{
        $mg_host = get_option('mg_url'); //get the magento shop URL as set in settings
        $mg_usr = get_option('mg_api_user'); //get the magento api user as set in settings
        $mg_scrt = get_option('mg_scrt'); //get the magento api secret as set in settings

 $proxy = new SoapClient( $mg_host.'/api/v2_soap/?wsdl' ); //initiate request to magento

        $this->sessionId = $proxy->login($mg_usr, $mg_scrt); //login to magento with API credentials

        return $proxy;
    }

    public function getAttributeOptions($id)
    {
        $attribute_id = $id; //get the attribute id passed by the shortcode
        $mg = $this->connect();

        $result = $mg->catalogProductAttributeOptions($this->sessionId, $attribute_id); //get the attributes options

        return $result;
    }

    //start order section
    //https://www.fontis.com.au/blog/web-services-api-filter-operators

    public function getOrdersList()
    {
        $params = [
            'complex_filter' => [
                    [
                        'key'   => 'created_at',
                        'value' => ['key' => 'from', 'value' => '2018-01-01 01:01:01'],
                    ],
                    ['key' => 'status ', 'value' => 'Processing'],

                ],

        ];
        $mg = $this->connect();
        $result = $mg->salesOrderList($this->sessionId, $params);

        return $result;
    }

    public function getStoreInfo()
    {
        $mg = $this->connect();
        $result = $mg->magentoInfo($this->sessionId);

        //var_dump($result);
        return $result;
    }
}
