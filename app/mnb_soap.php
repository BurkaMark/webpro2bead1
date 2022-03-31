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

                for($i = 0; $i <= $count - 1; $i = $i + 1)
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
            
        }
    }
?>