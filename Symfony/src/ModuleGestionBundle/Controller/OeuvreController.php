<?php

namespace ModuleGestionBundle\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Endroid\Bundle\QrCodeBundle\Controller\QrCodeController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use ModuleGestionBundle\Entity\Oeuvre;
use ModuleGestionBundle\Entity\Statut;
use ModuleGestionBundle\Entity\Tableau;
use ModuleGestionBundle\Entity\MultimediaType;
use ModuleGestionBundle\Form\OeuvreType;

/**
 * Oeuvre controller.
 *
 */
class OeuvreController extends Controller
{
    public function indexAction(Request $req)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        // Si on reçoit une requête Ajax
        if($req->isXMLHttpRequest()){
            // Connection à la base de données
            $connection = $this->get('database_connection');
            // récupérer la liste complète des oeuvres
            $query = "select o.nom,o.etat,a.nom as nomArt,a.prenom as preNomArt,o.nombreVisite,e.position,o.id,o.imgFlashcode as img, t.discr as type from oeuvre as o
                            left join emplacement as e on e.oeuvre_id = o.id
                            inner join artiste as a on o.artiste_id = a.id
                            left join typeoeuvre as t on o.typeoeuvre_id = t.id";
            // On stocke le résultat
            $rows = $connection->fetchAll($query);
            // Puis on le renvoie dans un tableau en Json
            return new JsonResponse(array('data' => json_encode($rows)));

        // Sinon on charge normalement
        }else{
            $em = $this->getDoctrine()->getManager();

            $oeuvres = $em->getRepository('ModuleGestionBundle:Oeuvre')->getFindAllOeuv();
            $expositions = $em->getRepository('ModuleGestionBundle:Exposition')->findAll();

            return $this->render('oeuvre/index.html.twig', array(
                'oeuvres'     => $oeuvres,
                'expositions' => $expositions,
                'role'        => $role,
            ));
        }
    }

    public function listOeuvreAction(Request $req)
    {
         // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        if($req->isXMLHttpRequest()) {
            $id = $req->get('id');
            $connection = $this->get('database_connection');
            // récupérer la liste des oeuvres
            $query = "select o.nom,o.etat,a.nom as nomArt,a.prenom as preNomArt,o.nombreVisite,e.position,o.id,o.imgFlashcode as img, t.discr as type from oeuvre as o
                            left join emplacement as e on e.oeuvre_id = o.id
                            inner join artiste as a on o.artiste_id = a.id
                            inner join typeoeuvre as t on o.typeoeuvre_id = t.id  
                                    where e.exposition_id = " . $id;
            $rows = $connection->fetchAll($query);
            return new JsonResponse(array('data' => json_encode($rows)));
        }
        return new Response("Erreur : Ce n'est pas une requête Ajax", 400);
    }

    // Methode non sécurisée pour test qrcode
    public function testOeuvreAction(Oeuvre $oeuvre)
    {
        $deleteForm = $this->createDeleteForm($oeuvre);

        return $this->render('oeuvre/testshow.html.twig', array(
            'oeuvre' => $oeuvre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a new Oeuvre entity.
     *
     */
    public function newAction(Request $request)
    {
        // Si on vient de créer un artiste on récupère son id
        $idArtist = $request->query->get('id');
        
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $oeuvre = new Oeuvre();
        
        $form = $this->createForm('ModuleGestionBundle\Form\OeuvreType', $oeuvre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            // Si on a un tableau
            if (isset($request->request->All()["oeuvre"]["tableau"])) {

                $tableau = new Tableau();
                // On stocke le nom des différents champs
                $titre = $request->request->get("oeuvre")["tableau"][1]["tableau"]["titre"];
                $dateCreation = $request->request->get("oeuvre")["tableau"][1]["tableau"]["dateCreation"];
                $largeur = $request->request->get("oeuvre")["tableau"][1]["largeur"];
                $hauteur = $request->request->get("oeuvre")["tableau"][1]["hauteur"];

                // On alimente l'objet tableau
                $tableau->setTitre($titre);
                $tableau->setDateCreation($dateCreation);
                $tableau->setLargeur($largeur);
                $tableau->setHauteur($hauteur);

                // On persist
                $em->persist($tableau);
                // Puis on enregistre
                $em->flush();

                // Puis je définis le type d'oeuvre
                $oeuvre->setTypeOeuvre($tableau);
            }
            // Si on a une statut
            if (isset($request->request->All()["oeuvre"]["statut"])) {

                $statut = new Statut();
                // On stocke le nom des différents champs
                $titre = $request->request->get("oeuvre")["statut"][1]["statut"]["titre"];
                $dateCreation = $request->request->get("oeuvre")["statut"][1]["statut"]["dateCreation"];
                $largeur = $request->request->get("oeuvre")["statut"][1]["largeur"];
                $hauteur = $request->request->get("oeuvre")["statut"][1]["hauteur"];
                $longueur = $request->request->get("oeuvre")["statut"][1]["longueur"];
                $profondeur = $request->request->get("oeuvre")["statut"][1]["profondeur"];

                // On alimente l'objet statut
                $statut->setTitre($titre);
                $statut->setDateCreation($dateCreation);
                $statut->setLargeur($largeur);
                $statut->setHauteur($hauteur);
                $statut->setLongueur($longueur);
                $statut->setProfondeur($profondeur);

                // On persist
                $em->persist($statut);
                // Puis on enregistre
                $em->flush();

                // Puis je définis le type d'oeuvre
                $oeuvre->setTypeOeuvre($statut);
            }
          
            //Si on a un fichier multimedia
            if($request->files->count() > 0){

                // On récupère le fichier 
                $file = $request->files->get("oeuvre")["multi"][1]["fichier"];

                // On génère un nom unique pour ce fichier 
                $filename = md5(uniqid()).'.'.$file->getClientOriginalExtension();

                // Fonction pour calculer la taille du fichier
                function taille_fichier($octets) {
                    $resultat = $octets;
                    for ($i=0; $i < 8 && $resultat >= 1024; $i++) {
                        $resultat = $resultat / 1024;
                    }
                    if ($i > 0) {
                        return preg_replace('/,00$/', '', number_format($resultat, 2, ',', '')) 
                . ' ' . substr('KMGTPEZY',$i-1,1) . 'o';
                    } else {
                        return $resultat . ' o';
                    }
                }

                // On déplace ensuite le fichier dans le dossier prévu à cette effet
                $file->move(
                    $this->container->getParameter('multimedias_directory'),
                    $filename
                );

                $titre = pathinfo($file->getClientOriginalName())["filename"];
                $dateCreation = $request->request->all()["oeuvre"]["multi"][1]["multi"]["dateCreation"];
                $duree = $request->request->all()["oeuvre"]["multi"][1]["duree"];
                $stockage = taille_fichier($file->getClientSize());
                // Si on a une video
                if(isset($request->request->all()["oeuvre"]["multi"][1]["video"]))
                    $video = $request->request->all()["oeuvre"]["multi"][1]["video"];
                else
                    $video = 0;

                // On instancie un objet MultimediaType
                $multimedia =  new MultimediaType();
                $multimedia->setTitre($titre);
                $multimedia->setDateCreation($dateCreation);
                $multimedia->setDuree($duree);
                $multimedia->setStockage($stockage);
                $multimedia->setVideo($video);
                $multimedia->setFichier($filename);

                // Je persiste le multimedia et je l'enregistre
                $em->persist($multimedia);
                $em->flush();

                // Puis je définis le type d'oeuvre
                $oeuvre->setTypeOeuvre($multimedia);
            }
            $em->persist($oeuvre);
            $em->flush();

            // On récupère l'id de l'oeuvre enregistrée
            $id = $oeuvre->getId();

            // Si le champs genFlashcode existe
            if(isset($request->request->All()["oeuvre"]["genFlashcode"])){
                // Si on a coché pour générer un Qrcode
                if($request->request->All()["oeuvre"]["genFlashcode"] == 1){

                   $IP = "localhost"; // Adresse en local par défaut modifiable ex: 92.156.227.65
                   // Puis on l'intègre dans le lien de redirection
                   $oeuvre->setImgFlashcode('/qrcode/'.$IP.'/GrandAngle/Symfony/web/testoeuvre/'.$id.'/show');
                   // On persist le changement
                   $em->persist($oeuvre);
                   // On enregistre
                   $em->flush();
                }
            }

            return $this->redirectToRoute('oeuvre_show', array(
                'id'   => $id,
                'role' => $role,
            ));
        }

        return $this->render('oeuvre/new.html.twig', array(
            'idArtist' => $idArtist,
            'oeuvre' => $oeuvre,
            'form' => $form->createView(),
            'role' => $role,
        ));
    }

    /**
     * Finds and displays a Oeuvre entity.
     *
     */
    public function showAction(Oeuvre $oeuvre)
    {
        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        $deleteForm = $this->createDeleteForm($oeuvre);
        return $this->render('oeuvre/show.html.twig', array(
            'oeuvre' => $oeuvre,
            'delete_form' => $deleteForm->createView(),
            'role'   => $role,
        ));
    }

    /**
     * Displays a form to edit an existing Oeuvre entity.
     *
     */
    public function editAction(Request $request, Oeuvre $oeuvre)
    {
        //En dessous du role user, on ne peut pas y accèder
        $this->denyAccessUnlessGranted('ROLE_USER');

        // On récupère le role de la personne connectée
        $role = $this->getUser()->getRole();

        // On prépare le formulaire Oeuvre
        $editForm = $this->createForm('ModuleGestionBundle\Form\OeuvreType', $oeuvre);

        // On récupère le type d'oeuvre en cours
        $typeOeuvreEnCours = $oeuvre->getTypeOeuvre()->getDiscr();

        // On prépare le formulaire du type d'oeuvre en cours
        if($typeOeuvreEnCours == "Statut")
            $editTypeForm = $this->createForm('ModuleGestionBundle\Form\StatutType', $oeuvre->getTypeOeuvre());
        elseif($typeOeuvreEnCours == "Tableau")
            $editTypeForm = $this->createForm('ModuleGestionBundle\Form\TableauType', $oeuvre->getTypeOeuvre());
        elseif($typeOeuvreEnCours == "Multimédia")
            $editTypeForm = $this->createForm('ModuleGestionBundle\Form\MultimediaTypeType', $oeuvre->getTypeOeuvre());

        // On récupère la requête
        $editForm->handleRequest($request);

        // Si le formulaire a été soumi et qu'il est valide
        if ($editForm->isSubmitted() && $editForm->isValid()) {

            // On stocke l'id de l'oeuvre
            $id = $oeuvre->getId();

            // On appelle l'entity manager
            $em = $this->getDoctrine()->getManager();

            // On fait une requête pour récupérer les infos de l'oeuvre
            $oeuvre = $em->getRepository('ModuleGestionBundle:Oeuvre')->find($id);

            // Si elle n'existe pas on déclenche une erreur
            if(!$oeuvre) {
                throw $this->createNotFoundException('Aucune oeuvre avec l\'id '.$id);
            }

            // On créé deux tableaux (Multimédia et TexteOeuvre)
            $originalMultimedias =  new ArrayCollection();
            $originalTexteOeuvres = new ArrayCollection();

            // On boucle sur l'oeuvre pour récupérer ses multimédias existants
            foreach ($oeuvre->getMultimedias() as $Multimedia) {
                $originalMultimedias->add($Multimedia);
            }

            // On fait de même pour les textes existants
            foreach ($oeuvre->getTexteoeuvres() as $TexteOeuvre) {
                $originalTexteOeuvres->add($TexteOeuvre);
            }

            
            // On parcourt chacun des multimédias existants 
            foreach ($originalMultimedias as $Multimedia) {

                // Si le multimédia existant n'est pas contenu dans le formulaire on l'efface
                if(false === $oeuvre->getMultimedias()->contains($Multimedia)) {

                    $em->remove($Multimedia);
                }    
            }

            // On parcourt maintenant chacun des textes existants 
            foreach ($originalTexteOeuvres as $TexteOeuvre) {

                // Si le multimédia existant n'est pas contenu dans le formulaire on l'efface
                if(false === $oeuvre->getTexteoeuvres()->contains($TexteOeuvre)) {

                    $em->remove($TexteOeuvre);
                }    
            }

            // Si le champs genFlashcode existe
            if(isset($request->request->All()["oeuvre"]["genFlashcode"])){
                // Si on a coché pour générer un Qrcode
                if($request->request->All()["oeuvre"]["genFlashcode"] == 1){

                   $IP = "localhost"; // Adresse en local par défaut modifiable ex: 92.156.227.65
                   // Puis on l'intègre dans le lien de redirection
                   $oeuvre->setImgFlashcode('/qrcode/'.$IP.'/GrandAngle/Symfony/web/testoeuvre/'.$id.'/show');
                   // On persist le changement
                   $em->persist($oeuvre);
                   // On enregistre
                   $em->flush();
                }
            }

            // On persist le changement
            $em->persist($oeuvre);
            // On exécute
            $em->flush();

            return $this->redirectToRoute('oeuvre_edit', array(
                'id'   => $oeuvre->getId(),
                'role' => $role,
            ));
        }

        return $this->render('oeuvre/edit.html.twig', array(
            'oeuvre' => $oeuvre,
            'edit_form' => $editForm->createView(),
            'editTypeForm' => $editTypeForm->createView(),
            'role'   => $role,
        ));
    }

    /**
     * Deletes a Oeuvre entity.
     *
     */
    public function deleteAction(Request $request, Oeuvre $oeuvre)
    {
        $form = $this->createDeleteForm($oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oeuvre);
            $em->flush();
        }

        return $this->redirectToRoute('oeuvre_index');
    }

    /**
     * Creates a form to delete a Oeuvre entity.
     *
     * @param Oeuvre $oeuvre The Oeuvre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Oeuvre $oeuvre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('oeuvre_delete', array('id' => $oeuvre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
