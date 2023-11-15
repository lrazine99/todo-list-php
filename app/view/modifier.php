<title><?= $path ?></title>
<link href="<?= SCRIPTS ?>css/style.css" rel="stylesheet">

</head>
<body>

<?php if(count($params) == 2) : ?>
<h1>Modifier list</h1>
<div class="ajout">
<form action="/list/item/update/<?=$params[0]['idList']?>" method="POST">
    <label>
        <input required type="text" name="tache" id="" placeholder="<?=$params[0]['tache']?>">
        <button type="submit" value="modifier">+</button>
    </label>
    <input type="hidden" name="token" value="<?= $_SESSION['token']?>">
    <select required name="etat" id="">
        <option disabled selected value >etat</option>
        <option  value="à faire">à faire</option>
        <option  value="terminée">terminée</option>
    </select>

    <select required name="idCategorie" id="">
        <option disabled selected value >categorie</option>
        <?php foreach ($params[1] as $key => $value) : ?>
            <option  value="<?= $value['idCategorie']?>"><?= $value['categorie']?></option>
        <?php endforeach; ?>
    </select>

</form>
</div>
<?php else : ?>
<h1>Modifier categorie</h1>
<div class="ajout">
    <form action="/list/categorie/update/<?=$params[0]['idCategorie']?>" method="POST">
    <Label>
        <input required type="text" name="categorie" id="" placeholder="<?=$params[0]['categorie']?>">
        <button type="submit" value="modifier">+</button>
    </Label>
    <input type="hidden" name="token" value="<?= $_SESSION['token']?>">
</form>
</div>
<?php endif ;?>