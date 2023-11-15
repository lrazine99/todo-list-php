<title><?= $path ?></title>
<link href="<?= SCRIPTS ?>css/style.css" rel="stylesheet">

</head>
<body>
<div class="ajout">
<form action="/list/categorie/add" method="POST">
    <label>
        <input required type="text" name="categorie" id="" value="" placeholder="categorie à rajouter">
        <button type="submit" value="ajouter">+</button>
    </label>
    <input type="hidden" name="token" value="<?= $_SESSION['token']?>">

</form>
</div>
<div class="filtre">

<p>Pour supprimer une catégorie, vous devez d'abord supprimer l'ensemble des items associes </p>
</div>
<div class="filtre">

<a href="/list" class=" linkStyle href"> Revenir </a>
</div>
   
    




<div class="items ">
<?php foreach ($params[0] as $key => $value) : ?>
    <div>
        <div class ="firstDiv" >
            <p>  <?= $value['categorie']?> </p>
        </div>
        <div class="secondDiv">
            <div id="firstLink" onclick="window.location.href='/list/categorie/edit/<?= $value['idCategorie']?>'">
                <a href="/list/categorie/edit/<?= $value['idCategorie']?>|<?= $_SESSION['token']?>" class=" linkStyle"> modifier </a> 
            </div>
            <div id="secondLink" onclick="window.location.href='/list/categorie/delete/<?= $value['idCategorie']?>'">
                <a href="/list/categorie/delete/<?= $value['idCategorie']?>|<?= $_SESSION['token']?>" class=" linkStyle"> supprimer </a> 
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>