
// Things that should be done every time a page loads
// $(()=>{
//         console.log("Testing call JS");
// });

// $(document).ready(function(){
//        console.log("Testing call JS");
//  })


// ============================ GESTION PANIER ========================

//Saisie l'ID du film au moment du click du bouton "ajouter au panier"
// function ajouterAuPanier(id)
// {
// 	//var formImputs = new FormData(document.getElementById('formBtnPanier'));
// 	//var action = "action=ajouterAuPanier";
// 	//alert($(form).serialize());
// 	$.ajax({
// 		method: "POST",
// 		url:"",
// 		data:{
// 			action: "",
// 			idProduit: id,
// 		},
// 		// contentType: false,
// 		// processData:false,
// 		// dataType:'json'
// 	}).done((filmJson)=>{

// 		//alert(filmJson);
// 		$.ajax({
// 			method: "POST",
// 			url:"../membre/template/ajouterPanier.php",
// 			data: "dataJson="+filmJson
// 		});

// 	});
// }
