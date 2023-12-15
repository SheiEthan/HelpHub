@extends('layouts.page')

@section('title', 'Recherche - HelpHub')

@section('sidebar')
    @parent   


@endsection


@csrf
@section('content')
    <link rel="stylesheet" type="text/css" href="/css/politique.css">
    <h1>Politique de protection des données personnelles</h1>
    <details>
        <summary>La liste des données personnelles collectées :</summary>
        En effet, l'utilisateur dont sont pris les données personnelles à le droit de savoir quelles sont les informations personnelles récupérées. L'utilisateur utilisant le site web HelpHub aura le droit de savoir quelles données personnelles sont collectées.
    </details>
    <details>
        <summary>La finalité de ces collectes :</summary>
    </details>
    <details>
        <summary>La base juridique de la collecte des données :</summary>
        En effet, vos données personnelles partagées à HelpHub sont justifiées par différentes fondements en fonction de ce que fait HelpHub de vos données personnelles. Plusieurs fondements sur notre site sont appliqués tels que le fait de l'intérêt légitime, en effet chez HelpHub, nous avons un intérêt avec les différentes associations avec lesquelles nous devons partager certaines de vos données personnelles.
        <br>Nous avons le fondement aussi de la loi, le traitement de vos données personnelles est rendu obligatoire par un texte de loi. De plus le consentement fait partie des fondements de nos traitements, vous allez pouvoir, sur le site de HelpHub, accepter le traitement de vos informations personnelles via un consentement avec des cases ç cocher, des clics ou atres. Et vous pourrez changer ce consentement à tout moment.
    </details>
    <details>
        <summary>La durée de conservation de vos données :</summary>
        Vos informations personnelles qui se retrouvent dans nos bases de données telles que les informations de votres compte client, sont conservées jusqu'à inactivité de votre compte et jusqu'àn 3 ans après votre dernière activité sur notre site. De plus, des données personnelles telles que les données de coordonnées bancaires peuvent être enregistrées plus longtemps si besoin pour permettre aux utilisateurs de ne pas rentrer à chaque fois leurs coordonnées afin de refaire des dons.
    </details>
    <details>
        <summary>La liste des tiers ayant accès ou collectant ces données :</summary>
        En effet, étant sur un site proposant des demandes de bénévoles/dons par des associations, une partie de vos données personnelles telles que votre nom, prénom, adresse mail et numéro de téléphone seront partager avec ces associations pour un bon déroulement des missions que vous accepterez, ainsi que vos coordonnées bancaires qui seront partager aux services de paiement. De plus, si vous êtes une association, vos données personnelles telles que le nom d'association et les coordonnées seront partagées avec les utilisateurs afin de pouvoir vous contacter. D'autre part, une partie de vos informations personnelles telles que votre nom et prénom pourront être transmis à notre sous-traitant du service juridique afin que quand un utilisateur fait une recherche pour devenir bénévole, nos sous-traitants cherchent si il n'y a rien à signaler sur l'utilisateur afin de pouvoir accepter ou non la demande de l'utilisateur pour devenir bénévole pour une association précise. 
    </details>
    <details>
        <summary>Les cookies utilisés dans notre site web :</summary>
        Sur HelpHub, nous utilisons des technologies de traçage afin de pouvoir vous adresser des actions de bénévolat en fonction de votre localisation. Cela vous permettra de percevoir des actions proches de chez vous. De plus, nous utilisons des traceurs afin de trouver des actions de bénévolat similaires à vos anciennes recherches ou aux anciennes actions que vous avez effectuées. Cela vous permet de retrouver ce que vous avez pu aimer faire plus rapidement sur notre site pour une meilleure compréhension. Nous vous invitons à consulter la page "Les Cookies" pour obtenir des informations détaillées sur l'utilisation des cookies.
    </details>
    <details>
        <summary>Les droits de l'utilisateur vis-à-vis des données personnelles :</summary>
        L'utilisateur qui donne ses informations personnelles sur notre site web pourra avoir un droit d'accès sur celles-ci ainsi qu'un droit de modification et de suppression. Pour avoir accès à ses données personnelles, l'utilisateur pourra nous contacter via l'adresse mail suivante : privacy@helphub.fr ou alors directement les voir dans sa page de compte où il pourra les modifier comme il le souhaite. 
        <br>Vous disposez également d'un droit à la portabilité et d'un droit à la limitation du traitement de vos données (consultez le liste cnil.fr pour plus d'informations sur vos droits).
        <br>Vous pourrez donc par plusieurs moyens, changer votre consentement des collectes de données personnelles : 
        <ul>
            <li>Tout d'abord lors de la création de votre compte HelpHub</li>
            <li>Ensuite via la page de votre compte dans la rubrique "Mes données personnelles"</li>
            <li>Pour finir en nous envoyant un mail via l'adresse suivante : privacy@helphub.fr</li>
        </ul>
    </details>
    <details>
        <summary>Les éléments permettant de contacter et d'identifier les responsables :</summary>
        Il existe plusieurs moyen de nous contacter, comme l'adresse mail : privacy@helphub.fr, qui servira à l'utilisateur si il souhaite poser des questions sur ses données personnelles, ou de nous faire part d'erreurs ou de problèmes afin que nous puissions réparer le plus rapidement possible. 
        <br>Vous pouvez aussi contacter le Délégué à la protection des données par voie électronique via l'adresse suivante : dpo@helphub.fr. Mais aussi par courrier postal avec l'adresse suivante : 9 rue de l'Arc En Ciel, 74940 Annecy-Le-Vieux.
        <br>Notre responsable du traitement des données se prénomme Ethan TILLIER, vous pouvez le contacter via l'adresse suivante : ethan.tillier@etu.univ-smb.fr
    </details>
    <details>
        <summary>Les éléments que vous êtes susceptible de recevoir :</summary>
    Suite à la création de votre comtpe chez HelpHub, vous serez susceptible de recevoir des informations telles que : 
    <ul>
        <li>Mails de service : suite à vos demandes de bénévolats, vous pourrez recevoir des mails d'informations sur l'avancement de vos demandes de bénévolats ainsi que vos contrats. Ces mails de service sont nécessaires à la bonne exécution des demandes et services que vous avez sollicités. La base légame de ce traitement est le contrat. La réception de ces mails n'est pas liée aux choix que vous avez exprimés pour la réception de la newslettre.</li>
        <li>Newsletters HelpHub : suite à la création de votre compte et via une case à cocher lors de la création de celui ci si vous l'acceptez, vous pourrez recevoir des mails d'offres de bénévolat qui seront visées afin de vous proposer des offres que vous seriez susceptible d'aimer et d'accepter. Cela vous permet d'être tenu au courant des dernières actualités et offres de bénévolat présent sur notre site. Vous pouvez à tout moment gérer vos choix du point de vu des newsletters dans la rubrique "Mes choix".</li>
        <li>Contact téléphonique : suite aux demandes d'offres de bénévolat et vous mettant en lien avec des associations, celles-ci sont susceptibles de vous appeler afin d'avoir plus amples informations ou alors afin de convenir du rendez-vous suites à des changements de dernière minute.</li>
    </ul>
    </details>

    <details>
        <summary>La liste de vos données personnelles :</summary>
        
    </details>

@endsection