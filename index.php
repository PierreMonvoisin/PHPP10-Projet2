<?php
$validity = false;
$regExText = '/^[a-zA-Z0-9 àèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ,;"\'-_()\[\]]{1,250}$/';
// If the user clicked on the button and the form is using the method Get
if (isset($_GET['submitButton']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
  // Failsafe not to display informations wrongfully
  $validity = true;
  // Store all informations in variables
  $firstName = $_GET['firstName'];
  // Validation des informations
  preg_match($regExText, $firstName) ? $firstName : $firstName = 'Error';
  $lastName = $_GET['lastName'];
  preg_match($regExText, $lastName) ? $lastName : $lastName = 'Error';
  $civility = $_GET['civility'];
  $age = $_GET['age'];
  preg_match('/^[0-9]{1,3}$/', $age) && ($age > 0 && $age < 122) ? $age : $age = 'Error';
  $industry = $_GET['industry'];
  preg_match($regExText, $industry) ? $industry : $industry = 'Error';
}
?>
<!DOCTYPE html>
<html lang='fr' dir='ltr'>
<head>
  <title>Projet 2</title>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body class='container-fluid contact'>
  <div class="row">
    <div class="col-md-4">
      <!-- If the informations are all sorted in var -->
      <?php if ($validity){
        // Check if civility is set to other not to display the title for the gender
        $civility == 'other' ? $civility = '' : $civility; ?>
        <div class="contact-info text-center">
          <img src="https://image.flaticon.com/icons/svg/190/190411.svg" alt="image"/>
          <h3>Merci <?= $civility. ' ' .$lastName. ' ' .$firstName. ' (' .$age. ' ans)' ?> pour vos informations.</h3>
          <h4>Votre société "<?= $industry ?>" a bien été enregistré dans notre base de donnée.</h4>
        </div>
      <?php } else { ?>
        <div class="contact-info text-center">
          <img src="https://image.flaticon.com/icons/svg/552/552486.svg" alt="image"/>
          <h2>Merci de renseigner vos informations</h2>
          <h4>Nous aimerions vous contacter</h4>
        </div>
      <?php } ?>
    </div>
    <div class="col-md-8">
        <form class="contact-form" action="index.php" method="get" autocomplete="on">
          <div class="form-group">
            <label class="control-label col-sm-2" for="firstName">Prénom</label>
            <div class="col-sm-10">
              <input <?php if ($validity){ echo 'value="' .$firstName. '"'; } ?> type="text" class="form-control" id="firstName" placeholder="John.." name="firstName" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="lastName">Nom</label>
            <div class="col-sm-10">
              <input <?php if ($validity){ echo 'value="' .$lastName. '"'; } ?> type="text" class="form-control" id="lastName" placeholder="Doe.." name="lastName" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="civility">Civilité</label>
            <div class="col-sm-10">
              <select class="custom-select" name="civility" id="civility" required>
                <option value="empty" selected disabled>-- Votre choix --</option>
                <option value="M"
                <?php if ($validity && $civility == 'M'){ echo 'selected'; } ?>
                >Monsieur</option>
                <option value="Mme"
                <?php if ($validity && $civility == 'Mme'){ echo 'selected'; } ?>
                >Madame</option>
                <option value="Mlle"
                <?php if ($validity && $civility == 'Mlle'){ echo 'selected'; } ?>
                >Mademoiselle</option>
                <option value="other"
                <?php if ($validity && ($civility == 'other' || $civility == '')){ echo 'selected'; } ?>
                >Autre</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="age">Âge</label>
            <div class="col-sm-10">
              <input <?php if ($validity){ echo 'value="' .$age. '"'; }?> type="number" step="1" min="0" max="122" class="form-control" id="age" placeholder="42.." name="age" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="industry">Société</label>
            <div class="col-sm-10">
              <input <?php if ($validity){ echo 'value="' .$industry. '"'; }?> type="text" class="form-control" id="industry" placeholder="La Manu Inc.." name="industry" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="submitButton" id="submitButton" class="btn">Valider</button>
            </div>
          </div>
        </form>
    </div>
  </div>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
  <script src='assets/js/script.js'></script>
</body>
</html>
