<title><?= $path ?></title>
<link href="<?= SCRIPTS ?>css/style.css" rel="stylesheet">
</head>
<body>

<h1>TODOLIST</h1>
<div class="ajout">
    <form action="/list/item/add" method="POST">
        <label>
        <input required type="text" name="tache" id="" value="" placeholder="tâche..">
        <button type="submit" value="ajouter">+</button>
        </label>
        <input type="hidden" name="token" value="<?= $_SESSION['token']?>">
        <select required name="idCategorie" id="">
            <option disabled selected value >catégorie</option>
            <?php foreach ($params[1] as $key => $value) : ?>
                <option  value="<?= $value['idCategorie']?>"><?= $value['categorie']?></option>
            <?php endforeach; ?>
        </select>


    </form>
</div>
<div class="filtre">
<select name="" id="filtre_categorie">
        <option>toute catégorie</option>
        <?php foreach ($params[1] as $key => $value) : ?>
            <option  value="<?= $value['idCategorie']?>"><?= $value['categorie']?></option>
        <?php endforeach; ?>
</select>

<select name="" id="filtre_etat">
        <option>état</option>
        
        <option value="à faire"  >à faire</option>
        <option value="terminée">terminées</option>
        
</select>


<a href="/list/categorie" class=" linkStyle href"> Ajouter une catégorie </a>
<a href="/logout" class="linkStyle href"> deconnexion </a>
<button class="linkStyle" onclick="urlDelete('<?= $_SESSION['token']?>')"> Tout Supprimer </button> 

</div>

<div class="items ">
  <?php for ($i=0; $i<2; $i++) : ?>
        <?php foreach ($params[0] as  $value) : ?>
            <?php 
            $i === 0 ? $etat = 'à faire' : $etat = 'terminée';
            if ($value['etat'] === $etat) :
                
                ?>
                <div data-id="<?= $value['idCategorie']?>"  data-id-etat="<?= $value['etat']?>" class=""> 
                    <div class ="firstDiv" >
                        <p class="borderblue "><?= $value['tache']?> </p>
                    </div>
                    <div class="secondDiv">
                        <div id="nativeDiv">
                            <a href="/list/item/finish/<?= $value['idList']?>|<?= $_SESSION['token']?>" class=" linkStyle "> 
                               <?php if ($value['etat'] === 'à faire') :?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"/></svg>
                                <?php else : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>
                                <?php endif ?>
                            </a> 
                        </div>
                        <div id="firstLink" onclick="window.location.href='/list/item/edit/<?= $value['idList']?>|<?= $_SESSION['token']?>'">
                            <a href="/list/item/edit/<?= $value['idList']?>|<?= $_SESSION['token']?>" class=" linkStyle "> modifier </a> 
                        </div>
                        <div id="secondLink" onclick="window.location.href='/list/item/delete/<?= $value['idList']?>|<?= $_SESSION['token']?>'">
                            <a href="/list/item/delete/<?= $value['idList']?>|<?= $_SESSION['token']?>" class="  linkStyle "> supprimer </a> 
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endfor; ?>
</div>
<script type="text/javascript" src="<?= SCRIPTS ?>js/todolist.js "></script>






