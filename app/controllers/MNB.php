<?php
    class Mnb extends Controller
    {
        /* Private variables */
        private $client;

        /* Constructor */
        public function __construct()
        {
            
        }

        /* Index function for opening the site */
        public function index()
        {
            $data = ['curr1' => '',
                        'curr2' => '',
                        'unit1' => '',
                        'unit2' => '',
                        'rate1' => '',
                        'rate2' => '',
                        'curr1Error' => '',
                        'curr2Error' => '',
                        'rate1Error' => '',
                        'rate2Error' => ''];
            $this->view('mnb', $data);
        }

        /* Get exchange rates between two currencies */
        public function GetExchangeRates()
        {
            $data = ['curr1' => '',
                        'curr2' => '',
                        'unit1' => '',
                        'unit2' => '',
                        'rate1' => '',
                        'rate2' => '',
                        'curr1Error' => '',
                        'curr2Error' => '',
                        'rate1Error' => '',
                        'rate2Error' => ''];

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = ['curr1' => trim($_POST['curr1']),
                            'curr2' => trim($_POST['curr2']),
                            'unit1' => '',
                            'unit2' => '',
                            'rate1' => '',
                            'rate2' => '',
                            'curr1Error' => '',
                            'curr2Error' => '',
                            'rate1Error' => '',
                            'rate2Error' => ''];

                /* Validating inputs */
                $currencieValidation = "/^[A-Z]*$/";

                if(empty($data['curr1']))
                {
                    $data['curr1Error'] = 'K??rem adja meg, hogy mely valut??r??l szeretne ??tv??ltani.';
                }
                elseif(!preg_match($currencieValidation, $data['curr1']) || strlen($data['curr1']) != 3)
                {
                    $data['curr1Error'] = 'Hib??san megadott valut?? azonos??t??! K??rem pr??b??lja meg ??jra! (pl.: HUF, EUR)';
                }
                elseif(!$this->ValidateCurrencies($data['curr1']))
                {
                    $data['curr1Error'] = 'A megadott ??tv??ltand?? valuta nem tal??lhat?? adatb??zisunkban!';
                }

                if(empty($data['curr2']))
                {
                    $data['curr2Error'] = 'K??rem adja meg, hogy mely valut??ra szeretne ??tv??ltani.';
                }
                elseif(!preg_match($currencieValidation, $data['curr2']) || strlen($data['curr2']) != 3)
                {
                    $data['curr2Error'] = 'Hib??san megadott valut?? azonos??t??! K??rem pr??b??lja meg ??jra! (pl.: HUF, EUR)';
                }
                elseif(!$this->ValidateCurrencies($data['curr2']))
                {
                    $data['curr2Error'] = 'A megadott valuta, melyre ??t szeretne v??ltani, nem tal??lhat?? adatb??zisunkban!';
                }

                /* If everything is ok we search for the exchange rates */
                if(empty($data['curr1Error']) && empty($data['curr2Error']))
                {
                    try
                    {
                        $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
                        $result = simplexml_load_string($client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult);

                        $count = $result->Day[0]->count();

                        for($i = 0; $i <= $count - 1; $i++)
                        {
                            $j = 0;

                            foreach($result->Day[0]->Rate[$i]->attributes() as $a => $b)
                            {
                                $curexc_array[$i][$j] = $b->__toString();
                                $j = $j + 1;

                                if($j == 2)
                                {
                                    $j = 0;
                                }
                            }
                            $curexc_array[$i][2] = $result->Day[0]->Rate[$i]->__toString();
                        }
                    }
                    catch (SoapFault $e)
                    {
                        var_dump($e);
                    }

                    $rate1 = 0;
                    $rate2 = 0;

                    for($i = 0; $i <= $count - 1; $i++)
                    {
                        if($data['curr1'] == "HUF")
                        {
                            $unit1 = 1;
                            $rate1 = 1;
                        }
                        else
                        {
                            if($curexc_array[$i][1] == $data['curr1'])
                            {
                                $unit1 = $curexc_array[$i][0];
                                $rate1 = $curexc_array[$i][2];
                            }
                        }
                        
                        if($data['curr2'] == "HUF")
                        {
                            $unit2 = 1;
                            $rate2 = 1;
                        }
                        else
                        {
                            if($curexc_array[$i][1] == $data['curr2'])
                            {
                                $unit2 = $curexc_array[$i][0];
                                $rate2 = $curexc_array[$i][2];
                            }
                        }
                    }

                    if($rate1 == 0)
                    {
                        $data['rate1Error'] = 'Az ??tv??ltand?? valut??r??l nincs a mai napon ??rfolyam inform??ci??.';
                    }
                    if($rate2 == 0)
                    {
                        $data['rate2Error'] = 'A valut??r??l, melyre ??t szeretne v??ltani, nincs a mai napon ??rfolyam inform??ci??.';
                    }

                    /* If we got both exchange rates we calculate the exchange rate between the two currencies */
                    if(empty($data['rate1Error']) && empty($data['rate2Error']))
                    {
                        $f_unit1 = floatval($unit1);
                        $f_unit2 = floatval($unit2);
                        $f_rate1 = floatval($rate1);
                        $f_rate2 = floatval($rate2);

                        if($data['curr1'] == "HUF")
                        {
                            $data['unit1'] = $unit2;
                            $data['rate1'] = $rate2;
                            $data['unit2'] = $unit1;
                            $data['rate2'] = $f_unit2 / $f_rate2;
                        }
                        elseif($data['curr2'] == "HUF")
                        {
                            $data['unit1'] = $unit2;
                            $data['rate1'] = $f_unit1 / $f_rate1;
                            $data['unit2'] = $unit1;
                            $data['rate2'] = $rate1; 
                        }
                        else
                        {
                            $data['unit1'] = $unit1;
                            $data['rate1'] = ($f_unit1 / $f_rate1 * $f_unit1) * ($f_rate2 / $f_unit2);
                            $data['unit2'] = $unit2;
                            $data['rate2'] = ($f_unit2 / $f_rate2 * $f_unit2) * ($f_rate1 / $f_unit1);
                        }
                    }
                }
            }
            else
            {
                $data = ['curr1' => '',
                            'curr2' => '',
                            'unit1' => '',
                            'unit2' => '',
                            'rate1' => '',
                            'rate2' => '',
                            'curr1Error' => '',
                            'curr2Error' => '',
                            'rate1Error' => '',
                            'rate2Error' => ''];
            }

            $this->view('mnb', $data);
        }

        /* Function to validate input currencie */
        public function ValidateCurrencies($curr)
        {
            try
            {
                $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
                $result = json_decode(json_encode((array) simplexml_load_string($client->GetCurrencies()->GetCurrenciesResult)), 1);
                $cur_array = $result['Currencies'];
                $array = $cur_array['Curr'];
            }
            catch (SoapFault $e)
            {
                var_dump($e);
            }

            if(in_array($curr, $array))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>