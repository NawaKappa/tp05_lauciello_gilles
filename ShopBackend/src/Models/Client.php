<?php

class Client
{
    public function __construct($data) 
    {
        $this->nom = $data['nom'] ?? false;
        $this->prenom = $data['prenom'] ?? false;
        $this->sexe = $data['sexe'] ?? false;;
        $this->adresse = $data['adresse'] ?? false;
        $this->ville = $data['ville'] ?? false;
        $this->codepostal = $data['codepostal'] ?? false;
        $this->email = $data['email'] ?? false;
        $this->login = $data['login'] ?? false;
        $this->telephone = $data['telephone'] ?? false;
        $this->password = $data['password'] ?? false;
    }
}