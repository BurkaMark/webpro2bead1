<?php
    class MNBSoap
    {
        private $client;
        private $doc;

        public function __construct()
        {

        }

        public function ValidateCurrencies($curr)
        {
            $client = new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL");
            $result = json_decode(json_encode((array) simplexml_load_string($client->GetCurrencies()->GetCurrenciesResult)), 1);
            $cur_array = $result['Currencies'];
            $array = $cur_array['Curr'];

            if(in_array($curr, $array))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function GetExchange($curr1, $curr2)
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

            for($i = 0; $i <= $count - 1; $i++)
            {
                if($curr1 == "HUF")
                {
                    $unit1 = 1;
                    $rate1 = 1;
                }
                else
                {
                    if($curexc_array[$i][1] == $curr1)
                    {
                        $unit1 = $curexc_array[$i][0];
                        $rate1 = $curexc_array[$i][2];
                    }
                }
                
                if($curr2 == "HUF")
                {
                    $unit2 = 1;
                    $rate2 = 1;
                }
                else
                {
                    if($curexc_array[$i][1] == $curr2)
                    {
                        $unit2 = $curexc_array[$i][0];
                        $rate2 = $curexc_array[$i][2];
                    }
                }
            }

            if($rate1 == "")
            {
                return $curr1;
            }
            if($rate2 == "")
            {
                return $curr2;
            }

            $f_unit1 = floatval($unit1);
            $f_unit2 = floatval($unit2);
            $f_rate1 = floatval($rate1);
            $f_rate2 = floatval($rate2);

            if($curr1 == "HUF")
            {
                $rates = array($unit2, $rate2, $unit2, $f_unit2 / $f_rate2);
            }
            elseif($curr2 == "HUF")
            {
                $rates = array($unit1, $f_unit1 / $f_rate1, $unit1, $rate1);
            }
            else
            {
                $rates = array(1, ($f_unit1 / $f_rate1) * ($f_rate2 / $f_unit2), 1, ($f_unit2 / $f_rate2) * ($f_rate1 / $f_unit1)); 
            }

            return $rates;
        }
    }
?>