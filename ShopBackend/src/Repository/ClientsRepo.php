<?php

define("CLIENTSFILE", dirname(__DIR__).'/../ressources/clients.json');


class ClientsRepo implements IClientsRepo
{
    public function getRepo()
    {
        return $this->getClientFile();
    }

    public function addClient($client)
    {
        $this->addClientToFile($client);
    }

    public function getClientInfoByLogin($login)
    {
        //echo json_encode($this->getRepo());
        $array = $this->getRepo();
        //echo json_encode($array[0]['nom']);
        $res;
        for ($i = 0; $i < sizeof($array); $i++) 
        {
            for ($y = 0; $y < sizeof($array[$i]); $y++) 
            {
                if($array[$i][$y]['login'] == $login)
                {
                    $res = $array[$i][$y];
                }
            }
        }


        return $res;
    }

    private function getClientFile()
    {
        $string = file_get_contents(CLIENTSFILE);
        $json_a = json_decode($string, true);
        $listClients = array();


        foreach ($json_a as $person => $person_a) {
            $listClients[] = $person_a;
        }

        return $listClients;
    }

    private function addClientToFile($client)
    {
        $data[] = $client;
        $inp = file_get_contents(CLIENTSFILE);
        $tempArray = json_decode($inp);
        array_push($tempArray, $data);
        $jsonData = json_encode($tempArray);
        file_put_contents(CLIENTSFILE, $jsonData);
    }
}