require('./bootstrap');
import "bootstrap";
$(document).on("click", ".update", function() {
    var update_plante_id = $(this).data('id');
    console.log(update_plante_id);
    console.log('ici');
    $.ajax({
        type: 'GET',
        url: 'editerPlante/' + update_plante_id + '/edit',
        data: {},
        success: function(data) {
            console.log(data);
            var id = document.getElementById("id").value = data[0]['id'];
            var nom = document.getElementById("nomUpdate").value = data[0]['nom'];
            var varieter = document.getElementById("varieterUpdate").value = data[0]['varieter'];
            var couleur = document.getElementById("couleurUpdate").value = data[0]['couleur'];
            var conditionnement = document.getElementById("conditionnementUpdate").value = data[0]['conditionnement'];
            var prix = document.getElementById("prixUpdate").value = data[0]['prix'];
            var categorie = document.getElementById("categorieUpdate").value = data[0]['categorie'];
        }
    });


});
$('document').ready(function() {
    $(this).change(function() {
        let id = $(this).find('input[type=checkbox]').attr('data-id');
        console.log(id);
    });
});