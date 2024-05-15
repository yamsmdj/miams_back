<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Etape;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $recettes = [
            [ 'title' => 'Salade Cesar', 'description' => 'Tres bonne pour l\'été fraiche et appetissante', 'time' => 20,'created_at' => new \DateTimeImmutable ( '2024-05-03 16:35:16'),'categorie_id' => 1, 'picture' =>'recettes663ff61162a24.png'],
            [ 'title' => 'La quiche lorraine',  'description' =>'Maintenant que vous maîtrisez la pâte brisée, je vous montre comment la garnir façon Lorraine avec du lard fumé et beaucoup de gruyère bien sûr !! Prêts à vous régaler ?!\n', 'time' => 30, 'created_at' => new \DateTimeImmutable ( '2024-04-20 18:15:29'),'categorie_id' => 1,'picture' => 'laquichelorraine.png'],
            [ 'title' => 'Lasagnes à la bolognaise',  'description' =>' la bolognaise est parfaite pour découvrir les légumineuses. Enrobées de sauce tomate, les lentilles se transforment en une sauce fondante et végétarienne ! »', 'time' => 125, 'created_at' => new \DateTimeImmutable ('2024-04-24 21:42:39'),'categorie_id' => 2, 'picture' =>'lasagnesalabolognaise.png'],
            [ 'title' => 'fondant au chocolat', 'description' => '« Pour aller plus vite, pour faire fondre le chocolat et le beurre, je mets le tout dans un bol coupé en carrés au micro-ondes.', 'time' => 40, 'created_at' => new \DateTimeImmutable ( '2024-04-24 21:47:29'), 'categorie_id' => 3, 'picture' =>'fondant_au_chocolat.png'],
            [ 'title' => 'Risotto aux champignons', 'description' => 'Tres bonne pour l\'été fraiche et appetissante', 'time' =>50, 'created_at' => new \DateTimeImmutable ( '2024-04-28 13:25:56'),'categorie_id' => 2, 'picture' => 'risottoauxchampignons.png'],
            [ 'title' => 'Meringue',  'description' =>'Cette recette est un miracle !', 'time' =>10, 'created_at' => new \DateTimeImmutable ('2024-04-28 13:51:44'),'categorie_id' => 3,'picture' => 'meringue.png'],
            [ 'title' => 'Oeufs mollets',  'description' =>'La cuisson des oeufs ne s\'improvise pas. Attention donc à cuire des oeufs qui sont à température ambiante. Donc si vous avez l\'habitude de les conserver au réfrigérateur, sortez-les 1 heure avant. Ainsi, vous éviterez les chocs thermiques et le risque que','time' => 8, 'created_at' => new \DateTimeImmutable ( '2024-05-06 23:34:47'),'categorie_id' => 1, 'picture' => 'oeufsmollets.png'],
            [ 'title' => 'Eau', 'description' => 'je bois de l\'eau', 'time' => 0, 'created_at' => new \DateTimeImmutable ('2024-05-08 13:43:02'), 'categorie_id' => 1, 'picture' =>'eau.png'],
            [ 'title' => 'test', 'description' =>'test', 'time' => 5, 'created_at' => new \DateTimeImmutable ('2024-05-11 20:43:47'),'categorie_id' => 2, 'picture' => 'recettes663fe857b6a4a.png']
        ];
        $categories = [
            ['name' => 'Entrée'],
            ['name' => 'Plats'],
            ['name' => 'Dessert'],
        ];
        $ingredients = [
            ['name' => 'amandes'],
            ['name' => 'ananas'],
            ['name' => 'asperge'],
            ['name' => 'avocat'],
            ['name' => 'avoine'],
            ['name' => 'betterave'],
            ['name' => 'carotte'],
            ['name' => 'celeri-rave'],
            ['name' => 'chou vert'],
            ['name' =>  'endive'],
            ['name' =>  'epinards'],
            ['name' =>  'poireau'],
            ['name' =>  'poire'],
            ['name' =>  'radis'],
            ['name' =>  'oeuf'],
            ['name' =>  'poivre'],
            ['name' =>  'sel'],
            ['name' =>  'citron'],
            ['name' =>  'huile'],
            ['name' =>  'moutarde'],
            ['name' =>  'pain écroûtées'],
            ['name' =>  'muscade'],
            ['name' =>  'creme fraiche'],
            ['name' =>  'beurre'],
            ['name' =>  'lait'],
            ['name' =>  'lasagnes'],
            ['name' =>  'eau'],
            ['name' =>  'farine'],
            ['name' =>  'fromage rape'],
            ['name' =>  'sucre en poudre'],
            ['name' =>  'chocolat'],
            ['name' =>  'sucre semoule'],
            ['name' =>  'blanc d\'oeuf']
        ];
        $users = [
            [
                'email' => 'admin@admin.com',
                'roles' => ['ROLE_ADMIN', 'ROLE_USER'],
                'password' => '$2y$13$2HFiA2QnPdkaZeDf1zXR2O09aG7oPjhIQGSc93FgTsmc3qVViYK8y'
            ],
            [
                'email' => 'user@user.com',
                'roles' => ['ROLE_USER'],
                'password' => '$2y$13$eWX8NSVj3usI7mt//2hofOBfKrJYmYZJyYXmqUCf.E/pR2EUE.9gu'
            ],
        ];
        $etapes = [
            ['recette_id' => 1,'n_etape' => 1,  'description' =>'Faire revenir gousses hachées d\'ail et les oignons émincés dans un peu d\'huile d\'olive.'],
            ['recette_id' => 1,'n_etape' => 2,  'description' =>'Ajouter la carotte et la branche de céleri hachée puis la viande et faire revenir le tout.'],
            ['recette_id' => 1,'n_etape' => 3,  'description' =>'Au bout de quelques minutes, ajouter le vin rouge. Laisser cuire jusqu\'à évaporation.'],
            ['recette_id' => 1,'n_etape' => 4,  'description' =>'Ajouter la purée de tomates, l\'eau et les herbes. Saler, poivrer, puis laisser mijoter à feu doux 45 minutes.'],
            ['recette_id' => 1,'n_etape' => 5,  'description' =>'Préparer la béchamel : faire fondre 100 g de beurre.'],
            ['recette_id' => 1,'n_etape' => 6,  'description' =>'Remettre sur le feu et remuer avec un fouet jusqu\'à l\'obtention d\'un mélange bien lisse. '],
            ['recette_id' => 1,'n_etape' => 7,  'description' =>'Déguster'],
            ['recette_id' => 6,'n_etape' => 1,  'description' =>'Faites dorer le pain, coupé en cubes, 3 min dans un peu d\'huile. '],
            ['recette_id' => 6,'n_etape' => 2,  'description' =>'Déchirez les feuilles de romaine dans un saladier, et ajoutez les croûtons préalablement épongés dans du papier absorbant.'],
            ['recette_id' => 6,'n_etape' => 3,  'description' =>'Préparez la sauce : Faites cuire l\'oeuf 1 min 30 dans l\'eau bouillante, et rafraîchissez-le.'],
            ['recette_id' => 6,'n_etape' => 4,  'description' =>'Cassez-le dans le bol d\'un mixeur et mixez, avec tous les autres ingrédients; rectifiez l\'assaissonnement et incorporez à la salade. '],
            ['recette_id' => 6,'n_etape' => 5,  'description' =>'Décorez de copeaux de parmesan, et servez.'],
            ['recette_id' => 2,'n_etape' => 1,  'description' =>'Préchauffer le four à 180°C (thermostat 6). Etaler la pâte dans un moule'],
            ['recette_id' => 2,'n_etape' => 2,  'description' =>'la piquer à la fourchette. Parsemer de copeaux de beurre.'],
            ['recette_id' => 2,'n_etape' => 3,  'description' =>'Faire rissoler les lardons à la poêle puis les éponger avec une feuille d\'essuie-tout.'],
            ['recette_id' => 2,'n_etape' => 4,  'description' =>'Battre les oeufs, la crème fraîche et le lait.'],
            ['recette_id' => 2,'n_etape' => 5,  'description' =>'Cuire 45 à 50 min.'],
            ['recette_id' => 2,'n_etape' => 6,  'description' =>'Déguster'],
            ['recette_id' => 4,'n_etape' => 1,  'description' =>'Préchauffer le four à 180°C (thermostat 4). Faire fondre le chocolat et le beurre au bain-marie à feu doux, ou au micro-ondes sur le programme décongélation'],
            ['recette_id' => 4,'n_etape' => 2,  'description' =>'Pendant ce temps, séparer les jaunes des blancs d\'oeuf.'],
            ['recette_id' => 4,'n_etape' => 3,  'description' =>'Quand le mélange chocolat-beurre est bien fondu, ajouter les jaunes d’oeufs et fouetter. '],
            ['recette_id' => 4,'n_etape' => 4,  'description' =>'Incorporer le sucre et la farine, puis ajouter les blancs d’oeufs sans les casser.'],
            ['recette_id' => 4,'n_etape' => 5,  'description' =>'Beurrer et fariner un moule à manqué et y verser la pâte à gâteau.'],
            ['recette_id' => 4,'n_etape' => 6,  'description' =>'Quand le gâteau est cuit, le laisser refroidir avant de le démouler'],
            ['recette_id' => 5,'n_etape' => 1,  'description' =>'Faire blanchir les champignons dans 1/2 litre d\'eau salée pendant 5 minutes. Égouttez-les et conservez leur bouillon.'],
            ['recette_id' => 5,'n_etape' => 2,  'description' =>'Dans un poêlon ou une grande casserole à fond peu épais, faire revenir l\'oignon, l\'ail et le persil hachés fin dans 2 cuillères à soupe de crème fraiche.'],
            ['recette_id' => 5,'n_etape' => 3,  'description' =>'Rajoutez le riz, les champignons, le reste de la crème et le mascarpone et recouvrez du bouillon. Assaisonnez. Laissez cuire à couvert à feu moyen jusqu\'à ce que le riz soit fondant et la sauce crémeuse (au moins 45 minutes).'],
            ['recette_id' => 5,'n_etape' => 4,  'description' =>'Hors du feu, incorporez le parmesan râpé. Remuez bien.'],
            ['recette_id' => 5,'n_etape' => 5,  'description' =>'Servez bien chaud.'],
            ['recette_id' => 5,'n_etape' => 6,  'description' =>'A servir avec des langoustines par exemple.'],
            ['recette_id' => 7, 'n_etape' =>1, 'description' => 'Faire blanchir les champignons dans 1\/2 litre d\'eau salée pendant 5 minutes. Égouttez-les et conservez leur bouillon.'],
            ['recette_id' => 7, 'n_etape' =>2, 'description' => 'Mettez les blancs et le sel dans un saladier.'],
            ['recette_id' => 7, 'n_etape' =>3, 'description' => 'Fouettez de plus en plus vite.'],
            ['recette_id' => 7, 'n_etape' =>4, 'description' => 'Incorporez le vinaigre et la maïzena tamisée.'],
            ['recette_id' => 7, 'n_etape' =>5, 'description' => 'Formez aussitôt des tas sur une plaque anti-adhésive.'],
            ['recette_id' => 7, 'n_etape' =>6, 'description' => 'Enfournez pour 1 heure de cuisson. Les meringues doivent être blond très clair, sèches dessus et dessous. '],
            ['recette_id' => 7, 'n_etape' =>7, 'description' => 'Laissez refroidir puis décollez-les du papier cuisson.'],
            ['recette_id' => 8, 'n_etape' =>1, 'description' => 'acheter l\'eau'],
            ['recette_id' => 8, 'n_etape' =>2, 'description' => 'ouvrir la bouteille'],
            ['recette_id' => 8, 'n_etape' =>3, 'description' => 'verser dans un verre'],
            ['recette_id' => 8, 'n_etape' =>4, 'description' => 'Deguster'],
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setRoles($userData['roles']);
            $user->setPassword($userData['password']);
            $manager->persist($user);
        }

        foreach ($categories as $index => $categoryData) {
            $categorie = new Categorie();
            $categorie->setName($categoryData['name']);
            $manager->persist($categorie);
            $this->addReference('categorie_' . ($index + 1 ), $categorie);
        }

        foreach ($ingredients as $index => $ingredientData) {
            $ingredient = new Ingredient();
            $ingredient->setName($ingredientData['name']);
            $manager->persist($ingredient);
            $this->addReference('ingredient_' . ($index + 1), $ingredient);
        }

        foreach ($recettes as $index => $recetteData) {
            $recette = new Recette();
            $recette->setTitle($recetteData['title']);
            $recette->setDescription($recetteData['description']);
            $recette->setTime($recetteData['time']);
            $recette->setCreatedAt($recetteData['created_at']);
            $recette->setCategorie($this->getReference('categorie_' . $recetteData['categorie_id']));
            $recette->setPicture($recetteData['picture']);

            $manager->persist($recette);
            $this->addReference('recette_' . ($index + 1), $recette);
        }

        foreach ($etapes as  $etapeData) {
            $etape = new Etape();
            $etape->setRecette($this->getReference('recette_' . $etapeData['recette_id']));
            $etape->setNEtape($etapeData['n_etape']);
            $etape->setDescription($etapeData['description']);
            
            $manager->persist($etape);
        }

        $manager->flush();
    }
}
