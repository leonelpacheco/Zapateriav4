<? /*
    <form name='formTpv' method='post' action='https://www.sandbox.paypal.com/cgi-bin/webscr'>
     */?>
        <form name='formTpv' method='post' action=' https://www.paypal.com/cgi-bin/webscr'>
        <input type='hidden' name='cmd' value='_xclick'>
        <input type='hidden' name='business' value='examplesjquery@examplesjquery.com'>
       <? /*
        <input type='hidden' name='item_name' value='Nueva compra en mi web'>
        */?>
        <input type='hidden' name='item_name' value='COMPRA EN EXAMPLESJQUERY.COM'>
        <input type='hidden' name='item_number' value='Productos Web'>
        <input type='hidden' name='amount' value='<? echo  number_format($totalcarro,2)?>'>
        <input type='hidden' name='page_style' value='primary'>
    <input type='hidden' name='no_shipping' value='1'>
        <input type='hidden' name='return' value='http://examplesjquery.com/gracias.php'>
        <input type='hidden' name='rm' value='2'>
    <input type='hidden' name='cancel_return' value='http://examplesjquery.com/cancel.php'>
        <input type='hidden' name='no_note' value='1'>
        <input type='hidden' name='currency_code' value='EUR'>
        <input type='hidden' name='cn' value='PP-BuyNowBF'>
        <input type='hidden' name='custom' value=''>
        <input type='hidden' name='first_name' value='<? echo $_POST['nombre']?>'>
        <input type='hidden' name='last_name' value='<? echo $_POST['apellidos']?>'>
        <input type='hidden' name='address1' value='<? echo $_POST['direccion']?>'>
        <input type='hidden' name='city' value='<? echo $_POST['ciudad']?>'>
        <input type='hidden' name='zip' value='<? echo $_POST['ciudad']?>'>
        <input type='hidden' name='night_phone_a' value=''>
        <input type='hidden' name='night_phone_b' value='<? echo $_POST['telefono']?>'>
        <input type='hidden' name='night_phone_c' value=''>
        <input type='hidden' name='lc' value='es'>
        <input type='hidden' name='country' value='ES'>
        <input type='submit' name='pagar_ahora' value="pagarahora">
    </form>