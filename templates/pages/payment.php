<?php

    // ob_start();
        
    session_start();
    
    use App\Http\Controllers\PrzelewyController;
    
    $oPrzelewy24_API = new PrzelewyController();

        $email = "bohun19081997@gmail.com";
    
            // Powrotny adres URL
    $p24_url_return = 'https://www.projekt-kultura.pl/przelew/';
    
            // Adres dla weryfikacji płatności
    $p24_url_status = 'https://www.projekt-kultura.pl/';

    $oPrzelewy24_API->Verify($_POST);
    
    if(isset($_GET['submit'])){
            // Kwota do zapłaty musi być pomnożona razy 100.
            // Czyli, jeżeli użytkownik ma zapłacić 499 złotych, to kwota do zapłaty
            // to 499 * 100 (wyrażona w groszach)
        $redirect = $oPrzelewy24_API->Pay($_GET['p24_amount'], "Zamówienie: ".$_GET['p24_order_id'], $email, $p24_url_return, $p24_url_status);
        session(['test' => $oPrzelewy24_API->Verify($_POST)]);
        Header('Location: ' . $redirect); exit;
    }
    
    // Sandobx
    //$crc = md5('142447|88e721d6ecc60f40');            //TestConnection
    //$crc = md5('117|142447|200|PLN|88e721d6ecc60f40');  //Register
    
    
    // Secure
    //$crc = md5('142447|b8c85c93016e490e');                //TestConntection
    $crc = md5('112|142447|200|PLN|b8c85c93016e490e');    //Register
    
    var_dump($_GET);
    var_dump(session('przelew'));
?>


<form action="/przelew?submit=true" method="get">
    @csrf
    <input type="hidden" name="p24_merchant_id" value="142447" />
    <input type="hidden" name="p24_pos_id" value="142447" />
    <input type="hidden" name="p24_session_id" value="<?php echo rand(0, 1000) ?>" />
    <input type="text" name="p24_amount" value="120" />
    <input type="text" name="p24_order_id" value="<?php echo rand(0, 1000) ?>" />
    <input type="submit" name="submit" value="submit">
</form>


<!--

     https://secure.przelewy24.pl/testConnection
     https://sandbox.przelewy24.pl/testConnection
     https://sandbox.przelewy24.pl/trnRegister
     https://sandbox.przelewy24.pl/trnDirect

-->

<!--

<form action="https://sandbox.przelewy24.pl/trnDirect" method="POST" class="form">
    @csrf
    <input type="hidden" name="p24_merchant_id" value="142447" />
    <input type="hidden" name="p24_pos_id" value="142447" />
    <input type="hidden" name="p24_sign" value="{{$crc}}" />
    <input type="hidden" name="p24_session_id" value="117" />
    <input type="text" name="p24_amount" value="200" />
    <input type="hidden" name="p24_currency" value="PLN" />
    <input type="text" name="p24_description" value="TEST" />
    <input type="hidden" name="p24_email" value="bohun19081997@gmail.com" />
    <input type="hidden" name="p24_country" value="pl" />
    <input type="hidden" name="p24_url_return" value="http://127.0.0.1:8000/przelew" />
    <input type="hidden" name="p24_url_result" value="http://127.0.0.1:8000/" />
    <input type="hidden" name="p24_api_version" value="3.2" />
    <input type="hidden" name="p24_name_0" value="Komoda Daxi" />
    <input type="hidden" name="p24_quantity_0" value="1" />
    <input type="hidden" name="p24_price_0" value="100" />
    <input name="submit" type="submit" />
</form>


<form action="https://sandbox.przelewy24.pl/testConnection" method="POST" class="form">
    @csrf
    <input type="hidden" name="p24_merchant_id" value="142447" />
    <input type="hidden" name="p24_pos_id" value="142447" />
    <input type="hidden" name="p24_sign" value="{{$crc}}" />
    <input type="hidden" name="p24_session_id" value="116" />
    <input type="text" name="p24_amount" value="200" />
    <input type="text" name="p24_currency" value="PLN" />
    <input type="text" name="p24_order_id" value="116" />
    <input name="submit" type="submit" />
</form>

-->