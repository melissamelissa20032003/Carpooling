<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Helloworld;
use yii\helpers\ArrayHelper;
use app\models\Internaute;
use app\models\Voyage;
use app\models\Trajet;
use app\models\Reservation;
use app\models\RechercheForm;
use app\models\ReservationForm;
use app\models\VoyageForm;
use app\models\RegistrationForm;

// https://pedago.univ-avignon.fr/~uapv2300382/
/*SELECT *
FROM fredouil.voyage AS v
JOIN trajet AS t ON v.trajet = t.id;
*/
use yii\helpers\Url;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->pass = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


   /**section ajouter 
   ** hello world 
   *
   **/
//partie 3 TP1 comme arg $argm
public function actionHelloworld()
    {
     // instantier
      $obj = new Helloworld();
      $result = ArrayHelper::map($obj->getArray(), 'id', 'produit'); 
  
      
        return $this->render('helloworld', [
            'message' => $result
,
        ]);
    }


public function actionInternaute($pseudo)
{
$internaut = Internaute::getUserByIdentifiant($pseudo);
            if ($internaut === null) {return "Aucun internaute trouvé avec le pseudo {$pseudo}.";}

        $voyages = $internaut->getVoyages();  
            if ($voyages === null) { return "L'internaute n'est pas un conducteur.";}
                foreach ($voyages as $voyage) {
                    if ($voyage->getTrajetP() === null) {
                        echo "Pas de trajet associé pour ce voyage ID: {$voyage->id}";
                    }
                }

        $reservations = $internaut->getReservations();
            if($reservations === null){ return "l'internaute n'a pas de reservation ";}

    

    // Render the information view
    return $this->render('internaute', [
        'internaute' =>$internaut,
        'voyages' => $voyages,
        'reservations' => $reservations,
    ]);
}


public function actionRecherche()
{
    $model = new RechercheForm();
    $request = Yii::$app->request;

    // Si une requête POST est envoyée, on traite la recherche
    if ($request->isPost && $model->load($request->post()) && $model->validate()) {
        $villeD = ucfirst(strtolower($model->villeD));  
        $villeA = ucfirst(strtolower($model->villeA)); 
        $nombrePersonnes = $model->nombrePersonnes;

        // Recherche des trajets correspondants
        $trajets = Trajet::getTrajetv($villeD, $villeA); 
        $voyages = [];

        // Récupérer les voyages associés à chaque trajet
        if (!empty($trajets)) {
            foreach ($trajets as $trajet) {
                $voyages = array_merge($voyages, $trajet->voyages);
            }
        }

         // Message conditionnel basé sur les résultats
         if (empty($voyages)) {
            $message = 'Aucun voyage trouvé pour votre recherche.';
        } else {
            $message = 'Recherche terminée avec succés.';
        }




        // Si c'est une requête AJAX, on retourne les résultats et le message
        if ($request->isAjax) {
          
            return $this->asJson([
                'html' => $this->renderPartial('_resultats', [
                    'voyages' => $voyages,
                    'model' => $model,
                    'nombrePersonnes' => $nombrePersonnes,
                ]),
                'message' => $message
            ]);
        }

        // Retourner la vue complète (si ce n'est pas une requête AJAX)
        return $this->render('recherche', [
            'voyages' => $voyages,
            'model' => $model,
            'nombrePersonnes' => $nombrePersonnes,
        ]);
    }

    // Si le formulaire est vide ou invalidé, afficher la vue initiale
    return $this->render('recherche', [
        'voyages' => [],
        'model' => $model,
        'nombrePersonnes' => '',
    ]);
} 






public function actionInscription()
{
    $model = new Internaute();

    if (Yii::$app->request->isAjax) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->saveUser()) {  // vauvgarder dans la base de données 
                Yii::info('Nouvel utilisateur enregistré : ' . $model->pseudo);
                return [
                    'success' => true,
                    'message' => 'Inscription réussie ! Vous allez être redirigé vers la page de connexion.',
                ];
            } else { //envoyer un message d'erreur 
                Yii::error('Erreur d\'enregistrement : ' . json_encode($model->getErrors()));
                return [
                    'success' => false,
                    'message' => 'Une erreur est survenue lors de l\'inscription. Veuillez réessayer.',
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Veuillez vérifier les données saisies.',
            'errors' => $model->getErrors(), // Provide validation errors
        ];
    }

    // Render the form for non-AJAX requests
    return $this->render('inscription', [
        'model' => $model,
    ]);
}








