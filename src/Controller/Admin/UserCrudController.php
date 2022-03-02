<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    //Création d'une variable utilisable partout -> passwordHasher qui nous permettra d'encoder nos mdp
    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    /*Plusieurs fonctions peuvent être créer dans nos CRUD controller dont : 
        createEntity qui va permettre de gérer les champs qui vont être mis dans le formulaire (exemple : préremplir un champ ou créer un nouveau champ)
        persistEntity qui va permettre de changer les informations qui vont être inscrit dans la base de données au moment de valider un formulaire d'ajout
        updateEntity qui va permettre de changer les informations qui vont être inscrit dans la base de données au moment de valider un formulaire de modification
        deleteEntity qui va permettre de gérer la base de donnée au moment de la suppression

        lien ici : https://symfony.com/bundles/EasyAdminBundle/3.x/crud.html#crud-controller-configuration
    */
    public function persistEntity(EntityManagerInterface $em, $user): void
    {
        //Ici on va encoder le mot de passe à l'ajout d'un utilisateur
        $user->setPassword(
            $this->passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            )
        );

        $em->persist($user);
        $em->flush();
    }

    public function updateEntity(EntityManagerInterface $em, $user): void
    {
        //Ici on va encoder le mot de passe à la modification d'un utilisateur
        //On vérifie d'abord si le mot de passe est encodé 
        //(si c'est le cas cela veut dire que le mot de passe n'a pas changer et qu'on a donc rien à faire)
        if($this->passwordHasher->needsRehash($user)){
            $user->setPassword(
                $this->passwordHasher->hashPassword(
                    $user,
                    $user->getPassword()
                )
            );

            $em->persist($user);
            $em->flush();
        }
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            ArrayField::new('roles'),
            TextField::new('pseudo'),
            TextField::new('password', 'Mot de passe')
        ];
    }
    
}
