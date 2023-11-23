<?php
    $nomError = $prenomError = $emailError = $teleError = $msgError = "";
    $nom = $prenom = $email = $tele = $msg = "";
    $isSucces = false;
    $emailTo = "khaliil.bentayeb@gmail.com";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $prenom = verifyInput($_POST["prenom"]);
        $nom = verifyInput($_POST["nom"]);
        $email = verifyInput($_POST["email"]);
        $tele = verifyInput($_POST["tele"]);
        $msg = verifyInput($_POST["msg"]);
        $isSucces = true;
        $emailText = "";

        if(empty($prenom)){
            $prenomError = "*Merci de saisir votre prenom";
            $isSucces = false;
        }else{
            $emailText .="firstName: $prenom\n";
        }
        if(empty($nom)){
            $nomError = "*Merci de saisir votre nom";
            $isSucces = false;
        }else{
            $emailText .="Name: $nom\n";
        }
        if(!isValidEmail($email)){
            $emailError = "*Merci de saisir votre email";
            $isSucces = false;
        }else{
            $emailText .="Email: $email\n";
        }
        if(!isValidPhone($tele)){
            $teleError = "*Merci de saisir votre tele";
            $isSucces = false;
        }else{
            $emailText .="Phone: $tele\n";
        }
        if(empty($msg)){
            $msgError = "*Merci de saisir votre msg";
            $isSucces = false;
        }else{
            $emailText .="Message: $msg\n";
        }
        if($isSucces){
            $header="From :$prenom $nom <$email> \r\nReplay-To: $email";
            mail($emailTo,"un message de votre site",$emailText,$header);
            $nom = $prenom = $email = $tele = $msg = "";
        }
    }

    function isValidPhone($var){
        return preg_match("/^[0-9]*$/", $var);
    }

    function isValidEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contactez moi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <hr>
        <h3>CONTACTEZ-MOI</h3>
        <div class="container">
            <form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="row justify-content-between py-4 px-3">
                    <div class="col-md-6  my-1">
                        <label for="prenom" class="form-label">Prenoms<span class="etoile">*</span></label>
                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prenom">
                        <p class="red-comment my-1"><?php echo $prenomError; ?></p>
                    </div>
                    <div class="col-md-6  my-1">
                        <label for="nom" class="form-label">Nom<span class="etoile">*</span></label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom">
                        <p class="red-comment my-1"><?php echo $nomError; ?></p>
                    </div>
                    <div class="col-md-6  my-1">
                        <label for="email" class="form-label">Email<span class="etoile">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="abc@xyz.com">
                        <p class="red-comment my-1"><?php echo $emailError ; ?></p>
                    </div>
                    <div class="col-md-6  my-1">
                        <label for="tele" class="form-label">Telephone<span class="etoile">*</span></label>
                        <input type="tel" class="form-control" id="tele" name="tele" placeholder="Votre telephone">
                        <p class="red-comment my-1"><?php echo $teleError; ?></p>
                    </div>
                    <div class="col my-1">
                        <label for="msg" class="form-label">Message<span class="etoile">*</span></label>
                        <textarea class="form-control" id="msg" name="msg" rows="3" placeholder="Votre message"></textarea>
                        <p class="red-comment my-1"><?php echo $msgError; ?></p>
                    </div>
                    <div class="col-12">
                        <input class="btn btn-warning btn-submit" type="submit" value="ENVOYER">
                        <p class="tnx" style="display:<?php if($isSucces) echo "block"; else echo "none"; ?>;">Votre mesage a ete bien envoye.M'erci de m'avoir contacter :) </p>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>