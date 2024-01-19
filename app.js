// Attendre que la page soit complètement chargée
document.addEventListener('DOMContentLoaded', function() {
    // Récupérer le canevas de signature
    var canvas = document.getElementById('signature-pad');
  
    // Créer une instance de la classe SignaturePad
    var signaturePad = new SignaturePad(canvas);
  
    // Récupérer le bouton pour effacer la signature
    var clearButton = document.getElementById('clear-signature');
  
    // Ajouter un gestionnaire d'événement pour effacer la signature au clic sur le bouton
    clearButton.addEventListener('click', function() {
      signaturePad.clear();
    });
  
    // Récupérer le formulaire de prise en charge
    var formulaire = document.getElementById('mon-formulaire');
  
    // Ajouter un gestionnaire d'événement pour soumettre le formulaire
    formulaire.addEventListener('submit', function(event) {
      // Récupérer les données de la signature encodées en base64
      var signatureData = signaturePad.toDataURL();
  
      // Créer un champ de formulaire caché pour stocker les données de la signature
      var signatureField = document.createElement('input');
      signatureField.setAttribute('type', 'hidden');
      signatureField.setAttribute('name', 'signature');
      signatureField.setAttribute('value', signatureData);
  
      // Ajouter le champ de signature au formulaire
      formulaire.appendChild(signatureField);
    });
  });
  