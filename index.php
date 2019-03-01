<?php
session_start();
include 'controlor/controlor.php';
if (isset($_GET['r'])) 
{
	switch ($_GET['r']) 
    {
		case 'index':
			index();
            break;
        case 'home':
			home();
			break;
        case 'pret':
			pret();
			break;
        case 'rembourser_pret':
			rembourser_pret();
			break;
        case 'inscription':
			inscription();
			break;
        case 'modifier_profil':
			modifier_profil();
			break;
        case 'transactions':
			transactions();
			break;
        case 'mytransactions':
			mytransactions();
			break;
        case 'mycredits':
			mycredits();
			break;
        case 'deconnexion':
			deconnexion();
			break;
		default:
			index();
        break;
	}
} 
else 
{
	index();
}