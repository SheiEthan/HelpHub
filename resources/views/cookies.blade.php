@extends('layouts.page')

@section('title', 'Recherche - HelpHub')

@section('sidebar')
    @parent   


@endsection


@csrf
@section('content')
    <link rel="stylesheet" type="text/css" href="/css/cookies.css">
    <h1>LES COOKIES</h1>
    <p>Cette page vous permettra de mieux comprendre la fonctionnalité des cookies ou traceurs, ainsi qu'une meilleure compréhension des outils qui vous sont fournis pour les paramétrer.</p>
    <h2>QU'EST-CE QU'UN COOKIE ?</h2>
    <p>Un cookie est un fichier texte déposé sur votre ordinateur lors de la visite d'un site ou de la consultation d'une publicité. Comme d'autres technologies de traçage, ils ont pour objectif de collecter des informations sur votre naviguation sur les sites et de vous fournir des services personnalisés.</p>
    <p>Notre site a été élaboré pour être attentif aux besoins de nos clients. C'est pour cela que nous faisons usage de cookies. Afin de vous identifier et accéder à votre compte, gérer vos actions de bénévolat, gérer vos dons, mémoriser vos consultations et personnaliser les actions/dons que nous vous proposons.</p>
    <h2>COMMENT GERER MES COOKIES ?</h2>
    <p>Vous pouvez consentir aux cookies dans le bandeau d'information cookies visible lors de votre première connexion au site en cliquant sur le bouton "Accepter" figurant sur le bandeau.</p>
    <p>L'accord ainsi donné est valable pour une durée maximum de 13 mois.</p>
    <p>Vous pouvez refuser l'enregistrement en :</p>
    <ul>
        <li>Cliquant sur le bouton "Tout refuser" sur le bandeau</li>
        <li>Personnalisant vos choix dans le gestionnaire de cookie accessible depuis le bouton "Personnaliser mes choix"</li>
    </ul>
    <h2>POURQUOI UTILISONS-NOUS DES COOKIES ?</h2>
    <p>Si nous avons décidé d'exploiter les données personnelles des utilisateurs de notre site, c'est pour leur permettre une expérience plus agréable et plus rapide. En effet, en récoltant les données de géolocalisation et les données des anciennes recherches des utilisateurs, nous pouvons leur proposer des actions de bénévolat plus proche de leurs attentes, afin qu'ils ne ratent pas certaines actions idéales pour eux, ou qu'ils ne perdent trop de temps à en chercher une.</p>
    <h2>A QUI S'ADRESSER SI VOUS AVEZ UNE QUESTION ?</h2>
    <p>Une adresse mail a été mise en place pour répondre à vos questions : privacy@helphub.fr.</p>
    <h2>PLUS D'INFORMATIONS SUR LES COOKIES :</h2>
    <p>Sur le site de la CNIL : </p>
    <a href="https://www.cnil.fr/fr/site-web-cookies-et-autres-traceurs" class="link">cnil.fr</a>
    <p> <br> </p>
    @endsection