public function actionReserve($voyageId)
{
    if (Yii::$app->user->isGuest) {
        if (Yii::$app->request->isAjax) {
            return $this->asJson([
                'success' => false,
                'message' => 'Vous devez être connecté pour réserver.'
            ]);
        }
       
        return $this->redirect(['site/login']);
    }

    $model = new ReservationForm();
    $voyage = Voyage::getVoyageById($voyageId);

    if ($voyage === null) {
        if (Yii::$app->request->isAjax) {
            return $this->asJson([
                'success' => false,
                'message' => 'Le voyage demandé n\'existe pas.'
            ]);
        }
        throw new \yii\web\NotFoundHttpException("Le voyage demandé n'existe pas.");
    }
  // dans la base de données pour savoire le nombre de place deja reserver on fait la some de placesresa pour le meme id de voyage 
  //  pour tester on peut faire Paris Toulouse 1
    $placesDisponibles = $voyage->getPlacesDisponibles();

    if ($placesDisponibles <= 0) {
        if (Yii::$app->request->isAjax) {
            return $this->asJson([
                'success' => false,
                'message' => 'Plus de places disponibles pour ce voyage.'
            ]);
        }
       
        return $this->redirect(['site/recherche']);
    }
    // verifier que le nombre de place est bien valider 
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if ($model->nbplaces > $placesDisponibles) {
            return $this->asJson([
                'success' => false,
                'message' => 'Le nombre de places demandées dépasse les places disponibles.'
            ]);
        }

        $reservation = new Reservation();
        $reservation->voyage = $voyageId;
        $reservation->voyageur = Yii::$app->user->id;
        $reservation->nbplaceresa = $model->nbplaces;

        if ($reservation->save()) { // ActiveRecord 
            if (Yii::$app->request->isAjax) {
                return $this->asJson([
                    'success' => true,
                    'message' => 'Réservation réussie !'
                ]);
            }
          
            
            return $this->redirect(['site/profile']);
        }
    }

    // Si ce n'est pas une requête AJAX, afficher la vue de réservation
    return $this->render('reserve', [
        'model' => $model,
        'voyage' => $voyage,
        'placesDisponibles' => $placesDisponibles,
    ]);
}




public function actionProfile()
{
    // Vérifier si l'utilisateur est connecté
    if (Yii::$app->user->isGuest) {
        Yii::$app->session->setFlash('error', 'Vous devez être connecté pour voir votre profil.');
        return $this->redirect(['site/login']);
    }

    // Récupérer l'internaute connecté
    $userId = Yii::$app->user->id;
     // Utiliser la méthode getUserById pour récupérer les détails de l'internaute
     $internaute = Internaute::getUserById($userId);

    if ($internaute === null) {
        throw new \yii\web\NotFoundHttpException("Utilisateur non trouvé.");
        return $this->redirect(['site/index']);
    }


     
    // Récupérer les réservations de l'internaute
    $reservations =  $internaute->getReservations();

    // Récupérer les voyages proposés par l'internaute
    $voyages = $internaute->getVoyages(); // Utilise la relation définie dans le modèle

   
    // Si le formulaire est soumis pour mettre à jour le permis
    if ($internaute->load(Yii::$app->request->post()) && $internaute->validate()) {
        // Sauvegarder le numéro de permis
        if ($internaute->save()) {
            Yii::$app->session->setFlash('success', 'Votre numéro de permis a été mis à jour avec succès.');
        } else {
            Yii::$app->session->setFlash('error', 'Une erreur est survenue lors de la mise à jour du numéro de permis.');
        }
    }


    // Passer les données à la vue
    return $this->render('profile', [
        'internaute' => $internaute,
        'reservations' => $reservations,
        'voyages' => $voyages,
    ]);
}





