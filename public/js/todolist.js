"use strict";
//code js crée pour avoir des filtres d'affiches dynamique sans passer par une requete en post ou get
//recuperation des données des filtres et de leurs valeurs
const todo = document.getElementsByClassName('à faire');
const done = document.getElementsByClassName('terminée');
const parentFilterCategorie = document.getElementById('filtre_categorie');
const parentFilterState =     document.getElementById('filtre_etat');
let parentFilterCategorieValue ; 
let parentFilterStateValue ; 
const elementChildCategorie = parentFilterCategorie.children;
const elementChildState = parentFilterState.firstChild;  


//ecouteur au changement du select qui appele fonction callback
parentFilterCategorie.addEventListener('change',() => {
    //traitement logique avec un principe simple qui ajouter une class qui display none les items non selectionnés
    parentFilterCategorieValue = parentFilterCategorie.value;
    if (document.querySelector('aucune')) document.querySelector('aucune').remove() ;
    let result;
    
    if(parentFilterStateValue != 'état'   && parentFilterStateValue !=undefined){
        if(parentFilterCategorieValue == 'toute catégorie'){
            result = document.querySelectorAll(`[data-id-etat="${parentFilterStateValue}"]`);
        }else{

            result = document.querySelectorAll(`[data-id-etat="${parentFilterStateValue}"][data-id="${parentFilterCategorieValue}"]`);
        }
    }else{
        result = document.querySelectorAll(`[data-id="${parentFilterCategorieValue}"]`);
    }
    const none = document.querySelectorAll('div.items > div.none')
    
    none.forEach(element => {
        if(none[0] != undefined) element.classList.remove('none');
    });

    const all = document.querySelectorAll('div.items > div')

    all.forEach(element => {
        element.classList.add('none')
    });
    let array;
    if(parentFilterCategorieValue == 'toute catégorie' && (parentFilterStateValue == 'état' || parentFilterStateValue == undefined) ) {
        array = all;
    }else{
        array = result;
    }
    
    array.forEach(element => {
        element.classList.remove('none');
    });
    //affiche si aucune tache n'est trouvée
    if (document.querySelectorAll('div.items > div').length == document.querySelectorAll('div.items > div.none').length) {
        const p = document.createElement("p")
const div = document.createElement("div")
div.className= ('aucune')
        p.append("Aucune tâche")
        div.append(p)
        document.querySelector('div.items').append(div);
    }

    console.log(parentFilterStateValue, parentFilterCategorieValue )

});


parentFilterState.addEventListener('change',() => {
    parentFilterStateValue = parentFilterState.value;
    let result;
    if (document.querySelector('aucune')) document.querySelector('aucune').remove() ;
    
    if(parentFilterCategorieValue != 'toute catégorie' &&  parentFilterCategorieValue !=undefined){
        if(parentFilterStateValue== 'état'){
            result = document.querySelectorAll(`[data-id="${parentFilterCategorieValue}"]`);
        }else{

            result = document.querySelectorAll(`[data-id-etat="${parentFilterStateValue}"][data-id="${parentFilterCategorieValue}"]`);
        }
    }else{
        
        result = document.querySelectorAll(`[data-id-etat="${parentFilterStateValue}"]`);
    }
    
    const none = document.querySelectorAll('div.items > div.none')
    none.forEach(element => {
        if(none[0] != undefined) element.classList.remove('none');
    });
    
    const all = document.querySelectorAll('div.items > div')
    
    all.forEach(element => {
        element.classList.add('none')
    });

    let array;
    
    if(parentFilterStateValue == 'état' && (parentFilterCategorieValue == 'toute catégorie' || parentFilterCategorieValue == undefined) ) {
        array = all;
   }else{
        array = result;
   }
    
         console.log(array)
    array.forEach(element => {
       element.classList.remove('none');
    });
    
    if (document.querySelectorAll('div.items > div').length == document.querySelectorAll('div.items > div.none').length) {
        const p = document.createElement("p")
const div = document.createElement("div")
div.className = ('aucune')
        p.append("Aucune tâche")
        div.append(p)
        document.querySelector('div.items').append(div);
    }
    


    
});

function urlDelete(arg){
    //transmition des deux valeurs selectionnées par l'utilisateur avec le token qui seront rajouter à un lien 
    //en get au controller pour supprimer les données affichées
    let param = parentFilterCategorieValue +'|'+ parentFilterStateValue+'|'+arg;
    
    window.location.href =   `list/item/deleteAll/${param}`;
    
    
}

