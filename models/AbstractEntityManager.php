<?php

/**
 * Classe abstraite qui représente un manager. Elle récupère automatiquement le gestionnaire de base de données.
 * Elle utilise le pattern Singleton de DBManager pour récupérer une instance unique de connexion
 * partagée entre tous les managers qui hérite de cette classe
 */
abstract class AbstractEntityManager {
    
    protected $db;

    /**
     * Constructeur de la classe.
     * Il récupère automatiquement l'instance de DBManager. 
     */
    public function __construct() 
    {
        $this->db = DBManager::getInstance();
    }
}