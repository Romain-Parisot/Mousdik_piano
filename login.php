<?php session_start(); ?>
<?php 
/* 
Template Name: Login 
*/
?>
<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package mousdik
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">


<div class="bg-login">
    <div>
        <form method="post">
            <div class="div_form_log_creacc">
                <h3 class="font_30px pt_30px txt_center">Se connecter</h3>
                <div class="input_log_creacc_form">
                    <label for="" class="semi_bold">Email</label>
                    <input type="text" name="mail" class="input_log_creacc_form_big">
                </div>
                <div class="input_log_creacc_form">
                    <label for="" class="semi_bold">Confirmer mot de passe</label>
                    <input type="password" name="password" class="input_log_creacc_form_big">
                </div>
                <div class="div_bt_connexion_form_log_creacc pt_30px">
                    <input type="submit" value="Connexion" class="input_log_creacc_form_big bt_connexion_form_log_creacc semi_bold">
                </div>
                <p class="txt_noacc">Pas encore inscrit ? <a href="#" class="bold">S'inscrire</a></p>
            </div>
        </form>
    </div>
    <div>
        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/login/logo_mousdik_white_detoure.png' ); ?>" class="logo_form_log_creacc" alt="">
    </div>
    
</div>

<?php
require_once 'user.php';
require_once 'Connection.php';

if($_POST){
    $mail = stripslashes($_POST['mail']);
    $password = stripslashes($_POST['password']);
    $connection = new Connection();
    $test=$connection->login($mail, $password);

    if($test){
        $_SESSION['user_type'] = 'User' ;
        header("Location: wp-content/themes/Mousdik_Piano/index.php");
        echo "utilisateur trouvé";

    }else{
        echo "Email or password not valid";
    }
}