public function actionProposer()
{

    //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    if (Yii::$app->request->isAjax) {
        if (Yii::$app->user->isGuest) {
            return $this->asJson([
                'success' => false,
                'message' => 'Vous devez être connecté pour proposer un voyage.',
                'redirect' => Url::to(['site/login']),
            ]);
        }

        $internaute = Yii::$app->user->identity;

        if (empty($internaute->permis)) {
            return $this->asJson([
                'success' => false,
                'message' => 'Vous devez renseigner votre numéro de permis avant de proposer un voyage.',
                'redirect' => Url::to(['site/profile']),
            ]);
        }

        $model = new VoyageForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $trajets = Trajet::getTrajetv($model->depart, $model->arrivee);

            if (empty($trajets)) {
                return $this->asJson([
                    'success' => false,
                    'message' => 'Le trajet spécifié n\'existe pas. Veuillez vérifier les villes de départ et d\'arrivée.',
                ]);
            }

            $trajetId = $trajets[0]->id;

            $voyage = new Voyage();
            $voyage->conducteur = Yii::$app->user->id;
            $voyage->trajet = $trajetId;
            $voyage->typevehicule = $model->typevehicule;
            $voyage->marque = $model->marque;
            $voyage->tarif = $model->tarif;
            $voyage->nbplacedispo = $model->nbplacedispo;
            $voyage->nbbagage = $model->nbbagages;
            $voyage->heuredepart = $model->heuredepart;
            $voyage->contraintes = $model->contraintes;

            if ($voyage->save()) { //ActiveRecord 
                return $this->asJson([
                    'success' => true,
                    'message' => 'Voyage proposé avec succès !',
                    'redirect' => Url::to(['site/profile']),
                ]);
            } else {
                Yii::error('Failed to save voyage: ' . json_encode($voyage->getErrors()), __METHOD__);
                return $this->asJson([
                    'success' => false,
                    'message' => 'Erreur lors de l\'enregistrement du voyage.',
                    'errors' => $voyage->getErrors(),
                ]);
            }
        }

        Yii::error('Validation errors: ' . json_encode($model->getErrors()), __METHOD__);
        return $this->asJson([
            'success' => false,
            'message' => 'Les données fournies ne sont pas valides.',
            'errors' => $model->getErrors(),
        ]);
    }

    $model = new VoyageForm();
    return $this->render('proposer', ['model' => $model]);
}














public function actionVoirVoyage($id)
{
    // Récupérer le voyage avec l'ID donné
    $voyage = Voyage::getVoyageById($id) ;

    // Vérifier si le voyage existe
    if ($voyage === null) {
        Yii::$app->session->setFlash('error', 'Le voyage demandé n\'existe pas.');
        return $this->redirect(['site/index']);
    }

    // Récupérer les informations de l'internaute conducteur
    $conducteur = $voyage->conducteurP; 

    return $this->render('voir-voyage', [
        'voyage' => $voyage,
        'conducteur' => $conducteur,
    ]);
}





public function actionSupprimerVoyage($id)
{
    // Récupérer le voyage avec l'ID donné
    $voyage = Voyage::getVoyageById($id);

    // Vérifier si le voyage existe
    if ($voyage === null) {
        Yii::$app->session->setFlash('error', 'Le voyage à supprimer n\'existe pas.');
        return $this->redirect(['site/index']);
    }

    // Supprimer le voyage
    if ($voyage->delete()) {
        Yii::$app->session->setFlash('success', 'Voyage supprimé avec succès!');
        return $this->redirect(['site/profile']); // Redirige vers la page du profil après suppression
    } else {
        Yii::$app->session->setFlash('error', 'Une erreur est survenue lors de la suppression du voyage.');
        return $this->redirect(['site/profile']); // Redirige vers la page du profil après suppression
    }

    return $this->redirect(['site/supprimer-voyage']); // Redirige vers la page du profil après suppression
}



// mise a jour de permis 

public function actionUpdateProfile()
{
    $user = Yii::$app->user->identity;

    // Load the data if the form is submitted
    if ($user->load(Yii::$app->request->post()) && $user->validate()) {
        // Save the updated permis
        if ($user->save()) {
            Yii::$app->session->setFlash('success', 'Votre permis a été mis à jour.');
        } else {
            Yii::$app->session->setFlash('error', 'Erreur lors de la mise à jour de votre permis.');
        }
    }

    return $this->render('profile', ['internaute' => $user]);
}




}

