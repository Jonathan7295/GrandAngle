<?php
// src/ModuleGestionBundle/DataFixtures/ORM/LoadOeuvreData.php

namespace ModuleGestionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ModuleGestionBundle\Entity\Oeuvre;
use ModuleGestionBundle\Entity\Artiste;

class LoadOeuvreData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
    	// Je créé d'abord toutes mes oeuvres
        $oeuvre = new Oeuvre();
        $oeuvre1 = new Oeuvre();
        $oeuvre2 = new Oeuvre();
        $oeuvre3 = new Oeuvre();

        $oeuvre->setNom('Garçon à la pipe');
        $oeuvre->setEtat('Pas livré');
        $oeuvre->setNombreVisite('120');

        $oeuvre1->setNom('La joconde - Portrait de Mona Lisa');
        $oeuvre1->setEtat('En cours');
        $oeuvre1->setNombreVisite('174');

        $oeuvre2->setNom('L\'astronome');
        $oeuvre2->setEtat('Pas livré');
        $oeuvre2->setNombreVisite('180');

        $oeuvre3->setNom('White Center');
        $oeuvre3->setEtat('Livré');
        $oeuvre3->setNombreVisite('150');

        // Puis je créé les artistes correspondant
        $artiste = new Artiste();
        $artiste1 = new Artiste();
        $artiste2 = new Artiste();
        $artiste3 = new Artiste();

        $artiste->setNom('Picasso');
        $artiste->setPrenom('Pablo');
        $artiste->setNationalite('Espagnol');
        $artiste->setDateNaissance('1881-10-25');
        $artiste->setDateMort('1973-04-08');
        // J'ajoute à l'artiste son oeuvre
        $artiste->addOeuvre($oeuvre);

        $artiste1->setNom('De Vinci');
        $artiste1->setPrenom('Léonard');
        $artiste1->setNationalite('Italien');
        $artiste1->setDateNaissance('1452-04-15');
        $artiste1->setDateMort('1519-05-02');
        // J'ajoute à l'artiste son oeuvre
        $artiste1->addOeuvre($oeuvre1);

        $artiste2->setNom('Vermeer');
        $artiste2->setPrenom('Johannes');
        $artiste2->setNationalite('Néerlandais');
        $artiste2->setDateNaissance('1632-10-31');
        $artiste2->setDateMort('1675-12-15');
        // J'ajoute à l'artiste son oeuvre
        $artiste2->addOeuvre($oeuvre2);

        $artiste3->setNom('Rothko');
        $artiste3->setPrenom('Mark');
        $artiste3->setNationalite('Américain');
        $artiste3->setDateNaissance('1903-09-25');
        $artiste3->setDateMort('1970-02-25');
        // J'ajoute à l'artiste son oeuvre
        $artiste3->addOeuvre($oeuvre3);

		// Je persiste les oeuvres puis les artistes
        $manager->persist($oeuvre);
        $manager->persist($oeuvre1);
        $manager->persist($oeuvre2);
        $manager->persist($oeuvre3);
        $manager->persist($artiste);
        $manager->persist($artiste1);
        $manager->persist($artiste2);
        $manager->persist($artiste3);

        // Et j'enregistre en base de données
		$manager->flush();

        // J'enregistre les flashsCode
        $oeuvre->setImgFlashcode('92.156.227.65/GrandAngle/Symfony/web/app_dev.php/testoeuvre/'.$oeuvre->getId().'/show');
        $oeuvre->setGenFlashcode('1');
        $oeuvre1->setImgFlashcode('92.156.227.65/GrandAngle/Symfony/web/app_dev.php/testoeuvre/'.$oeuvre1->getId().'/show');
        $oeuvre1->setGenFlashcode('1');
        $oeuvre2->setImgFlashcode('92.156.227.65/GrandAngle/Symfony/web/app_dev.php/testoeuvre/'.$oeuvre2->getId().'/show');
        $oeuvre2->setGenFlashcode('1');
        $oeuvre3->setImgFlashcode('92.156.227.65/GrandAngle/Symfony/web/app_dev.php/testoeuvre/'.$oeuvre3->getId().'/show');
        $oeuvre3->setGenFlashcode('1');

        // Je persiste les oeuvres
        $manager->persist($oeuvre);
        $manager->persist($oeuvre1);
        $manager->persist($oeuvre2);
        $manager->persist($oeuvre3);

         // Et j'enregistre en base de données
        $manager->flush();
    }
}