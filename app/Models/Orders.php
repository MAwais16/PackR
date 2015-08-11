<? namespace PackR\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Order extends Eloquent {
    
    protected $table = $table_prefix.'packr_orders';

    public $id;
    public $email;
    public $password;
    
    public $company_name;
    public $first_name;
    public $last_name;
    public $street;
    public $city;
    public $postal_code;
    public $country_code;
    
    public $account_number;
    public $iban;
    public $bic;

	public $voucher_code;

}
